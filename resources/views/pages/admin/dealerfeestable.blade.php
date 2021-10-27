@extends('layouts.basepage')

@section('content')

      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/dealerfee" class="btn-load">Dealer Fees</a></li>
          <li class="breadcrumb-item"><a href="/admin/dealerfeeslist" class="btn-load">Table CM Fee Record</a></li>
          <li class="breadcrumb-item active">Table Details</li>
        </ul>
      </div>

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Table Details <small><span class="badge badge-pill badge-dark">{{$data['tableName']}}</span></small> </h1>
          </header>
          @include('includes.errormod')

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              @permission('dfees-tableref-add')
              <div class="card-header d-flex align-items-center">                
                <button type="button" data-toggle="modal" data-target="#modalDealerFeesTableAdd" class="btn btn-primary" title="Add"><i class="fa fa-plus" aria-hidden="true"></i> Add Rate</button>
                @include('partials.modalviewdealerfeestableadd')
              </div>
              @endpermission

              <input type="hidden" id="tableId" name="tableId" value="{{$data['tableId']}}">

              <div class="card-body">             
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="dealerCMFeesTable">
                    <thead>
                      <tr>
                        <th>From</th>
                        <th>To</th>
                        <th>Rate</th>
                        <th>Retail Type</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data['tableData'] != null)
                      @foreach($data['tableData'] as $d)
                      <tr>
                        <td>{{$d['from']}}</td>
                        <td>{{$d['to']}}</td>
                        <td>{{$d['rate']}}</td>
                        <td>{{$d['retailtype']}}</td>
                        <td>
                          @permission('dfees-tableref-edit')
                          <button type="button" data-toggle="modal" data-target="#modalDealerFeesTableEdit" class="btn btn-primary showDealerFeesTableInfo" data-info="{{$d['id']}}" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                  @include('partials.modalviewdealerfeestableedit')
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