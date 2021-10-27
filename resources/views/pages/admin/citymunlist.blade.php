@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">City / Municipality</h1>
          </header>
          @include('includes.errormod')


          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">

              @role('admin')
              <div class="card-header d-flex align-items-center">    
                <button type="button" data-toggle="modal" data-target="#modalCitymunAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add City / Municipality</button>      
              </div>
              @include('partials.modalviewcitymunadd')
              @endrole 

              <div class="card-body">   

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="citymunTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $cm)
                      <tr>
                        <th scope="row">{{ $cm->name }}</th>
                        <td>
                          @role('admin')
                          <button type="button" data-toggle="modal" data-target="#modalCitymunEdit" class="btn btn-primary showCityMun" data-info="{{$cm->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endrole
                          
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @include('partials.modalviewcitymunedit')
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
    var table = $('#citymunTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );

</script>
@endsection