@extends('layouts.basepagemod')

@section('content')
      
      @if(auth()->user()->whatRole()->name != 'dealer')
      @permission('approve-con-view-all')
      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/appcontracts" class="btn-load">Dealer Approved Contracts</a></li>
          <li class="breadcrumb-item active">Approved Contracts</li>
        </ul>
      </div>
      @endpermission
      @endif

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            {{-- @role('dealer')
            <h1 class="h3 display">Approved Contracts</h1>
            @endrole --}}

            @permission('approve-con-view-all')
            <h1 class="h3 display">Approved Contracts <small><span class="badge badge-pill badge-dark">{{$data['dealer']->dealer_name}}</span></small></h1>
            @endpermission

          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              <div class="card-body">    
                <a type="button" rel="tooltip" data-toggle="modal" data-target="#modalACCustomFilter" class="btn btn-default" id="showFilterACCustom" title="Filter"><i class="fas fa-filter"></i></a> &nbsp; <span class="badge badge-pill badge-warning filter-warning"><b>Contracts Filter Type :</b> {{$dataFilter['type']}}</span>
                @include('partials.modalviewappcontractcustomfilter')        
                <br/><br/>

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="contractTable">
                    <thead>
                      <tr>
                        <th>Contract ID</th>
                        <th class="column-fifteenperc">Client Name</th>
                        {{--<th class="column-fifteenperc">Dealer</th>--}}
                        <th class="column-fifteenperc">Product</th>
                        <th>Approved Date</th>
                        <th class="column-fifteenperc">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['acontracts'] != null)
                      @foreach($data['acontracts'] as $d)
                      <tr>
                        <th scope="row">{{$d->contract_id}}</th>
                        <td>{{ $d->client}}</td>
                        {{--<td>{{ $d->dealer}}</td>--}}
                        <td>{{ $d->product}}</td>
                        <td>{{ $d->credit_app_dt}}</td>
                        <td class="column-twentyfiveperc">
                          <a id="printview" class="btn btn-warning btn-load" target="_blank" href="/appcontractpreviewadvice/{{ $d->contract_id }}" rel="tooltip" title="Preview Credit Advice"><i class="far fa-file-pdf"></i></a>
                          @permission(['approve-con-add', 'approve-con-view-det'])
                          <button type="button" data-toggle="modal" data-target="#modalAppConDet" class="btn btn-primary showAppconview" data-info="{{$d->contract_id}}"  rel="tooltip" title="View Approved Contract Details"><i class="fa fa-search"></i></button>
                          @if(!$data['dealer']->CheckIfContractIdExist($d->contract_id))
                          <a id="add" class="btn btn-primary" href="/appcontractadd/{{$d->contract_id}}"  rel="tooltip" title="Add Approved Contract to Line up for Booking"><i class="fa fa-plus"></i> Line up for Booking</a>
                          @endif
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
          @include('partials.modalviewappcontractdetails')
        </div>
      </section>
@endsection

@section('scripts')
<script src="/js/custom-contract.js"></script>

<script type="text/javascript">
    function get_action(form) {
        form.action = "/appcontracts";
    }
</script>

<script type="text/javascript">
$(function () {
  $('[data-toggle="popover"]').popover()
})

$(document).ready(function() {

    // // Setup - add a text input to each footer cell
    // $('#contractTable thead tr').clone(true).appendTo( '#contractTable thead' );
    // $('#contractTable thead tr:eq(1) th').each( function (i) {
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
 
    var table = $('#contractTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        bFilter: false
    } );

} );
</script>
@endsection