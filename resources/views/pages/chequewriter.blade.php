@extends('layouts.basepagemod')

@section('content')

      <section class="forms">
        <div class="container-fluid">

          <!-- Page Header-->
          <header> 
            <h1 class="h3 display">Cheque Writer</h1>
          </header>


          <!-- Contracts Section-->
          <section class="dashboard-counts no-padding-bottom">

              <div class="card">
     
              <div class="card-body">   
                
                <form class="form-horizontal" method="POST" action="/chequewriterprint" target="_blank">
                {{ csrf_field() }}

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Start Date</label>
                  <div class="col-sm-3">
                      <input id="startDate" name="startDate" class="form-control" value="{{ Carbon\Carbon::now()->format('m/d/Y') }}" class="form-control" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-3 form-control-label">Recurring Amount</label>
                  <div class="col-sm-3">
                    <input id="recurringAmount" name="recurringAmount" type="text" placeholder="0.00" class="form-control fin-number">
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-3">
                  </div>
                  <div class="col-sm-3">
                    <button class="btn btn-primary btn-block btn-load">Generate</button>
                  </div>

                </div>

                </form>

              </div>
            </div>

          </section>

        </div>
      </section>
@endsection

@section('scripts')
<script type="text/javascript">


  $('#startDate').datepicker({
  uiLibrary: 'bootstrap4'
  });

  $('input.fin-number').keyup(function (event) {
      // skip for arrow keys
      if (event.which >= 37 && event.which <= 40) {
          event.preventDefault();
      }

      var currentVal = $(this).val();
      var testDecimal = testDecimals(currentVal);
      if (testDecimal.length > 1) {
          console.log("You cannot enter more than one decimal point");
          currentVal = currentVal.slice(0, -1);
      }
      // alert(currentVal);
      $(this).val(replaceCommas(currentVal));

  });

  $('input.fin-number').focusout(function () {

      var id = $(this).attr('id');

    var value = $('#'+id).val();
    value = value.split(',').join('');
    value = parseFloat(value).toFixed(2);

       $('#'+id).val(replaceCommas(value));
       
  });

  function testDecimals(currentVal) {
      var count;
      currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
      return count;
  }

  function replaceCommas(yourNumber) {
      var components = yourNumber.toString().split(".");
      if (components.length === 1) 
          components[0] = yourNumber;
      components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      if (components.length === 2)
          components[1] = components[1].replace(/\D/g, "");
      return components.join(".");
  }

</script>
@endsection