<!-- Modal-->
<div id="modalVehicleAdd" tabindex="-1" role="dialog" aria-labelledby="modalVehicleAddLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalVehicleAddLabel" class="modal-title">Vehicle</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/vehiclesave">
      {{ csrf_field() }}

      <div class="modal-body">
  
          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="vehicleNameA" name="vehicleNameA" type="text" placeholder="Name" class="form-control" required>
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


