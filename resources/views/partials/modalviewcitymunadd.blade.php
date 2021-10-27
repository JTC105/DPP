<!-- Modal-->
<div id="modalCitymunAdd" tabindex="-1" role="dialog" aria-labelledby="modalCitymunAddLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunAddLabel" class="modal-title">City / Municipality</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/citymunsave">
      {{ csrf_field() }}

      <div class="modal-body">
  
          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="citymunNameA" name="citymunNameA" type="text" placeholder="Name" class="form-control" required>
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


