@extends('layouts.basepage')

@section('content')

      @permission('signa-tfsph-view-list')
      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/signatories" class="btn-load">Dealer Signatories</a></li>
          <li class="breadcrumb-item active">TFSPH Signatories Record</li>
        </ul>
      </div>
      @endpermission

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">TFSPH Signatories Record</h1>
          </header>
          @include('includes.errormod')
          
          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              @permission('signa-tfsph-add')
              <div class="card-header d-flex align-items-center">                
                 <button type="button" data-toggle="modal" data-target="#modalaSigDetail" class="btn btn-primary showTFSPHSigInfo" title="Add"><i class="fa fa-plus" aria-hidden="true"></i> Add TFSPH Signatory</button>
              </div>
              @endpermission


              <div class="card-body">             
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="tscontractTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th class="column-twentyperc">Position</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data != null)
                      @foreach($data as $d)
                      <tr>
                        <th>{{$d->name}}</th>
                        <td>{{$d->position}}</td>
                        <td>
                          @permission('signa-tfsph-edit')
                          <button type="button" data-toggle="modal" data-target="#modalaSigDetail" class="btn btn-primary showTFSPHSigInfo" data-info="{{$d->id}}" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>

                  </table>
                  @include('partials.modalviewtfsphsignatoryinfo')
                  <br /><br />
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

    // Setup - add a text input to each footer cell
    $('#tscontractTable thead tr').clone(true).appendTo( '#tscontractTable thead' );
    $('#tscontractTable thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();

        if (title != "Action") {
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } else {
            $(this).html(' ');
        } 
    } );
 
    var table = $('#tscontractTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );

} );
</script>
@endsection