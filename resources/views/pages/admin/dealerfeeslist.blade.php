@extends('layouts.basepage')

@section('content')

      <div class="breadcrumb-holder container-fluid">
        <ul class="breadcrumb">
          <li class="breadcrumb-item"><a href="/s/dealerfee" class="btn-load">Dealer Fees</a></li>
          <li class="breadcrumb-item active">Table CM Fee Record</li>
        </ul>
      </div>

      <section class="forms">
        <div class="container-fluid">

                 <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Table CM Fee Record</h1>
          </header>

          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              <div class="card-body">             
                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="dealerCMFeesTable">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th class="column-action">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($data != null)
                      @foreach($data as $d)
                      <tr>
                        <th>{{$d['name']}}</th>
                        <td>
                          <a id="print" class="btn btn-primary btn-load" href="/admin/dealerfeestable/{{$d['ctr']}}" title="View"><i class="fas fa-search"></i></a>
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
 
    var table = $('#dealerCMFeesTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );

} );
</script>
@endsection