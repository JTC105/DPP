<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

use Alert;
use Carbon\Carbon;

use App\Model\AppContract;
use App\Model\Contract;
use App\Model\DealerInfo;
use App\Model\Permission;

class ReportGenerateController extends Controller
{
    public function index() {
        $dealers = DealerInfo::where('is_active', 1)->orderBy('dealer_name', 'ASC')->get();

        return view('pages.admin.reportlist', compact('dealers'));
    }

    public function generatereport(Request $request) {
        
        $this->validate($request,[
            'reportType'    => 'numeric|regex:/(^[1-2]+$)/',
            ],
            [
                'reportType.numeric'  => 'The type of report format is invalid.',
                'reportType.regex'    => 'The type of report format is invalid.',
            ]);


        $start = request('rfilterStartDate');
        $end = request('rfilterEndDate');

        $startC = Carbon::parse($start);
        $endC = Carbon::parse($end);

        $length = $endC->diffInDays($startC);
        $allowed = false;

        if (Permission::IfDateRestricted()) {
            if($length < 32)
                $allowed = true;
        } else {
            $allowed = true;
        }

        if($allowed) {

            $reportType = request('reportType');
            if($reportType == 1 || $reportType == 2) {

                if(auth()->user()->dealer_party_id != 0)
                {
                    $dealerId = auth()->user()->dealer_party_id;
                } else {
                    $dealerId = request('rfilterDealerId');
                }
                

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $sheet->setCellValue('A1', 'Toyota Financial Services Philippines Corporation');
                $sheet->setCellValue('A3', 'For the Period of '.$start. ' - ' .$end);

                // Column Headers
                $sheet->setCellValue('A5', 'CONTRACT');
                $sheet->setCellValue('B5', 'ACCOUNT');
                $sheet->setCellValue('C5', 'DEALER');
                $sheet->setCellValue('D5', 'STATUS');
                $sheet->setCellValue('E5', 'CREDIT APPROVAL DATE');
                $sheet->setCellValue('F5', 'CREDIT APPROVAL VALIDITY');
                $sheet->setCellValue('G5', 'RECON DATE');
                $sheet->setCellValue('H5', 'CREDIT APPROVAL RECON DATE');


                if($reportType == 1)
                    $sheet = $this->generateappcon($sheet, $dealerId, $start, $end);
                else 
                    $sheet = $this->generatecon($sheet, $dealerId, $start, $end);


                $filename = 'report';
                $writer = new Xlsx($spreadsheet);
                $writer->save($filename.'.xlsx');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
                $writer->save("php://output");
                exit;

            }
        } else {
            Alert::success('','Cannot generate more than 31 days.','');
        }

        return back();

    }

    public function generateappcon($sheet, $dealerId, $start, $end) {

         $sheet->setCellValue('A2', 'Approve Contract (Dealer)');
        

          $start = Carbon::parse($start)->format('d-M-Y');
          // $end = Carbon::parse($end)->addDay()->format('d-M-Y');  
        $end = Carbon::parse($end)->format('d-M-Y');  

         // Row 6
        if($dealerId!=0)
            $contracts = AppContract::GetAppConListByDateAndDealerReport($dealerId ,$start, $end);
        else
            $contracts = AppContract::GetAppConListByDateAllReport($start, $end);


        $i = 6;
         for($x=0;$x<count($contracts);$x++) {

            $recondate1 = Carbon::parse($contracts[$x]->recon_dt)->format('m/d/Y');
            if($contracts[$x]->recon_dt == null || $contracts[$x]->recon_dt == "") 
                $recondate1 = "NONE";

            $sheet->setCellValue('A'.$i, $contracts[$x]->contract_id);
            $sheet->setCellValue('B'.$i, $contracts[$x]->client);
            $sheet->setCellValue('C'.$i, $contracts[$x]->dealer);
            $sheet->setCellValue('D'.$i, $contracts[$x]->contract_status);
            $sheet->setCellValue('E'.$i, Carbon::parse($contracts[$x]->credit_app_dt)->format('m/d/Y'));
            $sheet->setCellValue('F'.$i, Carbon::parse($contracts[$x]->credit_app_validity)->format('m/d/Y'));
            $sheet->setCellValue('G'.$i, $recondate1);
            $recondate = $contracts[$x]->credit_app_recon_dt;

            if($recondate == "" || $recondate == null) {
                $recondate = "";
            } else {
                $recondate = Carbon::parse($contracts[$x]->credit_app_recon_dt)->format('m/d/Y');
            }

            if($recondate1 == "NONE")
                $recondate = "NONE";

            $sheet->setCellValue('H'.$i, $recondate);
            $i++;
        }
        
        return $sheet;
    }


    public function generatecon($sheet, $dealerId, $start, $end) {

        $sheet->setCellValue('A2', 'Line up for Booking (Dealer)');
        $sheet->setCellValue('I5', 'CONTRACT ADDED (DPPS)'); // Additional column


        // Row 6
        if($dealerId!=0)
            $contracts = Contract::GetContractsByDateRangeReport($dealerId ,$start, $end);
        else
            $contracts = Contract::GetContractsByDateRangeAllDealerReport($start, $end);

        $i = 6;
        foreach ($contracts as $d) {

            $dealer = DealerInfo::GetDealerInfo($d->dealer_id);

            if($dealer != null)
                $dealer = $dealer->dealer_name;
            else
                $dealer = "NONE";

            $recondate = Carbon::parse($d->recon_date)->format('m/d/Y');
            $carecondate = Carbon::parse($d->credit_approval_recon_date)->format('m/d/Y');
            if($recondate == '01/01/1900' || $d->recon_date == "") {
                $recondate = "NONE";
                $carecondate = "NONE";
            }

            $sheet->setCellValue('A'.$i, $d->contract_id);
            $sheet->setCellValue('B'.$i, $d->client_name);
            $sheet->setCellValue('C'.$i, $dealer);
            $sheet->setCellValue('D'.$i, $d->status);
            $sheet->setCellValue('E'.$i, Carbon::parse($d->credit_approval_date)->format('m/d/Y'));
            $sheet->setCellValue('F'.$i, Carbon::parse($d->credit_approval_validity)->format('m/d/Y'));
            $sheet->setCellValue('G'.$i, $recondate);
            $sheet->setCellValue('H'.$i, $carecondate); 
            $sheet->setCellValue('I'.$i, Carbon::parse($d->created_at)->format('m/d/Y')); 
            $i++;
        }

        return $sheet;
    }


}
