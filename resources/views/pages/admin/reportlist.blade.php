@extends('layouts.basepagemod')

@section('content')
<section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Reports</h1>
          </header>
          @include('includes.errormod')
          
          <!-- Reports Section-->
          <section class="dashboard-counts no-padding-bottom">

            <div class="card">

              <div class="card-body">    

                <div class="table-responsive">                       
                  <table class="table table-striped table-hover" id="reportTable">
                    <thead>
                      <tr>
                        <th>Report Name</th>
                        <th class="column-fifteenperc">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                       	<td>
                       		Approve Contracts
                        </td>
                        <td>
                        	 <button type="button" data-toggle="modal" data-target="#reportMV" class="btn btn-primary setReportType" data-info="1">GENERATE</button>
                        </td>
                      </tr>

                      <tr>
                       	<td>
                       		Line up for Booking
                        </td>
                        <td>
                        	<button type="button" data-toggle="modal" data-target="#reportMV" class="btn btn-primary setReportType" data-info="2">GENERATE</button>
                        </td>
                      </tr>
                    </tbody>

                  </table>
                  <br /><br />
                </div>
              </div>
            </div>

          </section>

        </div>
      </section>

      @include('partials.mvreportperiod')

@endsection

@section('scripts')
<script src="/js/custom-report.js"></script>


<script type="text/javascript">
$(document).ready(function() {
 
    var table = $('#reportTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        bFilter: false
    } );

} );
  
</script>
@endsection