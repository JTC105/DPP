<!-- Modal-->
<div id="modalFormTemplateAdd" tabindex="-1" role="dialog" aria-labelledby="modalFormTemplateAddLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalFormTemplateAddLabel" class="modal-title">Form Template</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/ftemplatesave">
      {{ csrf_field() }}

      <div class="modal-body">
  
          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="formNameA" name="formNameA" type="text" placeholder="Name" class="form-control" required>
            </div>
          </div>
          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Path</label>
            <div class="col-sm-9">
              <input id="formPathA" name="formPathA" type="text" placeholder="Path" class="form-control" required>
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


