<!-- Modal-->
<div id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="modalEditUserLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalEditUserLabel" class="modal-title">User</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form method="POST" action="/admin/userupdate" autocomplete="off">

      <div class="modal-body">       
          {{ csrf_field() }}

          <input type="hidden" id="uid" name="uid">
          <input type="hidden" id="urole" name="urole">

          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Username</label>
            <div class="col-sm-8">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">tfs</span></div>
                <input type="text" id="uname" name="uname" placeholder="Username" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Reset Password</label>
            <div class="col-sm-8">
              <input id="isResetPsswrd" name="isResetPsswrd" type="checkbox" class="form-control-custom">
              <label for="isResetPsswrd" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>

          <div class="form-group row resetPassContainer">
            <label class="col-sm-4 form-control-label"></label>
            <div class="col-sm-8">
              <input type="password" id="uPass" name="uPass" class="form-control" data-toggle="password">
            </div>
          </div>
        
          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Account Active</label>
            <div class="col-sm-8">
              <input id="isActive" name="isActive" type="checkbox" class="form-control-custom">
              <label for="isActive" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-4 form-control-label">Account Locked</label>
            <div class="col-sm-8">
              <input id="isLocked" name="isLocked" type="checkbox" class="form-control-custom">
              <label for="isLocked" class="checkbox-custom-label"> &nbsp;&nbsp;</label>
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


