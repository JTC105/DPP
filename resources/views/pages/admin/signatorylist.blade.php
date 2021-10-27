@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Dealer Signatories</h1>
          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              @permission('signa-tfsph-view-list')
              <div class="card-header d-flex align-items-center">                
                 <a id="view" class="btn btn-primary" href="/admin/tfssignatories"><i class="fab fa-readme"></i> TFSPH Signatories Record</a>
              </div>
              @endpermission

              <div class="card-body">             
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="scontractTable">
                    <thead>
                      <tr>
                        <th>Dealer Name</th>
                        <th class="column-twentyfiveperc">Local Signatories</th>
                        <th class="column-twentyfiveperc">TFSPH Signatories</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data != null)
                      @foreach($data as $d)
                      <tr>
                        <th>{{$d['name']}}</th>
                        <td>
                          @foreach($d['local'] as $s)
                            {{$s['name']}} <br>
                          @endforeach
                        </td>
                        <td>
                          @if($d['tfsph']!=null)
                          @foreach($d['tfsph'] as $s)
                            {{$s['name']}} <br>
                          @endforeach
                          @endif
                        </td>
                        <td>
                          @permission(['signa-loc-add','signa-loc-edit','signa-tfsph-assign'])
                          <a id="edit" class="btn btn-primary btn-load" href="/admin/dsignatoriesedit/{{$d['pid']}}" rel="tooltip" title="View"><i class="far fa-edit"></i></a>
                          @endpermission
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>

                  </table>
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
    $('#scontractTable thead tr').clone(true).appendTo( '#scontractTable thead' );
    $('#scontractTable thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#scontractTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );

} );
</script>
@endsection