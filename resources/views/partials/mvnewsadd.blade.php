<!-- Modal-->
<div id="newsAddMV" tabindex="-1" role="dialog" aria-labelledby="newsAddMVLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="newsAddMVLabel" class="modal-title">Add News Details</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

 <form class="form-horizontal" method="POST" action="/newssave" enctype="multipart/form-data" files="true">
      {{ csrf_field() }}

      <div class="modal-body"> 

          <p class="alert alert-info"><i class="fas fa-info-circle"></i>
          <strong>Note: File Upload Guide</strong> <br>
          &nbsp;&nbsp;&bull;&nbsp;File uploaded will be visible to all users to view the overall Booking Guidelines. <br>
          &nbsp;&nbsp;&bull;&nbsp;File accepted is PDF. <br>
          &nbsp;&nbsp;&bull;&nbsp;Single file upload only. <br>
          </p>


          <div class="form-group row">
            <label class="col-sm-3 form-control-label">News Title</label>
            <div class="col-sm-9">
              <input type="text" id="newsTitleA" name="newsTitleA" placeholder="News Title" class="form-control">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">News Content</label>
            <div class="col-sm-9">
            <textarea class="form-control" id="newsContentA" name="newsContentA" style="height: 200px"></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Choose File</label>
              <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="nbFileA" name="nbFileA" accept=".pdf">
                    <label class="custom-file-label" for="nbFileA"></label>
                  </div>
              </div>            
          </div>

<!--           <div class="form-group row">
              <div class="col-sm-12">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="newsFile" name="newsFile" accept=".pdf">
                    <label class="custom-file-label" for="newsFile">Choose file</label>
                  </div>
              </div>            
          </div> -->

      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      
</form>

    </div>
  </div>
</div>


