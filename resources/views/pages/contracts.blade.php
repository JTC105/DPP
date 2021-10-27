@extends('layouts.basepagemod')

@section('content')
      
      @if(auth()->user()->whatRole()->name != 'dealer')
      @permission('contract-view-all')
      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/contracts" class="btn-load">Dealer Contracts</a></li>
          <li class="breadcrumb-item active">Line up for Booking</li>
        </ul>
      </div>
      @endpermission
      @endif

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            @role(['dealer','lo'])
            <h1 class="h3 display">Line up for Booking</h1>
            @endrole

            @permission('contract-view-all')
            <h1 class="h3 display">Line up for Booking <small><span class="badge badge-pill badge-dark">{{$data['name']}}</span></small></h1>
            @endpermission

          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              {{--@permission('contract-add')
              <div class="card-header d-flex  justify-content-between align-items-center"> 
                <div class="right-column">
                <a id="add" class="btn btn-primary" href="/contractadd"><i class="fa fa-plus" aria-hidden="true"></i> Add Contract</a>
                </div>
              </div>
              @endpermission--}}

              <div class="card-body">    
                <a type="button" rel="tooltip" data-toggle="modal" data-target="#modalACCustomFilter" class="btn btn-default" id="showFilterACCustom" title="Filter"><i class="fas fa-filter"></i></a> &nbsp; <span class="badge badge-pill badge-warning filter-warning"><b>Contracts Filter Type :</b> {{$dataFilter['type']}}</span>
                @include('partials.modalviewappcontractcustomfilter')     
 
                <br/><br/>

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="contractTable">
                    <thead>
                      <tr>
                        <th>Contract ID</th>
                        <th class="column-fifteenperc">Product Type</th>
                        <th>Client Name</th>
                        <th>Co-maker</th>
                        <th>Vehicle Series</th>
                        <th class="column-fifteenperc">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['contracts'] != null)
                      @foreach($data['contracts'] as $d)
                      <tr>
                        <th scope="row">{{$d->contract_id}}</th>
                        <td>{{ $d->GetProductType($d->product_type) }}</td>
                        <td>{{ $d->client_name }}</td>
                        <td>{{ $d->comaker_name }}</td>
                        <td>{{ $d->GetVehicleName($d->vehicle_name) }}</td>
                        <td class="column-fifteenperc">
            
                          @permission(['contract-edit', 'contract-view'])
                          <a id="edit" class="btn btn-primary btn-load" href="/contractedit/{{ $d->id }}" rel="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                          @endpermission
                          @permission('contract-printprev')
                          <a id="printview" class="btn btn-danger btn-load" target="_blank" href="/printpreview/{{ $d->id }}" rel="tooltip" title="Print Preview"><i class="far fa-file-pdf"></i></a>
                          @endpermission
                          @permission('contract-print')
                          @if($d->CheckIfAllowedPrint())
                            {{--@if($d->dateprinted == null)
                            <button id="print-custom" class="btn btn-warning btn-load" data-info="/printcontract/{{ $d->id }}" rel="tooltip" title="Print"><i class="fas fa-print"></i></button>
                            @else--}}
                            <a id="print" class="btn btn-warning btn-load" target="_blank" href="/printcontract/{{ $d->id }}" rel="tooltip" title="Print"><i class="fas fa-print"></i></a>
                            {{--@endif--}}
                          @else
                         <a tabindex="0" class="btn btn-warning btn-load" role="button" data-toggle="popover" data-trigger="focus" data-placement="top" title="Required Before Printing:" data-content="{!! nl2br(e($conreqnotes)) !!}"><i class="fas fa-print"></i></a>
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

        </div>
      </section>
@endsection

@section('scripts')
<script src="/js/custom-contract.js"></script>

<script type="text/javascript">
    function get_action(form) {
        form.action = "/contracts";
    }
</script>

<script type="text/javascript">
$('.popover-dismiss').popover({
  trigger: 'focus'
})

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