<!-- Modal-->
<div id="modalAddAdmin" tabindex="-1" role="dialog" aria-labelledby="modalAddAdminLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <h4 id="modalAddAdminLabel" class="modal-title">Add Admin</h4>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>

      <form method="POST" action="/admin/usersaveadmin">

      <div class="modal-body">
         {{--<p>Default password is <span class="psswrd-label">{{$dataPass['admin']}}</span></p>--}}
       
          {{ csrf_field() }}

          <div class="form-group row">
            <div class="col-sm-12">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">tfs</span></div>
                <input type="text" id="username" name="username" placeholder="Username" class="form-control" required>
              </div>
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


