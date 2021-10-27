<!-- Modal-->
<div id="modalCitymunEdit" tabindex="-1" role="dialog" aria-labelledby="modalCitymunEditLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunEditLabel" class="modal-title">City / Municipality</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/citymunupdate">
      {{ csrf_field() }}

      <div class="modal-body">
        
          <input type="hidden" id="cmid" name="cmid">

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="citymunName" name="citymunName" type="text" placeholder="Name" class="form-control form-control-success" required>
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


