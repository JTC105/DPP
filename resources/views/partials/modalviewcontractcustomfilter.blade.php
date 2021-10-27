<!-- Modal-->
<div id="modalCCustomCount" tabindex="-1" role="dialog" aria-labelledby="modalCCustomCountLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalCitymunAddLabel" class="modal-title">Contract Custom Filter</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" onsubmit="get_action(this);">
      {{ csrf_field() }}

      <div class="modal-body">
  
          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Filter Type</label>
            <div class="col-sm-9">
              <select id="cfilterType" name="cfilterType" class="form-control">
                  <option value="0" {{ $dataFilter['filter'] == '0' ? 'selected' : '' }}>By Date Range</option>
                  <option value="1" {{ $dataFilter['filter'] == '1' ? 'selected' : '' }}>All Contracts</option>
              </select>
            </div>
          </div>

          <div id="byDateRangeContainer">
             <div class="form-group row">
              <label class="col-sm-3 form-control-label">Start Date</label>
              <div class="col-sm-9">
                  <input id="cfilterStartDate" name="cfilterStartDate" class="form-control" width="276" required value="{{ $dataFilter['start'] }}" />
              </div>
            </div>  

            <div class="form-group row">
              <label class="col-sm-3 form-control-label">End Date</label>
              <div class="col-sm-9">
                  <input id="cfilterEndDate" name="cfilterEndDate" class="form-control" width="276" required value="{{ $dataFilter['end'] }}" />
              </div>
            </div> 
          </div> 


      </div>

      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <button type="submit" class="btn btn-warning"><b>Filter</b></button>
      </div>
      
      </form>

    </div>
  </div>
</div>
