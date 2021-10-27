<!-- Modal-->
<div id="modalRole" tabindex="-1" role="dialog" aria-labelledby="modalRoleLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalRoleLabel" class="modal-title">Role</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/rolesave">
      {{ csrf_field() }}

      <input type="hidden" id="rid" name="rid">

      <div class="modal-body">
  
          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Name</label>
            <div class="col-sm-9">
              <input id="roleName" name="roleName" type="text" placeholder="Name" class="form-control" required>
            </div>
          </div>

          <div class="form-group row formRow">
            <label class="col-sm-3 form-control-label">Description</label>
            <div class="col-sm-9">
              <input id="roleDesc" name="roleDesc" type="text" placeholder="Short Description" class="form-control">
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


