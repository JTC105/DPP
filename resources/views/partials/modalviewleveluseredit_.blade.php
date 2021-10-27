<!-- Modal-->
<div id="modalLevel2User" tabindex="-1" role="dialog" aria-labelledby="modalLevel2UserLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalLevel2UserLabel" class="modal-title">Level 2 User</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/userupdatel2">
      {{ csrf_field() }}

      <div class="modal-body">       
          <div id="addDealerInfoContainer">
            <p>Default password is <span class="psswrd-label">{{$dataPass['custom']}}</span>.</p>
          </div>

          <input type="hidden" id="uidL2" name="uidL2">
          <input type="hidden" id="uroleL2" name="uroleL2">

          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Username</label>
            <div class="col-sm-8">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">tfs</span></div>
                <input type="text" id="unameL2" name="unameL2" placeholder="Username" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Reset Password</label>
            <div class="col-sm-4">
              <input id="isResetPsswrdL2" name="isResetPsswrdL2" type="checkbox" class="form-control-custom">
              <label for="isResetPsswrdL2" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>
        
          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Active Account</label>
            <div class="col-sm-4">
              <input id="isActiveL2" name="isActiveL2" type="checkbox" class="form-control-custom">
              <label for="isActiveL2" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
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


