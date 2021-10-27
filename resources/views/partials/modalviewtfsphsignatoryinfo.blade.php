<!-- Modal-->
<div id="modalaSigDetail" tabindex="-1" role="dialog" aria-labelledby="modalaSigDetailLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalaSigDetailLabel" class="modal-title">TFSPH Signatory Detail</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/tfssigsave">
      {{ csrf_field() }}
      <div class="modal-body">
        
          <input type="hidden" id="tsid" name="tsid" value="0">

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="sig_name" name="sig_name" type="text" placeholder="Name" class="form-control" required>
            </div>
          </div>

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Position</label>
            <div class="col-sm-9">
              <input id="sig_pos" name="sig_pos" type="text" placeholder="Position" class="form-control" required>
            </div>
          </div>

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">TIN</label>
            <div class="col-sm-9">
              <input id="sig_tin" name="sig_tin" type="text" placeholder="###-###-###" class="form-control" required>
            </div>
          </div>

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Government ID</label>
            <div class="col-sm-9">
              <input id="sig_govtid" name="sig_govtid" type="text" placeholder="##-#######-#" class="form-control" required>
            </div>
          </div>
       
        
      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>

       </form>

    </div>
  </div>
</div>


