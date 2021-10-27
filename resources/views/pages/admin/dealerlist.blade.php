@extends('layouts.basepage')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Dealer List</h1>
          </header>
          @include('includes.errormod')
          
          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">
              @permission('udealer-add')
              <div class="card-header d-flex align-items-center">    
                <button type="button" data-toggle="modal" data-target="#modalDealerInfo" class="btn btn-primary addDealerInfo"><i class="fa fa-plus" aria-hidden="true"></i> Add Dealer</button>      
              </div>
              @endpermission

              <div class="card-body">   
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="dealerlistTable">
                    <thead>
                      <tr>
                        <th>Party ID</th>
                        <th>Name</th>
                        <th>Active</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($data as $d)
                      <tr>
                        <td>{{ $d->party_id }}</td>
                        <td>{{ $d->dealer_name }}</td>
                        <td class="role-label">{{ ($d->is_active == 1) ? 'ACTIVE' : 'INACTIVE' }}</td>
                        <td>
                          @permission('udealer-edit')
                          <button type="button" data-toggle="modal" data-target="#modalDealerInfo" class="btn btn-primary showDealerInfo" data-info="{{$d->id}}" rel="tooltip" title="Edit"><i class="fa fa-edit"></i></button>
                          @endpermission
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <br><br>
                 @include('partials.modalviewdealerinfo')
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
    var table = $('#dealerlistTable').DataTable( {
        order: [[2, 'asc'], [0, 'asc']],
        rowGroup: {
            dataSrc: 0
        }
    } );
} );

</script>
@endsection