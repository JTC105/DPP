<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Alert;

use App\Model\BookingGuideline;
use App\Model\NewsBulletin;
use App\Model\Policy;

class DashboardController extends Controller
{
    public function index()
    {
        $showWarning = Policy::CheckIfPasswordExpiredWarning();
        // $expiryDate = Policy::GetPassExpiryDate();
        $days = Policy::GetPassExpiryDateInDays();

        $news = NewsBulletin::GetNews();
        $newsall = NewsBulletin::GetAllNews();
        $guide = BookingGuideline::GetGuidelineSummary();

        $data = [
            'showWarning'   => $showWarning,
            // 'expiryDate' => $expiryDate,
            'days'          => $days,
            'news'          => $news,
            'newsall'       => $newsall,
            'guides'        => $guide,
        ];

        return view('pages.dashboard', compact('data'));
    }

     public function storenews(Request $request)
    {
       $this->validate($request,[
            'newsTitleA'         => 'required|regex:/(^[-0-9A-Za-z.,\/()&\' ]+$)/',
            'newsContentA'       => 'required|regex:/(^[-0-9A-Za-z.,\/()&\' ]+$)/',
            ],[
                'newsTitleA.regex'    => 'The news title format is invalid.',
                'newsContentA.regex'    => 'The news content format is invalid.',
            ]);

        $d= new NewsBulletin();
        $d->title = request('newsTitleA');
        $d->content = request('newsContentA');
        $d->creator = auth()->user()->username;
        $d->save();

        if ($request->hasFile('nbFileA')) {
          
              $file = request('nbFileA');

              $fileFull = $file->getClientOriginalName();
              $fileNameArray = explode(".", $fileFull);

              $filename = $fileNameArray[0];
              $filesize = $file->getClientSize()/1024;
              $filesize = round($filesize, 2);
              $path = NewsBulletin::GetSourcepathNB();

              $datenow = Carbon::now('Asia/Manila')->format('Ymd');
             
              $nbFilename = $datenow."_newsbulletin";

              $file->move(public_path($path),$nbFilename.".pdf");

              $d->filename = $nbFilename;
              $d->path = $path;
              $d->size = $filesize;
              $d->save();

            }

        Alert::success('','News Saved');

        // AdminLogController::WriteLog('news-add',"");

        return back();
    }

    public function editnews(Request $request) {
        $d = NewsBulletin::where('id', request('id'))->first();

        return $d;
    }

    public function updatenews(Request $request)
    {
        $this->validate($request,[
            'nid'               => 'numeric',
            'newsTitle'         => 'required|regex:/(^[-0-9A-Za-z.,\/()&\' ]+$)/',
            'newsContent'       => 'required|regex:/(^[-0-9A-Za-z.,\/()&\' ]+$)/',
            ],[
                'nid.numeric'           => 'Input invalid.',
                'newsTitle.regex'      => 'The news title format is invalid.',
                'newsContent.regex'    => 'The news content format is invalid.',
            ]);

        $d = NewsBulletin::find(request('nid'));
        $is_news_visible = 0;
        if($d!=null) {
            if(request('isNewsVisible') == "on")
                $is_news_visible = 1;

            $d->title = request('newsTitle');
            $d->content = request('newsContent');
            $d->is_visible = $is_news_visible;
            $d->save();

            if ($request->hasFile('nbFile')) {
          
              $file = request('nbFile');

              $fileFull = $file->getClientOriginalName();
              $fileNameArray = explode(".", $fileFull);

              $filename = $fileNameArray[0];
              $filesize = $file->getClientSize()/1024;
              $filesize = round($filesize, 2);
              $path = NewsBulletin::GetSourcepathNB();

              $datenow = Carbon::now('Asia/Manila')->format('Ymd');
             
              $nbFilename = $datenow."_newsbulletin_".$d->id;

              $file->move(public_path($path),$nbFilename.".pdf");

              $d->filename = $nbFilename;
              $d->path = $path;
              $d->size = $filesize;
              $d->save();

            }

            Alert::success('','News Saved');

            // AdminLogController::WriteLog('news-edit',"");
        }

        return back();
    }

    public function editbookingguide(Request $request) {
        $d = BookingGuideline::where('id', request('id'))->first();

        return $d;
    }

    public function storebookingguide(Request $request)
    {

        $this->validate($request,[
            'bookingGuideContentA'       => 'required|regex:/(^[-0-9A-Za-z.,\/()<>\n&\' ]+$)/',
            ],[
                'bookingGuideContentA.regex'    => 'The news content format is invalid.',
            ]);

        $d = new BookingGuideline();
        if($d!=null) {
            $d->content = request('bookingGuideContentA');
            $d->creator = auth()->user()->username;
            $d->save();

            if ($request->hasFile('bookingGuidelineFile')) {
          
              $file = request('bookingGuidelineFile');

              $fileFull = $file->getClientOriginalName();
              $fileNameArray = explode(".", $fileFull);

              $filename = $fileNameArray[0];
              $filesize = $file->getClientSize()/1024;
              $filesize = round($filesize, 2);
              $path = BookingGuideline::GetSourcepath();

              $datenow = Carbon::now('Asia/Manila')->format('Ymd');
             
              $bgFilename = $datenow."_bookinguideline_".$d->id;

              $file->move(public_path($path),$bgFilename.".pdf");

              $d->filename = $bgFilename;
              $d->path = $path;
              $d->size = $filesize;
              $d->save();

            } 

            Alert::success('','Booking Guideline Saved');

            // AdminLogController::WriteLog('booking-guide-edit',"");
        }

        return back();
    }

    public function updatebookingguide(Request $request)
    {

        $this->validate($request,[
            'bgid'               => 'numeric',
            'bookingGuideContent'       => 'required|regex:/(^[-0-9A-Za-z.,\/()<>\n&\' ]+$)/',
            ],[
                'bgid.numeric'           => 'Input invalid.',
                'bookingGuideContent.regex'    => 'The news content format is invalid.',
            ]);
        $id = request('bgid');
        $d = BookingGuideline::find($id);
        if($d!=null) {
            $d->content = request('bookingGuideContent');
            $d->creator = auth()->user()->username;
            $d->save();

            if ($request->hasFile('bookingGuidelineFile')) {
          
              $file = request('bookingGuidelineFile');

              $fileFull = $file->getClientOriginalName();
              $fileNameArray = explode(".", $fileFull);

              $filename = $fileNameArray[0];
              $filesize = $file->getClientSize()/1024;
              $filesize = round($filesize, 2);
              $path = BookingGuideline::GetSourcepath();

              $datenow = Carbon::now('Asia/Manila')->format('Ymd');
             
              $bgFilename = $datenow."_bookinguideline_".$id;

              $file->move(public_path($path),$bgFilename.".pdf");

              $d->filename = $bgFilename;
              $d->path = $path;
              $d->size = $filesize;
              $d->save();

            } 

            Alert::success('','Booking Guideline Saved');

            // AdminLogController::WriteLog('booking-guide-edit',"");
        }

        return back();
    }

    public function viewbookingguide($id) {
      $bg = BookingGuideline::find($id);

      $bgFilename = $bg->filename;
      $path = BookingGuideline::GetSourcepath();

      $pdfFilePath = './'.$path.$bgFilename.'.pdf';
    
      return redirect($pdfFilePath);
    }


    public function viewnewsbulletin($id) {
      $nb = NewsBulletin::find($id);

      $nbFilename = $nb->filename;
      $path = NewsBulletin::GetSourcepathNB();

      $pdfFilePath = './'.$path.$nbFilename.'.pdf';
    
      return redirect($pdfFilePath);
    }

}
