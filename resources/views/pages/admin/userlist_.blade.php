@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">User List</h1>
          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">

              <div class="card-header d-flex align-items-center">    
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   Add User
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                    {{--@permission('uadmin-add')
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalAddAdmin">Admin</a>                    
                    @endpermission--}}
                    <a class="dropdown-item setUserLevel" href="#" data-toggle="modal" data-target="#modalAddLevel" data-info="2">User</a>
                    {{-- <a class="dropdown-item setUserLevel" href="#" data-toggle="modal" data-target="#modalAddLevel" data-info="3">Level 3 User</a> --}}

                  </div>
                </div>   
                 @include('partials.modalviewuseraddadmin') 
                 @include('partials.modalviewuseraddlevel')                 
              </div>
              
              <div class="card mt-3 tab-card">
              <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  {{--@permission('uadmin-view-list')
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link {{ $data['display']['admin'] }}" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Admin</a>
                  </li>
                  @endpermission--}}             
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link {{ $data['display']['n_admin'] }}" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false"> Users</a>
                  </li>
                  @permission('udealer-view-list')
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="true">Dealer Users</a>
                  </li>
                  @endpermission
                  </li>
                </ul>
              </div>
              @include('partials.modalviewuseredit')

              <div class="tab-content" id="myTabContent">

                {{--@permission('uadmin-view-list')
                <div class="tab-pane fade {{ $data['display']['admin'] }} p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="adminlistTable">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data['admins'] as $d)
                      <tr>
                        <td>{{ $d['user']->username }}</td>
                        <td class="role-label">{{ $d['role']->display_name }}</td>
                        <td class="role-label">{{ ($d['user']->is_active == 1) ? 'ACTIVE' : 'INACTIVE' }}</td>
                        <td>
                          @if(auth()->user()->id != $d['user']->id )
                          <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>                   
                </div>
                </div>
                @endpermission--}}

                <div class="tab-pane fade {{ $data['display']['n_admin'] }} p-3" id="two" role="tabpanel" aria-labelledby="one-tab">
                  <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="userlistTable">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Creator Username</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['users']!=null)
                      @foreach($data['users'] as $d)
                      <tr>
                        <td>{{ $d['user']->username }}</td>                       
                        <td class="role-label">{{ $d['user']->GetCreatorUserName() }}</td>
                        <td class="role-label">{{ ($d['role']!=null) ? $d['role']->display_name : "" }}</td>
                        <td class="role-label">{{ ($d['user']->is_active == 1) ? 'ACTIVE' : 'INACTIVE' }}</td>
                        <td>
                          @if(auth()->user()->id != $d['user']->id && auth()->user()->id == $d['user']->creator_id || auth()->user()->is_admin_level == 1)
                          <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endif

                          {{-- <button type="button" data-toggle="modal" data-target="#modalLevel2User" class="btn btn-primary showLevel2UserInfo" data-info="{{$d['user']->id}}" title="Edit Details"><i class="fa fa-edit"></i></button>
                          <button type="button" data-toggle="modal" data-target="#modalLevel2UserPerm" class="btn btn-primary showLevel2UserPerm" data-info="{{$d['user']->id}}" title="Edit Permission"><i class="fas fa-tasks"></i></button> --}}
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <tr>
                      <td colspan="5">No data.</td>
                      </tr>
                      @endif
                    </tbody>
                  </table>
                </div>
                </div>


                @permission('udealer-view-list')
                <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="dealerlistTable">
                    <thead>
                      <tr>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Active</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['dealers']!=null)
                      @foreach($data['dealers'] as $d)
                      <tr>
                        <td>{{ $d['user']->username }}<br><small class="dname-label">{{ $d['user']->GetDealerName() }}</small></td>
                        <td class="role-label">{{ $d['role']->display_name }}</td>
                        <td class="role-label">{{ ($d['user']->is_active == 1) ? 'ACTIVE' : 'INACTIVE' }}</td>
                        <td>
                          <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>                   
                </div>
                </div>
                @endpermission

              </div>

              </div>
            </div>

          </section>

        </div>
      </section>
@endsection

@section('scripts')
<script type="text/javascript">
$(document).ready(function() {

    var table = $('#adminlistTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );

    var table = $('#userlistTable').DataTable( {
        // responsive: true,
        order: [[0, 'asc'], [1, 'asc']],
        rowGroup: {
            dataSrc: 1
        }
    } );

    var table = $('#dealerlistTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );

    $('.resetPassContainer').hide();
} );

$('#isResetPsswrd[type=checkbox]').on('click', function(event) {
   var isResetPsswrdChecked = $('#isResetPsswrd:checkbox:checked').length > 0;

    if(isResetPsswrdChecked) {
      $('.resetPassContainer').show();
      // $('#uPass').val('');
    }
    else {
      $('.resetPassContainer').hide();
      $('#uPass').val('');
    }
  });

$(document).on('click', '.showUserInfo', function(event) {
  event.preventDefault();
    $('.resetPassContainer').hide();
    $('#uPass').val('');
});

</script>
@endsection