Dropzone.autoDiscover = false;
var myDropzone = new Dropzone('#upload-file-form', {
    paramName: "file",
    url: '/ftemplatesave',
    method: 'post',
    maxFilesize: 20, 
    maxFiles: 10,
    parallelUploads: 4,
    uploadMultiple: true,
    autoProcessQueue: false,
    acceptedFiles:  ".pdf,.rpt", 
    addRemoveLinks: true,

    init: function() {   
      // You might want to show the submit button only when 
      // files are dropped here:
      this.on("addedfile", function() {
        // Show submit button here and/or inform user to click it.
      });
      this.on("sending", function(file, xhr, formData) {
    
      });
      this.on("complete", function (file) {
      if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
          setTimeout(function(){
              location.reload();
             },1000);
      }
  });
  }

});
$('#btnUpload').on('click', function(){
    myDropzone.processQueue();
});
