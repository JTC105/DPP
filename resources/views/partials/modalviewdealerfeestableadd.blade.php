<!-- Modal-->
<div id="modalDealerFeesTableAdd" tabindex="-1" role="dialog" aria-labelledby="modalDealerFeesTableAddLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunAddLabel" class="modal-title">Detail</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/dealerfeestablesave">
      {{ csrf_field() }}

      <div class="modal-body">
  
        <input type="hidden" id="dftid" name="dftid" value="0">

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">From</label>
          <div class="col-sm-9">
            <input type="text" id="fromRangeA" name="fromRangeA" placeholder="From Range" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">To</label>
          <div class="col-sm-9">
            <input type="text" id="toRangeA" name="toRangeA" placeholder="To Range" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Rate</label>
          <div class="col-sm-9">
            <input type="text" id="rateA" name="rateA" placeholder="Rate" class="form-control" required>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 form-control-label">Retail Type</label>
          <div class="col-sm-9">
            <select id="retailTypeA" name="retailTypeA" class="form-control">
             @foreach($data['retailtypes'] as $d)
                <option value="{{$d->field_id}}">{{$d->field_name}}</option>
              @endforeach
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
