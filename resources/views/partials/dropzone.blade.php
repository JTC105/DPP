<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Attach File for</h5>
      </div>
      <div class="modal-body ">

            <p class="alert alert-info"><span class="glyphicon glyphicon-info-sign">
            <strong>Note: File Upload Guide</strong> <br>
            &nbsp;&nbsp;&bull;&nbsp;File name should be unique. <br>
            &nbsp;&nbsp;&bull;&nbsp;Files accepted are PDF and/or RPT. <br>
            &nbsp;&nbsp;&bull;&nbsp;File size should not be exceeded to 20MB per file. <br>
            &nbsp;&nbsp;&bull;&nbsp;File name should not be exceeded to 255 characters including spaces. <br>
            &nbsp;&nbsp;&bull;&nbsp;Maximum of 10 files in a single upload. <br>
            </span>
            </p>


<form action="/ftemplatesave" class="dropzone" id="upload-file-form" method="POST" enctype="multipart/form-data" files="true">
    {{ csrf_field() }}
    <div class="fallback"><input type="file" name="file[]" multiple></div>
</form><br><br>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary pull-right" id="btnUpload">Upload</button>
      </div>


    </div>
  </div>
</div>
