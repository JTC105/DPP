@extends('layouts.basepage')

@section('content')

      @role('admin')
      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/rolelist" class="btn-load">Role List</a></li>
          <li class="breadcrumb-item active">Assign Roles</li>
        </ul>
      </div>
      @endrole

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Assign Roles</h1>
          </header>

          <!-- Contracts Section-->
           <section class="no-padding-bottom">
           <div class="card">

              <div class="card-header d-flex align-items-center"> 
              <b>CONTRACTS</b> 
              </div>

             <div class=" mt-3 tab-card">

              <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link active show" id="cAdd-tab" data-toggle="tab" href="#cAdd" role="tab" aria-controls="One" aria-selected="true">ADD</a>
                  </li>
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link" id="cEdit-tab" data-toggle="tab" href="#cEdit" role="tab" aria-controls="Two" aria-selected="false">EDIT</a>
                  </li>
                </ul>
              </div>

              <div class="tab-content" id="myTabContent">

                <!-- Content 1 -->
                <div class="tab-pane fade show active p-3" id="cAdd" role="tabpanel" aria-labelledby="one-tab">
                  
                  <div class="card">
                    <div class="card-body">
                      <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="1" title="Edit"><i class="fas fa-plus-square"></i> Add Role</button>
                      <br /><br />

                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover" id="userlistTable">
                          <thead>
                            <tr>
                              <th>Role name</th>
                              <th class="column-action">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($data!=null)
                            @foreach($data as $d)
                            <tr>
                              <td>dasdas</td>
                              <td>
                                <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                              </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                              <td colspan="2">...</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>                   
                      </div>

                    </div>
                  </div>
                  
                </div>
                <!-- End -->

                <!-- Content 2 -->
                <div class="tab-pane fade p-3" id="cEdit" role="tabpanel" aria-labelledby="one-tab">
                  
                  <div class="card">
                    <div class="card-body">
                      <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="1" title="Edit"><i class="fas fa-plus-square"></i> Add Role</button>
                      <br /><br />

                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover" id="userlistTable">
                          <thead>
                            <tr>
                              <th>Role name</th>
                              <th class="column-action">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($data!=null)
                            @foreach($data as $d)
                            <tr>
                              <td>dasdas</td>
                              <td>
                                <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                              </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                              <td colspan="2">...</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>                   
                      </div>

                    </div>
                  </div>
                  
                </div>
                <!-- End -->


              </div>
            </div>
          </div>
          </section>

          <!-- Contracts Section-->
           <section class="no-padding-bottom">
           <div class="card">

              <div class="card-header d-flex align-items-center"> 
              <b>APPROVED CONTRACTS</b> 
              </div>

             <div class=" mt-3 tab-card">

              <div class="card-header tab-card-header">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link active show" id="acAdd-tab" data-toggle="tab" href="#acAdd" role="tab" aria-controls="One" aria-selected="true">ADD</a>
                  </li>
                  <li class="nav-item tab-nav-item">
                      <a class="nav-link" id="acEdit-tab" data-toggle="tab" href="#acEdit" role="tab" aria-controls="Two" aria-selected="false">VIEW</a>
                  </li>
                </ul>
              </div>

              <div class="tab-content" id="myTabContent">

                <!-- Content 1 -->
                <div class="tab-pane fade show active p-3" id="acAdd" role="tabpanel" aria-labelledby="one-tab">
                  
                  <div class="card">
                    <div class="card-body">
                      <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="1" title="Edit"><i class="fas fa-plus-square"></i> Add Role</button>
                      <br /><br />

                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover" id="userlistTable">
                          <thead>
                            <tr>
                              <th>Role name</th>
                              <th class="column-action">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($data!=null)
                            @foreach($data as $d)
                            <tr>
                              <td>dasdas</td>
                              <td>
                                <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                              </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                              <td colspan="2">...</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>                   
                      </div>

                    </div>
                  </div>
                  
                </div>
                <!-- End -->

                <!-- Content 2 -->
                <div class="tab-pane fade p-3" id="acEdit" role="tabpanel" aria-labelledby="one-tab">
                  
                  <div class="card">
                    <div class="card-body">
                      <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="1" title="Edit"><i class="fas fa-plus-square"></i> Add Role</button>
                      <br /><br />

                      <div class="table-responsive">                       
                        <table class="table table-striped table-hover" id="userlistTable">
                          <thead>
                            <tr>
                              <th>Role name</th>
                              <th class="column-action">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if($data!=null)
                            @foreach($data as $d)
                            <tr>
                              <td>dasdas</td>
                              <td>
                                <button type="button" data-toggle="modal" data-target="#modalEditUser" class="btn btn-primary showUserInfo" data-info="{{$d['user']->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                              </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                              <td colspan="2">...</td>
                            </tr>
                            @endif
                          </tbody>
                        </table>                   
                      </div>

                    </div>
                  </div>
                  
                </div>
                <!-- End -->


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

    

} );
</script>
@endsection