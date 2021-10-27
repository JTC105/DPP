<!-- Modal-->
<div id="modalACCustomFilter" tabindex="-1" role="dialog" aria-labelledby="modalACCustomFilterLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalACCustomFilterLabel" class="modal-title">Contract Custom Filter</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" onsubmit="get_action(this);">
      {{ csrf_field() }}

      <div class="modal-body">
  
          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Filter Type</label>
            <div class="col-sm-9">
              <select id="acfilterType" name="acfilterType" class="form-control">
                  <option value="0" {{ $dataFilter['filter'] == '0' ? 'selected' : '' }}>By Date Range</option>
                  <option value="1" {{ $dataFilter['filter'] == '1' ? 'selected' : '' }}>By Contract</option>
                  <option value="2" {{ $dataFilter['filter'] == '2' ? 'selected' : '' }}>By Client Name</option>
              </select>
            </div>
          </div>

          <div id="byDateContainer">
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

          <div id="byContractContainer">
             <div class="form-group row">
              <label class="col-sm-3 form-control-label">Contract ID</label>
              <div class="col-sm-9">
                  <input type="text" id="cID" name="cID" class="form-control" width="276" value="{{ $dataFilter['cID'] }}" />
              </div>
            </div>  
          </div> 

          <div id="byNameContainer">
             <div class="form-group row">
              <label class="col-sm-3 form-control-label">Client Name</label>
              <div class="col-sm-9">
                  <input type="text" id="cName" name="cName" class="form-control" width="276" value="{{ $dataFilter['cName'] }}" />
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
