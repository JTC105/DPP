<!-- Modal-->
<div id="bguidelienEditMV" tabindex="-1" role="dialog" aria-labelledby="bguidelienEditMVLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="bguidelienEditMVLabel" class="modal-title">Edit Booking Guideline Details</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

 <form class="form-horizontal" method="POST" action="/bookingguideupdate" enctype="multipart/form-data" files="true">
      {{ csrf_field() }}

      <div class="modal-body"> 

        <input type="hidden" id="bgid" name="bgid">

          <p class="alert alert-info"><i class="fas fa-info-circle"></i>
          <strong>Note: File Upload Guide</strong> <br>
          &nbsp;&nbsp;&bull;&nbsp;File uploaded will be visible to all users to view the overall Booking Guidelines. <br>
          &nbsp;&nbsp;&bull;&nbsp;File accepted is PDF. <br>
          &nbsp;&nbsp;&bull;&nbsp;Single file upload only. <br>
          </p>

          <div class="form-group row">
            <label class="col-sm-2 form-control-label">Summary</label>
            <div class="col-sm-10">
            <textarea class="form-control" id="bookingGuideContent" name="bookingGuideContent" style="height: 200px"></textarea>
            </div>
          </div>

          <div class="form-group row">
              <div class="col-sm-12">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="bookingGuidelineFile" name="bookingGuidelineFile" accept=".pdf">
                    <label class="custom-file-label" for="bookingGuidelineFile">Choose file</label>
                  </div>
              </div>            
          </div>

      </div>

      <div class="modal-footer">
        <button type="button" id="btnResetForm2" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      
</form>

    </div>
  </div>
</div>


