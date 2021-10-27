<!-- Modal-->
<div id="modalDealerInfo" tabindex="-1" role="dialog" aria-labelledby="modalDealerInfoLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalDealerInfoLabel" class="modal-title">Dealer Information</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      
       
      
      <form class="form-horizontal" method="POST" action="/admin/dealersave">
      {{ csrf_field() }}
      <div class="modal-body">
          <div class="addDealerInfoContainer">
            <p>Dealer will automatically be added in the list of Users as a Dealer User. {{--Default password is <span class="psswrd-label">{{$dataPass['dealer']}}</span>.--}}</p>
          </div>

          <input type="hidden" id="diid" name="diid" value="0">

          <div id="editDealerInfoContainer">
          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Party ID</label>
            <div class="col-sm-9" id="partyId">
              ...
            </div>
          </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Party No.</label>
            <div class="col-sm-9">
              <input id="partyNo" name="partyNo" type="number" placeholder="Party No." class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="dealerName" name="dealerName" type="text" placeholder="Name" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Reference</label>
            <div class="col-sm-9">
              <input id="dReference" name="dReference" type="text" placeholder="Reference" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Address</label>
            <div class="col-sm-9">
              <textarea id="dAddress" name="dAddress" class="form-control" required></textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">TIN</label>
            <div class="col-sm-9">
              <input id="dTin" name="dTin" type="text" placeholder="###-###-###" class="form-control" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Metro</label>
            <div class="col-sm-9">
              <input id="isMetro" name="isMetro" type="checkbox" class="form-control-custom">
              <label for="isMetro" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Two Party</label>
            <div class="col-sm-9">
              <input id="isTwoParty" name="isTwoParty" type="checkbox" class="form-control-custom">
              <label for="isTwoParty" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 form-control-label">Three Party</label>
            <div class="col-sm-9">
              <input id="isThreeParty" name="isThreeParty" type="checkbox" class="form-control-custom">
              <label for="isThreeParty" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>

          <div class="form-group row" id="activeContainer">
            <label class="col-sm-3 form-control-label">Active</label>
            <div class="col-sm-9">
              <input id="isActive" name="isActive" type="checkbox" class="form-control-custom">
              <label for="isActive" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>

          <div class="addDealerInfoContainer">
          <p class="alert alert-danger"><i class="fas fa-info-circle"></i> <b>Note: Please make sure to update the Dealer Fees details after adding the dealer.</b></p>
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


