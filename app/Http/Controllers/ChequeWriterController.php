<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

use App\Model\Cheque;

class ChequeWriterController extends Controller
{
    public function index() {

      return view('pages.chequewriter');
    }

    public function print(Request $request) {
      $date = request('startDate');
      $amount = request('recurringAmount');

      $data = [
        'date'    => $date,
        'amount'  => $amount,
      ];

    $fileSource = public_path()."/uploads/cheque/templates/";
    $modFileDestination = "uploads/cheque/";
    $fileDestination = public_path().'/'.$modFileDestination;
    $fileName = Cheque::GetPrefixFilename().'_'.Cheque::GetPrintTemplateName();

    $template = $this->SetChequeWriterDetails($fileSource, $data);

    $docFile = $fileDestination.$fileName.'.docx';

    $template->saveAs($docFile);

     $word = new \COM("Word.Application") or die ("Could not initialise Object.");
      // set it to 1 to see the MS Word window (the actual opening of the document)
      $word->Visible = 0;
      // recommend to set to 0, disables alerts like "Do you want MS Word to be the default .. etc"
      $word->DisplayAlerts = 0;
      // open the word 2007-2013 document
      $word->Documents->Open($docFile);
      // convert word 2007-2013 to PDF
      $word->ActiveDocument->ExportAsFixedFormat($fileDestination.$fileName.'.pdf', 17, false, 0, 0, 0, 0, 7, true, true, 2, true, true, false);
      // quit the Word process
      $word->Quit(false);
      // clean up
      unset($word);

      return redirect('./'.$modFileDestination.$fileName.'.pdf');
    }

    public function SetChequeWriterDetails($fileSource, $data) {

      $file = $fileSource.Cheque::GetPrintTemplateName();

      $template = new \PhpOffice\PhpWord\TemplateProcessor($file.'.docx');  

      $date = new Carbon($data['date']);
      $template->setValue('date', $date->format('F d, Y'));
      $template->setValue('amount', $data['amount']); 
      $template->setValue('amount_word', ucwords($this->NumberToWordsConverter($data['amount']))); 

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
}
