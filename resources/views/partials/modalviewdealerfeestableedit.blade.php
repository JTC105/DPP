<!-- Modal-->
<div id="modalDealerFeesTableEdit" tabindex="-1" role="dialog" aria-labelledby="modalDealerFeesTableEditLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunAddLabel" class="modal-title">Detail</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/dealerfeestableupdate">
      {{ csrf_field() }}

      <div class="modal-body">
  
        <input type="hidden" id="dftid" name="dftid" value="{{$data['tableId']}}">
        <input type="hidden" id="dfrid" name="dfrid">

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">From</label>
          <div class="col-sm-9">
            <input type="text" id="fromRange" name="fromRange" placeholder="From Range" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">To</label>
          <div class="col-sm-9">
            <input type="text" id="toRange" name="toRange" placeholder="To Range" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Rate</label>
          <div class="col-sm-9">
            <input type="text" id="rate" name="rate" placeholder="Rate" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Retail Type</label>
          <div class="col-sm-9">
            <select id="retailType" name="retailType" class="form-control">
             
            </select>
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
