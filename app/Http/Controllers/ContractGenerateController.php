<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;

use PhpOffice\PhpSpreadsheet\Writer\IWriter;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

// Money to Words Converter
use NumberToWords\NumberToWords;

use App\Model\Contract;
use App\Model\CustomField;
use App\Model\DealerInfo;
use App\Model\RegFeeTwoParty;
use App\Model\RegFeeThreeParty;

define('FINANCIAL_MAX_ITERATIONS', 128);
define('FINANCIAL_PRECISION', 1.0e-08);

class ContractGenerateController extends Controller
{
    public function Generate($contract, $type) {

      // $type = "preview" | "preprinted"

      $prefix = Contract::GetPrefixContractFilename();
      $fileSource = public_path().'/'.Contract::GetContractSourcePath();

      $template = $this->SetContractDetails($type, $fileSource, $contract);
      // $template = $result['template'];
      // $contract = $result['contract'];

      $contractFileName = $prefix.'_'.Contract::GetPrintTemplateName($type, $contract->product_type, $contract->retail_type);
      
      $modFileDestination = Contract::GetContractDestinationPath($contract->product_type);
      $fileDestination =  public_path().'/'.$modFileDestination;
      // $pdfFile = $fileDestination.$contractFileName.'.pdf';
      $docFile = $fileDestination.$contractFileName.'.docx';
      // dd($docFile);
      $template->saveAs($docFile);

      $word = new \COM("Word.Application") or die ("Could not initialise Object.");
      // set it to 1 to see the MS Word window (the actual opening of the document)
      $word->Visible = 0;
      // recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
      $word->DisplayAlerts = 0;
      // open the word 2007-2013 document 
      $word->Documents->Open($docFile);
      // convert word 2007-2013 to PDF
      $word->ActiveDocument->ExportAsFixedFormat($fileDestination.$contractFileName.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
      // quit the Word process
      $word->Quit(false);
      // clean up
      unset($word);

      return './'.$modFileDestination.$contractFileName.'.pdf';
    }

    public function SetContractDetails($type, $fileSource, $contract) {

      $file = $fileSource.Contract::GetPrintTemplateName($type, $contract->product_type, $contract->retail_type);

      // Set the source to the FINAL document once contract is already printed
      if($type == "preview")
        if($contract->dateprinted!=null)
            $file = $file.'_final';

      $template = new \PhpOffice\PhpWord\TemplateProcessor($file.'.docx');  
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      switch ($contract->product_type) {
            case '2': //Retail
                if($contract->retail_type == "1")
                    $template = $this->SetRetail2P($template, $contract, $sheet);
                else 
                    $template = $this->SetRetail3P($template, $contract, $sheet);
                break;
            case '1': //Lease
                $template = $this->SetLease($template, $contract, $sheet);
                break;
        }      
      

      // $result = [
      //   'template'  => $template,
      //   'contract'  => $contract,
      // ];
      
      return $template;
    }

    function NumberToWordsConverter($input) {
        $floatInput = floatval(preg_replace("/[^-0-9\.]/","",$input));
        $floatInputBase = $floatInput;
        $floatInput *= 100;

        // create the number to words "manager" class
        $numberToWords = new NumberToWords();
        // build a new currency converter using the RFC 3066 language identifier
        $currencyConverter = $numberToWords->getCurrencyTransformer('en');
        $word = $currencyConverter->toWords($floatInput, 'USD');

        // Replace the dollar/s word to peso/s
        $word = str_replace("dollars", "pesos and", $word);
        $word = str_replace("dollar", "peso and", $word);

        // Add no cents if it doesn't have decimal value
        if(fmod($floatInputBase,1) == 0.00)
          $word .= " no cents";

    return $word;
    }

    function NumberToWordsConverterVer2($input) {
        $floatInput = floatval(preg_replace("/[^-0-9\.]/","",$input));
        $floatInputBase = $floatInput;
        $floatInput *= 100;

        // create the number to words "manager" class
        $numberToWords = new NumberToWords();
        // build a new currency converter using the RFC 3066 language identifier
        $currencyConverter = $numberToWords->getCurrencyTransformer('en');
        $word = $currencyConverter->toWords($floatInput, 'USD');

        // Replace the dollar/s word to peso/s
        $word = str_replace("dollars", "", $word);
        $word = str_replace("dollar", "", $word);

        // // Add no cents if it doesn't have decimal value
        // if(fmod($floatInputBase,1) == 0.00)
        //   $word .= " no cents";

        $wordArray = explode("-", $word);
        // dd(count($wordArray));
        if(count($wordArray)>1) {
          $word = "";
          foreach ($wordArray as $w) {
            $word .= ($w . " ");
          }
        }

        return $word;
    }

    // function Rate2($month, $payment, $amount)
    // {
    //     // make an initial guess
    //     $error = 0.0000001; $high = 1.00; $low = 0.00;
    //     $rate = (2.0 * ($month * $payment - $amount)) / ($amount * $month);

    //     while(true) {
    //         // check for error margin
    //         $calc = pow(1 + $rate, $month);
    //         $calc = ($rate * $calc) / ($calc - 1.0);
    //         $calc -= $payment / $amount;

    //         if ($calc > $error) {
    //             // guess too high, lower the guess
    //             $high = $rate;
    //             $rate = ($high + $low) / 2;
    //         } elseif ($calc < -$error) {
    //             // guess too low, higher the guess
    //             $low = $rate;
    //             $rate = ($high + $low) / 2;
    //         } else {
    //             // acceptable guess
    //             break;
    //         }
    //     }

    //     return $rate * 12;
    // }

//     function Rate($nper, $pmt, $pv, $fv = 0.0, $type = 0, $guess = 0.1) {

//     $rate = $guess;
//     if (abs($rate) < FINANCIAL_PRECISION) {
//         $y = $pv * (1 + $nper * $rate) + $pmt * (1 + $rate * $type) * $nper + $fv;
//     } else {
//         $f = exp($nper * log(1 + $rate));
//         $y = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
//     }
//     $y0 = $pv + $pmt * $nper + $fv;
//     $y1 = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;

//     // find root by secant method
//     $i  = $x0 = 0.0;
//     $x1 = $rate;
//     while ((abs($y0 - $y1) > FINANCIAL_PRECISION) && ($i < FINANCIAL_MAX_ITERATIONS)) {
//         $rate = ($y1 * $x0 - $y0 * $x1) / ($y1 - $y0);
//         $x0 = $x1;
//         $x1 = $rate;

//         if (abs($rate) < FINANCIAL_PRECISION) {
//             $y = $pv * (1 + $nper * $rate) + $pmt * (1 + $rate * $type) * $nper + $fv;
//         } else {
//             $f = exp($nper * log(1 + $rate));
//             $y = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
//         }

//         $y0 = $y1;
//         $y1 = $y;
//         ++$i;
//     }
//     return $rate;
// }   //  function RATE()

    function SetLease($template, $contract, $sheet) {
      $dealer = DealerInfo::GetDealerInfoForContract();

      $cdate = new Carbon($contract->firstduedate);
      $template->setValue('contractid', $contract->contract_id); 
      
      $template->setValue('day', $cdate->format('dS'));
      $template->setValue('month_yr', $cdate->format('F Y'));

      // dd($cdate->format('F Y'));

      $template->setValue('clientname', $contract->client_name);  
      $template->setValue('clientmarital', "Civil Status: " . ucwords($contract->client_marital));  
      $template->setValue('clientaddress', $contract->client_address);
      $template->setValue('clienttin', $contract->client_tin);  

      $template->setValue('comakername', $contract->comaker_name);
      $template->setValue('comakertin', $contract->comaker_tin); 
      $template->setValue('comakermarital', "Civil Status: " . ucwords($contract->comaker_marital)); 

      $template->setValue('vehiclemake', $contract->vehicle_make);  
      $template->setValue('vehiclemodel', $contract->vehicle_yearmodel); 
      $template->setValue('vehicleseries', $contract->GetVehicleName($contract->vehicle_name)); 
      $template->setValue('vehiclecolor', $contract->vehicle_color); 
      $template->setValue('vehiclechasis', $contract->vehicle_chasis); 
      $template->setValue('vehicleengine', $contract->vehicle_engine); 
      $template->setValue('conductionsticker', $contract->vehicle_consticker); 

      $template->setValue('witness1name', $contract->witness1_name);
      $template->setValue('witness1tin', $contract->witness1_tin); 
      $template->setValue('witness2name', $contract->witness2_name);
      $template->setValue('witness2tin', $contract->witness2_tin); 

      $localsigdetails = $contract->dealer_signatory.' '.$contract->dealer_signatory_tin;
      $template->setValue('localsignatorydetails', $localsigdetails); 

      // Names
      $template->setValue('namerow1', $dealer->dealer_name);
      $template->setValue('id1', $dealer->dealer_tin);
      $template->setValue('namerow2', $contract->dealer_signatory);
      $template->setValue('id2', $contract->dealer_signatory_govid);
      $template->setValue('namerow3', $contract->client_name);
      $template->setValue('id3', $contract->client_govid);
      $cdate = new Carbon($contract->client_dateissued);
      $template->setValue('dateIssued3', $cdate->format('m/d/Y'));
      $template->setValue('namerow4', $contract->comaker_name);
      $template->setValue('id4', $contract->comaker_govid);
      $cdate = new Carbon($contract->comaker_dateissued);
      $template->setValue('dateIssued4', $cdate->format('m/d/Y'));

      $adate = new Carbon($contract->dateaccepted);
      $template->setValue('dateaccepted', $adate->format('F d, Y'));
      $nadate = $adate->addMonths(1);
      $template->setValue('nextdateaccepted', $nadate->format('F d, Y'));
      $template->setValue('dayda', $nadate->format('dS'));
      $term = $contract->term;
      $adatet = $adate->addMonths(($term-1));
      $template->setValue('datewithterm', $adatet->format('F d, Y'));

      $template->setValue('minstallment', $contract->monthly_installment);
      $template->setValue('term', $term);
      $template->setValue('term_word', ucwords($this->NumberToWordsConverterVer2($term)));

      $amountfinance = $contract->amount_finance;
      $amountfinanceF = floatval(preg_replace("/[^-0-9\.]/","",$amountfinance));
      $template->setValue('unitcost', $contract->unit_cost);
      $template->setValue('downpayment', $contract->downpayment);
      $template->setValue('amtfinance', $amountfinance);

      $ip = 0.0;
      $template->setValue('ip', number_format($ip, 2, '.', ','));
      $ip = floatval(preg_replace("/[^-0-9\.]/","",$ip));

      $dst = ($contract->dst <= 0 || $contract->dst == "") ? 0.0 : $contract->dst;
      $template->setValue('dst', $dst);
      $dst = floatval(preg_replace("/[^-0-9\.]/","",$dst));
      
      $regfee = ($contract->retail_type == 1) ? RegFeeTwoParty::GetRegFee($amountfinance) : RegFeeThreeParty::GetRegFee($amountfinance);
      $template->setValue('regfee', number_format($regfee, 2, '.', ','));
      $regfee = floatval(preg_replace("/[^-0-9\.]/","",$regfee));

      $nfsum = $ip+$dst+$regfee;
      $template->setValue('nfsum', number_format($nfsum, 2, '.', ',')); //sum of the above 3

      // // Set Contract Schedule
      // // Dummy data
      $interest = $this->SetAmortTable($template, $contract, $sheet);

      $template->setValue('interest', number_format($interest, 2, '.', ','));
      $interest = floatval(preg_replace("/[^-0-9\.]/","",$interest));;

      $leaseretail_fee = floatval(preg_replace("/[^-0-9\.]/","",$contract->leaseretail_fee));
      $other_charges = floatval(preg_replace("/[^-0-9\.]/","",$contract->other_charges));
      $leasehandling = ($leaseretail_fee + $other_charges + Contract::GetCICharge($contract));
      $template->setValue('leasefee', number_format($leasehandling, 2, '.', ','));
      $leasehandling = floatval(preg_replace("/[^-0-9\.]/","",$leasehandling));

      $fcsum = $interest + $leasehandling;
      $template->setValue('fcsum', number_format($fcsum, 2, '.', ',')); // sum of the above 2

      $tempEIR = $amountfinanceF-$dst-$ip-$leasehandling-$regfee;
      $sheet->setCellValue('B1', '='.$tempEIR);
      $sheet->setCellValue('B'.($term+2), '=(1+IRR(B1:B'.($term+1).'))^12-1');
      $eir = $sheet->getCell('B'.($term+2))->getCalculatedValue();
      $eir = round(($eir*100),2);
      $template->setValue('eir', $eir.'%');

      $tempCIR = $amountfinanceF-$leasehandling;
      $sheet->setCellValue('C1', '='.$tempCIR);
      $sheet->setCellValue('C'.($term+2), '=(1+IRR(C1:C'.($term+1).'))^12-1');
      $cir = $sheet->getCell('C'.($term+2))->getCalculatedValue();
      $cir = round(($cir*100),2);
      $template->setValue('contractual_int', $cir.'%');

      return $template;
    }

    function SetRetail2P($template, $contract, $sheet) {
      $dealer = DealerInfo::GetDealerInfoForContract();

      $template->setValue('contractid', $contract->contract_id); 

      $template->setValue('dealername', $dealer->dealer_name);  
      $template->setValue('dealeraddress', $dealer->address);  

      $template->setValue('clientname', $contract->client_name);  
      $template->setValue('age', "Of Legal Age");  
      $template->setValue('nationality', $contract->client_nationality);
      $template->setValue('clientmarital', $contract->client_marital);  
      $template->setValue('clientaddress', $contract->client_address);
      $template->setValue('clienttin', $contract->client_tin);  

      $template->setValue('comakername', $contract->comaker_name);
      $template->setValue('comakertin', $contract->comaker_tin); 
      $template->setValue('comakermarital', $contract->comaker_marital); 
      
      $amountfinance = $contract->amount_finance;
      $amountfinanceF = floatval(preg_replace("/[^-0-9\.]/","",$amountfinance));
      $template->setValue('amountfinance', $amountfinance);
      $template->setValue('amountfinanceword', strtoupper($this->NumberToWordsConverter($contract->amount_finance)));

      $template->setValue('minstallment', $contract->monthly_installment);
      $term = $contract->term;
      $template->setValue('term', $term);
      $cdate = new Carbon($contract->firstduedate);
      $template->setValue('firstduedate', $cdate->format('F d, Y'));

      if($contract->client_city_mun_others != "")
        $citymun = $contract->client_city_mun_others;
      else {
        $citymun = $contract->GetCityMunicipality($contract->client_city_mun);

        if($citymun!=null)
          $citymun = $citymun->name;
        else
          $citymun = "";
      }

      $template->setValue('citymun', $citymun);

      $template->setValue('unitcost', $contract->unit_cost);
      $template->setValue('downpayment', $contract->downpayment);
      $template->setValue('amtfinance', $amountfinance);

      $ip = 0.0;
      $template->setValue('ip', number_format($ip, 2, '.', ','));
      $ip = floatval(preg_replace("/[^-0-9\.]/","",$ip));

      $dst = ($contract->dst <= 0 || $contract->dst == "") ? 0.0 : $contract->dst;
      $template->setValue('dst', $dst);
      $dst = floatval(preg_replace("/[^-0-9\.]/","",$dst));
      
      $regfee = ($contract->retail_type == 1) ? RegFeeTwoParty::GetRegFee($amountfinance) : RegFeeThreeParty::GetRegFee($amountfinance);
      $template->setValue('regfee', number_format($regfee, 2, '.', ','));
      $regfee = floatval(preg_replace("/[^-0-9\.]/","",$regfee));

      $nfsum = $ip+$dst+$regfee;
      $template->setValue('nfsum', number_format($nfsum, 2, '.', ',')); //sum of the above 3

      $vehicleusage = CustomField::GetFieldNameByDescAndFieldId("vehicle_usage", $contract->vehicle_usage);
      $template->setValue('vehicleusage', $vehicleusage);
      $template->setValue('vehiclemake', $contract->vehicle_make);  
      $template->setValue('vehiclemodel', $contract->vehicle_yearmodel); 
      $template->setValue('vehicleseries', $contract->GetVehicleName($contract->vehicle_name)); 
      $template->setValue('vehiclecolor', $contract->vehicle_color); 
      $template->setValue('vehiclechasis', $contract->vehicle_chasis); 
      $template->setValue('vehicleengine', $contract->vehicle_engine); 
      $template->setValue('conductionsticker', $contract->vehicle_consticker); 

      $template->setValue('witness1name', $contract->witness1_name);
      $template->setValue('witness1tin', $contract->witness1_tin); 
      $template->setValue('witness2name', $contract->witness2_name);
      $template->setValue('witness2tin', $contract->witness2_tin); 

      $localsigdetails = $contract->dealer_signatory.' '.$contract->dealer_signatory_tin;
      $template->setValue('localsignatorydetails', $localsigdetails); 

      // Names
      $template->setValue('namerow1', $dealer->dealer_name);
      $template->setValue('id1', $dealer->dealer_tin);
      $template->setValue('namerow2', $contract->dealer_signatory);
      $template->setValue('id2', $contract->dealer_signatory_govid);
      $template->setValue('namerow3', $contract->client_name);
      $template->setValue('id3', $contract->client_govid);
      $cdate = new Carbon($contract->client_dateissued);
      $template->setValue('dateIssued3', $cdate->format('m/d/Y'));
      $template->setValue('namerow4', $contract->comaker_name);
      $template->setValue('id4', $contract->comaker_govid);
      $cdate = new Carbon($contract->comaker_dateissued);
      $template->setValue('dateIssued4', $cdate->format('m/d/Y'));

      // // Set Contract Schedule
      // // Dummy data
      $interest = $this->SetAmortTable($template, $contract, $sheet);

      $template->setValue('interest', number_format($interest, 2, '.', ','));
      $interest = floatval(preg_replace("/[^-0-9\.]/","",$interest));;

      $leaseretail_fee = floatval(preg_replace("/[^-0-9\.]/","",$contract->leaseretail_fee));
      $outoftown_charge = floatval(preg_replace("/[^-0-9\.]/","",$contract->outoftown_charge));
      $other_charges = floatval(preg_replace("/[^-0-9\.]/","",$contract->other_charges));
      $servicehandling = ($leaseretail_fee + $outoftown_charge + $other_charges + Contract::GetCICharge($contract))-$regfee;
      $template->setValue('servicefee', number_format($servicehandling, 2, '.', ','));
      $servicehandling = floatval(preg_replace("/[^-0-9\.]/","",$servicehandling));

      $fcsum = $interest + $servicehandling;
      $template->setValue('fcsum', number_format($fcsum, 2, '.', ',')); // sum of the above 2

      $tempEIR = $amountfinanceF-$dst-$ip-$servicehandling-$regfee;
      $sheet->setCellValue('B1', '='.$tempEIR);
      $sheet->setCellValue('B'.($term+2), '=(1+IRR(B1:B'.($term+1).'))^12-1');
      $eir = $sheet->getCell('B'.($term+2))->getCalculatedValue();
      $eir = round(($eir*100),2);
      $template->setValue('eir', $eir.'%');

      $tempCIR = $amountfinanceF-$servicehandling;
      $sheet->setCellValue('C1', '='.$tempCIR);
      $sheet->setCellValue('C'.($term+2), '=(1+IRR(C1:C'.($term+1).'))^12-1');
      $cir = $sheet->getCell('C'.($term+2))->getCalculatedValue();
      $cir = round(($cir*100),2);
      $template->setValue('contractual_int', $cir.'%');

      return $template;
    }

    function SetRetail3P($template, $contract, $sheet) {
      $dealer = DealerInfo::GetDealerInfoForContract();

      $template->setValue('contractid', $contract->contract_id); 

      $template->setValue('dealername', $dealer->dealer_name);  
      $template->setValue('dealeraddress', $dealer->address);  

      $template->setValue('clientname', $contract->client_name);  
      $template->setValue('age', "Of Legal Age");  
      $template->setValue('nationality', $contract->client_nationality);
      $template->setValue('clientmarital', $contract->client_marital);  
      $template->setValue('clientaddress', $contract->client_address);
      $template->setValue('clienttin', $contract->client_tin);  

      $template->setValue('comakername', $contract->comaker_name);
      $template->setValue('comakertin', $contract->comaker_tin); 
      $template->setValue('comakermarital', $contract->comaker_marital); 
      
      $amountfinance = $contract->amount_finance;
      $amountfinanceF = floatval(preg_replace("/[^-0-9\.]/","",$amountfinance));
      $template->setValue('amountfinance', $amountfinance);
      $template->setValue('amountfinanceword', strtoupper($this->NumberToWordsConverter($contract->amount_finance)));

      $template->setValue('minstallment', $contract->monthly_installment);
      $term = $contract->term;
      $template->setValue('term', $term);
      $cdate = new Carbon($contract->firstduedate);
      $template->setValue('firstduedate', $cdate->format('F d, Y'));

      if($contract->client_city_mun_others != "")
        $citymun = $contract->client_city_mun_others;
      else {
        $citymun = $contract->GetCityMunicipality($contract->client_city_mun);

        if($citymun!=null)
          $citymun = $citymun->name;
        else
          $citymun = "";
      }

      $template->setValue('citymun', $citymun);

      $template->setValue('unitcost', $contract->unit_cost);
      $template->setValue('downpayment', $contract->downpayment);
      $template->setValue('amtfinance', $amountfinance);

      $ip = 0.0;
      $template->setValue('ip', number_format($ip, 2, '.', ','));
      $ip = floatval(preg_replace("/[^-0-9\.]/","",$ip));

      $dst = ($contract->dst <= 0 || $contract->dst == "") ? 0.0 : $contract->dst;
      $template->setValue('dst', $dst);
      $dst = floatval(preg_replace("/[^-0-9\.]/","",$dst));
      
      $regfee = ($contract->retail_type == 1) ? RegFeeTwoParty::GetRegFee($amountfinance) : RegFeeThreeParty::GetRegFee($amountfinance);
      $template->setValue('regfee', number_format($regfee, 2, '.', ','));
      $regfee = floatval(preg_replace("/[^-0-9\.]/","",$regfee));

      $nfsum = $ip+$dst+$regfee;
      $template->setValue('nfsum', number_format($nfsum, 2, '.', ',')); //sum of the above 3

      $vehicleusage = CustomField::GetFieldNameByDescAndFieldId("vehicle_usage", $contract->vehicle_usage);
      $template->setValue('vehicleusage', $vehicleusage);
      $template->setValue('vehiclemake', $contract->vehicle_make);  
      $template->setValue('vehiclemodel', $contract->vehicle_yearmodel); 
      $template->setValue('vehicleseries', $contract->GetVehicleName($contract->vehicle_name)); 
      $template->setValue('vehiclecolor', $contract->vehicle_color); 
      $template->setValue('vehiclechasis', $contract->vehicle_chasis); 
      $template->setValue('vehicleengine', $contract->vehicle_engine); 
      $template->setValue('conductionsticker', $contract->vehicle_consticker); 

      $template->setValue('witness1name', $contract->witness1_name);
      $template->setValue('witness1tin', $contract->witness1_tin); 
      $template->setValue('witness2name', $contract->witness2_name);
      $template->setValue('witness2tin', $contract->witness2_tin); 

      $localsigdetails = $contract->dealer_signatory.' '.$contract->dealer_signatory_tin;
      $template->setValue('localsignatorydetails', $localsigdetails); 

      // Names
      $template->setValue('namerow1', $dealer->dealer_name);
      $template->setValue('id1', $dealer->dealer_tin);
      $template->setValue('namerow2', $contract->dealer_signatory);
      $template->setValue('id2', $contract->dealer_signatory_govid);
      $template->setValue('namerow3', $contract->client_name);
      $template->setValue('id3', $contract->client_govid);
      $cdate = new Carbon($contract->client_dateissued);
      $template->setValue('dateIssued3', $cdate->format('m/d/Y'));
      $template->setValue('namerow4', $contract->comaker_name);
      $template->setValue('id4', $contract->comaker_govid);
      $cdate = new Carbon($contract->comaker_dateissued);
      $template->setValue('dateIssued4', $cdate->format('m/d/Y'));

      // // Set Contract Schedule
      // // Dummy data
      $interest = $this->SetAmortTable($template, $contract, $sheet);

      $template->setValue('interest', number_format($interest, 2, '.', ','));
      $interest = floatval(preg_replace("/[^-0-9\.]/","",$interest));;

      $leaseretail_fee = floatval(preg_replace("/[^-0-9\.]/","",$contract->leaseretail_fee));
      $outoftown_charge = floatval(preg_replace("/[^-0-9\.]/","",$contract->outoftown_charge));
      $other_charges = floatval(preg_replace("/[^-0-9\.]/","",$contract->other_charges));
      $servicehandling = ($leaseretail_fee + $outoftown_charge + $other_charges + Contract::GetCICharge($contract))-$regfee;
      $template->setValue('servicefee', number_format($servicehandling, 2, '.', ','));
      $servicehandling = floatval(preg_replace("/[^-0-9\.]/","",$servicehandling));

      $fcsum = $interest + $servicehandling;
      $template->setValue('fcsum', number_format($fcsum, 2, '.', ',')); // sum of the above 2

      $tempEIR = $amountfinanceF-$dst-$ip-$servicehandling-$regfee;
      $sheet->setCellValue('B1', '='.$tempEIR);
      $sheet->setCellValue('B'.($term+2), '=(1+IRR(B1:B'.($term+1).'))^12-1');
      $eir = $sheet->getCell('B'.($term+2))->getCalculatedValue();
      $eir = round(($eir*100),2);
      $template->setValue('eir', $eir.'%');

      $tempCIR = $amountfinanceF-$servicehandling;
      $sheet->setCellValue('C1', '='.$tempCIR);
      $sheet->setCellValue('C'.($term+2), '=(1+IRR(C1:C'.($term+1).'))^12-1');
      $cir = $sheet->getCell('C'.($term+2))->getCalculatedValue();
      $cir = round(($cir*100),2);
      $template->setValue('contractual_int', $cir.'%');

      return $template;
    }

    function SetAmortTable($template, $contract, $sheet) {
      $amountFinance = floatval(preg_replace("/[^-0-9\.]/","",$contract->amount_finance));
      $term = $contract->term;
      $aor = floatval(preg_replace("/[^-0-9\.]/","",$contract->add_on_rate));
      $gross = $amountFinance*(1+($aor/100));
      $mi = ceil($gross/$term);
      // dd($mi);
      // $irate = round($this->Rate($term, $mi, $amountFinance), 7);
      // $d = $this->RATE2(10, 64730, (-500000))*12;
      // $spreadsheet = new Spreadsheet();
      // $sheet = $spreadsheet->getActiveSheet();
      $sheet->setCellValue('A1', '=RATE('.$term.','.$mi.',(-'.$amountFinance.'))*12');
      $irate = $sheet->getCell('A1')->getCalculatedValue();
      // $irate = $this->Rate($term, $mi, (-$amountFinance))*12;
      // $irate = round($irate, 7);
      // dd($irate);
      // $irate = round((float)$irate * 100 ) . '%';
      $balance = $mi*$term;

      // $initialInterest = round($amountFinance*$irate*30/360, 2); //next should be based on OP
       $initialInterest = $amountFinance*$irate*30/360;
      // dd($initialInterest);
      
      $baseComp = [
        'mi'          =>  $mi, 
        'loan'        =>  $balance, 
        'ob'          =>  $balance-$mi,
        'op'          =>  $amountFinance,
        'inter'       =>  $initialInterest,
        'princi'      =>  $mi-$initialInterest,
      ];

      $sumInterest = $initialInterest;
      $sumMI = $mi;
      $sumPrinci = $baseComp['princi'];

      $compData[] = $baseComp;

      
      $ctr = 2;
      for($i = 0; $i < $term-1; $i++)
      {
        $loan = $compData[$i]['loan']-$compData[$i]['mi'];
        $op = $compData[$i]['op']-$compData[$i]['princi'];
        // $op = round($compData[$i]['op']-$compData[$i]['princi'], 4, PHP_ROUND_HALF_DOWN);
       
       // $sheet->setCellValue('A'.$ctr, '='.$compData[$i]['op'].'-'.$compData[$i]['princi']);
       // $op = $sheet->getCell('A'.$ctr)->getCalculatedValue();
        // $inter = round($op*$irate*30/360, 2, PHP_ROUND_HALF_DOWN);

       $inter = $op*$irate*30/360;

       // $inter = round($inter, 2, PHP_ROUND_HALF_DOWN);

       // $inter = round(floor($inter * 100) / 100,2); //  to round down to 2dp

        // $decimals = 2;
        // $number = $inter;
        // $number = $number * pow(10,$decimals);
        // $number = intval($number);
        // $number = $number / pow(10,$decimals);
        // $inter = $number;

       // $inter = $inter * 100;
       // $inter = floor($inter);
       // $inter = $inter / 100;

        $compData[$i+1] = [
          'mi'          =>  $mi, 
          'loan'        =>  $loan, 
          'ob'          =>  $loan-$mi,
          'op'          =>  $op,
          'inter'       =>  $inter,
          'princi'      =>  $mi-$inter,
        ];

        if($i < $term-1) {
          $sumInterest += $inter;
          $sumMI+=$mi;
          $sumPrinci += $mi-$inter;
         
        }
         $tempv = ($mi-$inter)+$inter;
          $sheet->setCellValue('B'.$ctr, '='.$tempv.'*-1');
          $sheet->setCellValue('C'.$ctr, '='.$tempv.'*-1');
          $ctr++;
      }

      // dd($sumInterest);


      $maxRowPerTable = 20;
      if($contract->term == 72)
        $maxRowPerTable = 24;

      $tableCount = count($compData);

      if($tableCount>($maxRowPerTable*2)) // until table 3
      {

        $rowCount = array();
        $difference = $tableCount;
        for($i = 0; $i < 3; $i++)
        {
          $difference = $difference - $maxRowPerTable;

          if($difference > 0) {
            $rowCount[$i] = $maxRowPerTable+1;
          }
          else
            $rowCount[$i] = $difference + $maxRowPerTable + 1;
        }

        $template->cloneRow('PeriodL', $rowCount[0]);
        $template->cloneRow('PeriodM', $rowCount[1]);
        $template->cloneRow('PeriodR', $rowCount[2]);

         // Naming Table Header
        $this->NameAmortScheduleHeader($template, "L", true);
        $this->NameAmortScheduleHeader($template, "M", true);
        $this->NameAmortScheduleHeader($template, "R", true);

      } else if($tableCount>$maxRowPerTable) // until table 2
      {

        $template->cloneRow('PeriodL', ($maxRowPerTable+1));
        $template->cloneRow('PeriodM', ($tableCount-($maxRowPerTable-1)));

        // Naming Table Header
        $this->NameAmortScheduleHeader($template, "L", true);
        $this->NameAmortScheduleHeader($template, "M", true);
        $this->NameAmortScheduleHeader($template, "R", false);


      } else { // until table 1

        $template->cloneRow('PeriodL', $tableCount);

        // Naming Table Header
        $this->NameAmortScheduleHeader($template, "L", true);
        $this->NameAmortScheduleHeader($template, "M", false);
        $this->NameAmortScheduleHeader($template, "R", false);

      }      

      $this->SetAmortScheduleValue($template, $tableCount, $maxRowPerTable, $compData);

      // dd($sumMI);

      $template->setValue('sumamtp', number_format($sumPrinci, 2, '.', ','));
      $template->setValue('sumamti', number_format($sumInterest, 2, '.', ','));
      // $template->setValue('interest', number_format($sumInterest, 2, '.', ','));
      $template->setValue('sumamtm', number_format($sumMI, 2, '.', ','));

      return $sumInterest;
    }

    function NameAmortScheduleHeader($template, $tableType, $isValue) {
      if($isValue) {
        $template->setValue('Period'.$tableType.'#1', "Period");
        $template->setValue('Loan'.$tableType.'#1', "Loan");
        $template->setValue('Principal'.$tableType.'#1', "Principal");
        $template->setValue('Interest'.$tableType.'#1', "Interest");
        $template->setValue('MI'.$tableType.'#1', "MI");
        $template->setValue('OutPrin'.$tableType.'#1', "OutPrin");
        $template->setValue('OB'.$tableType.'#1', "OB");
      } else {
        $template->setValue('Period'.$tableType, "");
        $template->setValue('Loan'.$tableType, "");
        $template->setValue('Principal'.$tableType, "");
        $template->setValue('Interest'.$tableType, "");
        $template->setValue('MI'.$tableType, "");
        $template->setValue('OutPrin'.$tableType, "");
        $template->setValue('OB'.$tableType, "");
      }
    }

    function SetAmortScheduleValue($template, $tableCount, $maxRowPerTable, $compData) {
        $rowNo = 2;
        $tableType = "L#";
        for($i = 0; $i < $tableCount; $i++) {         

          if($i == $maxRowPerTable)
          {
            $tableType = "M#";
            $rowNo = 2;
          } 

          if($i == (($maxRowPerTable*2))) {
            $tableType = "R#";
            $rowNo = 2;
          }

          $template->setValue("Period".$tableType.$rowNo, $i+1);
          $template->setValue("Loan".$tableType.$rowNo, number_format($compData[$i]['loan'], 2, '.', ','));
          $template->setValue("Principal".$tableType.$rowNo, number_format($compData[$i]['princi'], 2, '.', ','));
          $template->setValue("Interest".$tableType.$rowNo, number_format($compData[$i]['inter'], 2, '.', ','));
          $template->setValue("MI".$tableType.$rowNo,  number_format($compData[$i]['mi'], 2, '.', ','));
          // $template->setValue("OutPrin".$tableType.$rowNo,  number_format($compData[$i]['op'], 2, '.', ','));
          $op = round($compData[$i]['op'], 2, PHP_ROUND_HALF_UP);
          $template->setValue("OutPrin".$tableType.$rowNo,  number_format($op, 2, '.', ','));
          $template->setValue("OB".$tableType.$rowNo,  number_format($compData[$i]['ob'], 2, '.', ','));


          $rowNo++;

        }
    }
}
