@extends('layouts.basepagemod')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Dealer Approved Contracts</h1>
          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">
              <div class="card-body">   

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="acontractTable">
                  <thead>
                      <tr>
                        <th>Dealer Name</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data != null)
                      @foreach($data as $d)
                      <tr>
                        <th>{{$d['name']}}</th>
                        <td>
                          @permission('approve-con-view-list')
                          <a id="print" class="btn btn-primary btn-load" href="/admin/viewappcontracts/{{$d['pid']}}" title="View"><i class="fa fa-search"></i></a>
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
<script src="/js/custom-contract.js"></script>

<script type="text/javascript">
    function get_action(form) {
        form.action = "/admin/appcontracts";
    }
</script>

<script type="text/javascript">

$(document).ready(function() {

    // // Setup - add a text input to each footer cell
    // $('#acontractTable thead tr').clone(true).appendTo( '#acontractTable thead' );
    // $('#acontractTable thead tr:eq(1) th').each( function (i) {
    //     var title = $(this).text();

    //     if (title != "Action") {
    //         $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    //         $( 'input', this ).on( 'keyup change', function () {
    //             if ( table.column(i).search() !== this.value ) {
    //                 table
    //                     .column(i)
    //                     .search( this.value )
    //                     .draw();
    //             }
    //         } );
    //     } else {
    //         $(this).html(' ');
    //     } 
    // } );
 
    var table = $('#acontractTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: false
    } );

} );
</script>
@endsection