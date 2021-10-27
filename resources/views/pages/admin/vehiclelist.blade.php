@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Vehicle</h1>
          </header>
          @include('includes.errormod')


          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">

              @permission('vehicle-add')
              <div class="card-header d-flex align-items-center">    
                <button type="button" data-toggle="modal" data-target="#modalVehicleAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Vechicle</button>      
              </div>
              @include('partials.modalviewvehicleadd')
              @endpermission

              <div class="card-body">   

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="vehicleTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $v)
                      <tr>
                        <th scope="row">{{ $v->name }}</th>
                        <td>
                          @permission('vehicle-edit')
                          <button type="button" data-toggle="modal" data-target="#modalVehicleEdit" class="btn btn-primary showVehicle" data-info="{{$v->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission
                          
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @include('partials.modalviewvehicleedit')
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
    var table = $('#vehicleTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );

</script>
@endsection