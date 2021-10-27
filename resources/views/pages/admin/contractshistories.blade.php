@extends('layouts.basepagemod')

@section('content')
      
      <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              @permission(['contract-view-all','contract-view-history'],true)
              <li class="breadcrumb-item"><a href="/s/contracts" class="btn-load">Dealer Contracts</a></li>
              <li class="breadcrumb-item"><a href="/admin/viewcontracts/{{auth()->user()->GetDealerInfoIfAdmin()->party_id}}" class="btn-load">Contracts</a></li>
              <li class="breadcrumb-item"><a href="/contractedit/{{session()->get('c_id')}}" class="btn-load">Contract Details</a></li>
              <li class="breadcrumb-item active">Contract History</li>              
              @endpermission
              
              @role('dealer')
              <li class="breadcrumb-item"><a href="/admin/viewcontracts/{{auth()->user()->GetDealerInfoIfAdmin()->party_id}}" class="btn-load">Contracts</a></li>
              <li class="breadcrumb-item"><a href="/contractedit/{{session()->get('c_id')}}" class="btn-load">Contract Details</a></li>
              <li class="breadcrumb-item active">Contract History</li>   
              @endrole

            </ul>
          </div>

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 

            @permission('contract-view-history')
            <h1 class="h3 display">Contract History<small> <span class="badge badge-pill badge-dark">Contract #: {{$data['contractId']}}</span></small></h1>
            @endpermission

          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">


              <div class="card-body">    

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="contractHistoryTable">
                    <thead>
                      <tr>
                        <th class="column-fifteenperc">Revision Number</th>
                        <th>Date of Revision</th>
                        <th>Revisor Username</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['history'] != null)
                      @foreach($data['history']  as $d)
                      <tr>
                        <th scope="row">{{$d->revision_number}}</th>
                        <td>{{ Carbon\Carbon::parse($d->revisiondate)->format('M d, Y') }}</td>
                        <td>{{$d->revisor_username}}</td>
                        <td>
            
                          <a id="view" class="btn btn-primary btn-load" href="/admin/viewconhisdetails/{{$d->id}}" rel="tooltip" title="View Contract Details"><i class="fa fa-search"></i></a>
                          
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
$('.popover-dismiss').popover({
  trigger: 'focus'
})

$(function () {
  $('[data-toggle="popover"]').popover()
})

$(document).ready(function() {

    var table = $('#contractHistoryTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );


} );
</script>
@endsection