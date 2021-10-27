<!-- Modal-->
<div id="modalDealerFeesListAdd" tabindex="-1" role="dialog" aria-labelledby="modalDealerFeesListAddLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunAddLabel" class="modal-title">Dealer CM Fee</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/dealerfeessave">
      {{ csrf_field() }}

      <div class="modal-body">
  
        <div class="form-group row">
            <label class="col-sm-3 form-control-label">Dealer Name</label>
            <div class="col-sm-9">
             <select id="dealerIdA" name="dealerIdA" class="form-control">
                  <option value="">...</option>
                  @foreach($data['dealers'] as $d)
                    <option value="{{$d->party_id}}">{{$d->dealer_name}}</option>
                  @endforeach
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Table Reference</label>
            <div class="col-sm-9" id="dTableRefContainer">
              <select id="dTableRefA" name="dTableRefA" class="form-control">
                  <option value="">...</option>
                  @foreach($data['tablerefs'] as $d)
                    <option value="{{$d['name']}}">{{$d['name']}}</option>
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
