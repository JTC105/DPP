@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

   <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Dealer Fees</h1>
          </header>
          @include('includes.errormod')
          
          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              @permission('dfees-add')
              <div class="card-header d-flex align-items-center">                
                 <a id="add" class="btn btn-primary" href="/admin/dealerfeeslist"><i class="fab fa-readme"></i> Table CM Fee Record</a>
              </div>
              @endpermission

              {{--@permission('dfees-add')
              <div class="card-header d-flex align-items-center">                
                <button type="button" data-toggle="modal" data-target="#modalDealerFeesListAdd" class="btn btn-primary" title="Add"><i class="fa fa-plus" aria-hidden="true"></i> Add Record</button>
                @include('partials.modalviewdealerfeeslistadd')
              </div>
              @endpermission--}}

              <div class="card-body">             
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="dealerCMFeesTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>CM Fees Table Reference</th>
                        <th>CMFees 2 Party</th>
                        <th>CMFees 3 Party</th>
                        <th>Lease Fee</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['list'] != null)
                      @foreach($data['list'] as $d)
                      <tr>
                        <th>{{$d['name']}}</th>
                        <td>{{$d['tableref']}}</td>
                        <td>{{$d['cmfee2']}}</td>
                        <td>{{$d['cmfee3']}}</td>
                        <td>{{$d['leasefee']}}</td>
                        <td>
                          @permission('dfees-edit')
                          <button type="button" data-toggle="modal" data-target="#modalDealerFeesListEdit" class="btn btn-primary showDealerFeesInfo" data-info="{{$d['pid']}}" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                    @include('partials.modalviewdealerfeeslistedit')
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
 
    var table = $('#dealerCMFeesTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );

} );
</script>
@endsection