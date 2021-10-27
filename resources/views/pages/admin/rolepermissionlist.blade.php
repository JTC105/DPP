@extends('layouts.basepage')

@section('content')

      @permission('role-assign-perms')
      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/rolelist" class="btn-load">Role List</a></li>
          <li class="breadcrumb-item active">Assign Roles</li>
        </ul>
      </div>
      @endpermission

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Assign Roles</h1>
          </header>

          <!-- Contracts Section-->
          <section class="no-padding-bottom">
          <div class="card">
          <div class="card-body"> 

            <div class="table-responsive" style="overflow: hidden !important">                       
              <table class="table table-striped table-hover" id="rolePermListTable2">
                <thead>
                  <tr>
                    <th rowspan="2" class="tHeaderRolePermTop" style="width: 150px">Roles</th>
                    <th colspan="9" class="tHeaderRolePermTop">CONTRACT</th>
                    <th colspan="3" class="tHeaderRolePermTop">APPROVE CONTRACT</th>
                    <th colspan="7" class="tHeaderRolePermTop">SIGNATORIES</th>
                    <th colspan="4" class="tHeaderRolePermTop">FORM TEMPLATE</th>
                    <th colspan="3" class="tHeaderRolePermTop">CHEQUE WRITER</th>
                    <th colspan="3" class="tHeaderRolePermTop">USERS</th>
                    <th colspan="3" class="tHeaderRolePermTop">USER DEALERS</th>
                    <th colspan="3" class="tHeaderRolePermTop">VEHICLES</th>
                    <th colspan="3" class="tHeaderRolePermTop">CITY/MUNICIPALITY</th>
                    <th colspan="6" class="tHeaderRolePermTop">DEALER FEES</th>
                    <th colspan="2" class="tHeaderRolePermTop">BOOKING GUIDELINES</th>
                    <th colspan="4" class="tHeaderRolePermTop">NEWS</th>
                    <th colspan="2" class="tHeaderRolePermTop">REPORTS</th>
                    <th class="tHeaderRolePermTop">DATE</th>
                  </tr>
                  <tr>
                    <!-- C -->
                    <th class="tHeaderRolePerm">
                     
                    </th>
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      VIEW DETAILS
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePerm">
                      EDIT
                    </th>
                    <th class="tHeaderRolePerm">
                      PRINT PREVIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      PRINT
                    </th>
                    <th class="tHeaderRolePerm">
                      UPLOAD LOG
                    </th>
                    <th class="tHeaderRolePermLast">
                      FILE REQS
                    </th>
                    <!-- AC -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      VIEW DETAILS
                    </th>
                    <th class="tHeaderRolePermLast">
                      ADD
                    </th>
                    <!-- S -->
                    <th class="tHeaderRolePerm">
                      VIEW (LOCAL)
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD (LOCAL)
                    </th>
                    <th class="tHeaderRolePerm">
                      EDIT (LOCAL)
                    </th>
                    <th class="tHeaderRolePerm">
                      VIEW (TFSPH)
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD (TFSPH)
                    </th>
                    <th class="tHeaderRolePerm">
                      EDIT (TFSPH)
                    </th>
                    <th class="tHeaderRolePermLast">
                      ASSIGN (TFSPH)
                    </th>
                    <!-- FT -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD 
                    </th>
                    <th class="tHeaderRolePerm">
                      EDIT 
                    </th>
                    <th class="tHeaderRolePermLast">
                      PRINT
                    </th>
                    <!-- CW -->
                    <th class="tHeaderRolePerm">
                      ENCODE
                    </th>
                    <th class="tHeaderRolePerm">
                      PREVIEW 
                    </th>
                    <th class="tHeaderRolePermLast">
                      PRINT
                    </th>
                    <!-- U -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                    <!-- UD -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                    <!-- V -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                    <!-- C/M -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                    <!-- DF -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                    <!-- C/M -->
                    <th class="tHeaderRolePerm">
                      VIEW (TABLE REF)
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD (TABLE REF)
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT (TABLE REF)
                    </th>
                     <!-- BG -->
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                     <!-- N -->
                     <th class="tHeaderRolePerm">
                      VIEW ALL
                    </th>
                    <th class="tHeaderRolePerm">
                      VIEW
                    </th>
                    <th class="tHeaderRolePerm">
                      ADD
                    </th>
                    <th class="tHeaderRolePermLast">
                      EDIT
                    </th>
                    <!-- R -->
                    <th class="tHeaderRolePerm">
                      APPROVED CONTRACTS
                    </th>
                    <th class="tHeaderRolePermLast">
                      CONTRACTS
                    </th>
                    <th class="tHeaderRolePermLast">
                      NO LIMIT
                    </th>
                  </tr>

                </thead>
                <tbody>
                  @foreach($data as $d) 
                  <tr>
                  <div class="form-group row">
                    
                    <th class="tDataRolePermFirstCol" style="width: 150px">    
                                        
                      <button type="button" data-toggle="modal" data-target="#modalRolePerm" class="btn btn-default showRolePerm" data-info="{{$d['role']->id}}"><i class="fa fa-edit"></i></button>
                      

                      {{ $d['role']->display_name }}
                    </th>
                    <td></td>
                      @foreach($d['permissions'] as $dp) 
                      <td class="tDataRolePerm">
                        {{-- <input id="role_{{$d['role']->id}}_{{$dp['id']}}" name="role_{{$d['role']->id}}[]" type="checkbox" class="form-control-custom" value="{{$dp['name']}}" {{$dp['permitted']}}>
                        <label for="role_{{$d['role']->id}}_{{$dp['id']}}" class="checkbox-custom-label"> &nbsp;</label> --}}

                        @if($dp['enabled'])
                        <span><i class="fas fa-check-circle rolePermitted"></i></span>
                        @elseif($dp['permitted'] == false)
                        <span><i class="fas fa-circle roleBlocked"></i></span>
                        @else
                        <span><i class="fas fa-times-circle roleNotPermitted"></i></span>
                        @endif

                      </td>
                      @endforeach
                   

                  </div>
                  </tr>
                  @endforeach
                
                </tbody>

              </table>
              <br/><br/>
            </div>
          
          </div>
          </div>
          </section>


          </div>
          </section>

@include('partials.roles.mvroleperm')
@endsection

@section('scripts')
<script type="text/javascript">

$(document).ready(function() {         

   var table = $('#rolePermListTable2').DataTable( {
    scrollX: true,
    scrollCollapse: true,
    columnDefs: [
      { targets: 1, visible: false }
    ]
  });
  
  new $.fn.dataTable.FixedColumns(table, {
    // rightColumns: 1,
    leftColumns: 1
  });

} );
</script>
@endsection