<!-- Modal-->
<div id="modalRoleUser" tabindex="-1" role="dialog" aria-labelledby="modalRoleUserLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalRoleUserbel" class="modal-title">Assign User</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form class="form-horizontal" method="POST" action="/admin/rolesaveuser">
      {{ csrf_field() }}

      <input type="hidden" id="aurid" name="aurid">

      <div class="modal-body">
        
           <div class="table-responsive">                       
            <table class="table table-striped table-hover tableWithBorder">
              <thead>
                <tr style="background-color: white">
                  <th>USERNAME</th>
                </tr>
              </thead>
              <tbody id="assignedUserBodyCont">
               <tr>
                <td>No user.</td>
                </tr>
              </tbody>
            </table>
          </div>

          <br>

          <div class="form-group row">
            <label class="col-sm-2 form-control-label">Users</label>
            <div class="col-sm-9 rUserListContainer">
              <select id="rUserList" name="rUserList[]" class="form-control" multiple="multiple" style="width: 100%">
                
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


