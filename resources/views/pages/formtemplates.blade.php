@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Form Template</h1>
          </header>
          @include('includes.errormod')


          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">

              @permission('form-temp-add')
              <div class="card-header d-flex align-items-center">    
                {{-- <button type="button" data-toggle="modal" data-target="#modalFormTemplateAdd" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> Add Form Template</button>    
                &nbsp;&nbsp;&nbsp;&nbsp; --}}
                <button type="button" data-toggle="modal" data-target="#fileModal" class="btn btn-primary" title="Upload File"><i class="fas fa-upload"></i> Upload Form Templates</button>  
              </div>
              
              @endpermission 

              <div class="card-body">   

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="ftemplateTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                       {{-- <th>Size</th> --}}
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $ft)
                      <tr>
                        <td scope="row">{{ $ft->name }}</td>
                       {{--  <td>{{ $ft->size }}</td> --}}
                        <td>
                          @permission('form-temp-edit')
                          <button type="button" data-toggle="modal" data-target="#modalFormTemplateEdit" class="btn btn-primary showFormInfo" data-info="{{$ft->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission

                           @permission('form-temp-print')
                          <a id="print" class="btn btn-warning" target="_blank" href="./{{$ft->path}}" rel="tooltip" title="Print"><i class="fas fa-print"></i></a>
                          @endpermission
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @include('partials.dropzone')
                  @include('partials.modalviewformtemplateedit')
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
    var table = $('#ftemplateTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );
} );

</script>
<script src="/js/custom-drop.js"></script>
@endsection