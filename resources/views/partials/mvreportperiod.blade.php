<!-- Modal-->
<div id="reportMV" tabindex="-1" role="dialog" aria-labelledby="reportMVLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="reportMVLabel" class="modal-title">Report Custom Filter</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/generatereport">
      {{ csrf_field() }}

      <div class="modal-body">
  
 
             <div class="form-group row">
              <label class="col-sm-3 form-control-label">Start Date</label>
              <div class="col-sm-9">
                  <input id="rfilterStartDate" name="rfilterStartDate" class="form-control" width="276" required />
              </div>
            </div>  

            <div class="form-group row">
              <label class="col-sm-3 form-control-label">End Date</label>
              <div class="col-sm-9">
                  <input id="rfilterEndDate" name="rfilterEndDate" class="form-control" width="276" required />
              </div>
            </div> 

            @if(auth()->user()->dealer_party_id == 0)
            <div class="form-group row">
              <label class="col-sm-3 form-control-label">Dealers</label>
              <div class="col-sm-9">
              <select id="rfilterDealerId" name="rfilterDealerId" class="form-control">
                <option value="0">All Dealers</option>
                @foreach($dealers as $d)
                  <option value="{{$d->party_id}}">{{$d->dealer_name}}</option>
                @endforeach
              </select>
              </div>
            </div> 
            @endif

          <input type="hidden" id="reportType" name="reportType">

      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="submit" class="btn btn-warning"><b>Filter</b></button>
      </div>
      
      </form>

    </div>
  </div>
</div>
