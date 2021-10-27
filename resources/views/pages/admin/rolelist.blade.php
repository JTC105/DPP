@extends('layouts.basepagemod')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Role List</h1>
          </header>
          @include('includes.errormod')
          
          <!-- Role Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">

              <div class="card-header d-flex align-items-center">    
                @permission('role-add')
                <button type="button" data-toggle="modal" data-target="#modalRole" class="btn btn-primary resetRoleInfo"><i class="fa fa-plus" aria-hidden="true"></i> Add Role</button> 
                
                @endpermission

                &nbsp;&nbsp;&nbsp;   
                @permission('role-assign-perms')
                <a id="view" class="btn btn-primary" href="/admin/rolepermlist"><i class="fas fa-sliders-h"></i></i> Assign Role to Permissions</a>
                @endpermission
              </div>

              <div class="card-body">   
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="rolelistTable">
                    <thead>
                      <tr>
                        <th>Role Name</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['roles']!=null)
                      @foreach($data['roles'] as $d)
                      <tr>
                        <td>{{ $d->display_name }}</td>
                        <td>
                          @if($d->name != "lo")
                          @permission('role-assign-users')
                           <button type="button" data-toggle="modal" data-target="#modalRoleUser" class="btn btn-primary showAssignedUserRole" data-info="{{$d->id}}" rel="tooltip" title="Assign Role to Users"><i class="fas fa-user-shield"></i></button>
                            @include('partials.roles.mvroleuser')
                          @endpermission

                          @permission('role-edit')
                          <button type="button" data-toggle="modal" data-target="#modalRole" class="btn btn-default showRoleInfo" data-info="{{$d->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission
                          @endif

                           {{-- <button type="button" data-toggle="modal" data-target="#" class="btn btn-default" data-info="{{$d->id}}" rel="tooltip" title="View Permission"><i class="fas fa-search"></i></button> --}}
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                  <br><br>

                </div>

              </div>
            </div>
            @include('partials.roles.mvrole')
          </section>

        </div>
      </section>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#rUserList').select2(); 
      // $("#rUserList").select2({
      //   placeholder: "Assign a user. . .",
      //   allowClear: true,
      //   theme: "classic"
      // });

    // $('#rUserList2').select2();

    // var table = $('#rolelistTable').DataTable( {
    //     order: [[2, 'asc'], [0, 'asc']],
    //     rowGroup: {
    //         dataSrc: 0
    //     }
    // } );
} );

</script>
@endsection

