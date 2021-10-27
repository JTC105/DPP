<!-- Modal-->
<div id="modalDealerFeesListEdit" tabindex="-1" role="dialog" aria-labelledby="modalDealerFeesListEditLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunAddLabel" class="modal-title">Dealer CM Fee</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/dealerfeesupdate">
      {{ csrf_field() }}

      <div class="modal-body">
  
        <input type="hidden" id="dfid" name="dfid">

        <div class="form-group row">
            <label class="col-sm-3 form-control-label">Dealer Name</label>
            <div class="col-sm-9" id="dealerName">
              ---
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">CM Fees Table Reference</label>
            <div class="col-sm-9" id="dTableRefContainer">
              <select id="dTableRef" name="dTableRef" class="form-control">
                  
              </select>
            </div>
          </div>

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">CM Fees 2 Party</label>
            <div class="col-sm-9">
              <input id="cmfee2" name="cmfee2" type="text" placeholder="0.00" class="form-control" required>
            </div>
          </div>


         <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">CM Fees 3 Party</label>
            <div class="col-sm-9">
              <input id="cmfee3" name="cmfee3" type="text" placeholder="0.00" class="form-control" required>
            </div>
          </div>


         <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Lease Fee</label>
            <div class="col-sm-9">
              <input id="leasefee" name="leasefee" type="text" placeholder="0.00" class="form-control" required>
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
