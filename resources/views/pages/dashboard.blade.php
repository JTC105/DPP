@extends('layouts.basepage')

@section('content')
       <section class="no-padding-bottom">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xl-12 col-md-12 col-12">

                  @if($data['showWarning'])
                  <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Consider changing your password</h4>
                    <hr>
                    <p>Your password will expire in {{$data['days']}} days. <br />
                    To change your password, please go to "Change Password" and then type in your desired password.</p>
                  </div>
                  @endif

                </div>
              </div>
            </div>
        </section>
        @include('includes.errormod')

         {{--
           <!-- Counts Section -->
      <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row">


           
            @role('admin')
             <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-user"></i></div>
                <div class="name"><strong class="text-uppercase">Dealers</strong>
                  <div class="count-number">73</div>
                </div>
              </div>
            </div>

            @endrole

            
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-bill"></i></div>
                <div class="name"><strong class="text-uppercase">Approved </strong>
                  <div class="count-number">400</div>
                </div>
              </div>
            </div>
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-padnote"></i></div>
                <div class="name"><strong class="text-uppercase">Contracts</strong>
                  <div class="count-number">50</div>
                </div>
              </div>
            </div>
            
          
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">RETAIL </strong>
                  <div class="count-number">25</div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-check"></i></div>
                <div class="name"><strong class="text-uppercase">Lease </strong>
                  <div class="count-number">25</div>
                </div>
              </div>
            </div>

            --}}
          
            {{--
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list"></i></div>
                <div class="name"><strong class="text-uppercase">Open Cases</strong><span>Last 3 months</span>
                  <div class="count-number">92</div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-2 col-md-4 col-6">
              <div class="wrapper count-title d-flex">
                <div class="icon"><i class="icon-list-1"></i></div>
                <div class="name"><strong class="text-uppercase">New Cases</strong><span>Last 7 days</span>
                  <div class="count-number">70</div>
                </div>
              </div>
            </div>
            

          </div>
        </div>
      </section>
      --}}

      <br>

          <!-- Page Section-->
         <section class="no-padding-bottom">
            <div class="container-fluid">

              <div class="row">

                <!-- Info -->
                <div class="col-lg-6">
                  <div class="articles card">
                    <div class="card-header d-flex align-items-center">
                      <h2 class="h3">Dealer Prompt Payment System (DPPS)   </h2>
                    </div>
                    <div class="card-body no-padding">
                      <div class="item d-flex">
                        <br />                        
                      DPPS is being used as a tool for printing collateral documents Lease Contract and Promissory Note with Chattel Mortgage (PNCM).
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Help Desk -->
                <div class="col-lg-6">
                  <div class="articles card">
                    <div class="card-header d-flex align-items-center">
                      <h2 class="h3">Help Desk</h2>
                    </div>
                    <div class="card-body no-padding">
                      <div class="item d-flex">
                      756 7463
                      </div>
                    </div>
                    
                    </div>
                  </div>

              </div>

            </div>
          </section>

           <!-- Updates Section -->
      <section class="mt-30px mb-30px">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-lg-6 col-md-6">

              @permission(["dash-bguide-view","dash-bguide-edit"])
              <!-- Booking Guideline -->
              <div id="daily-feeds" class="card updates daily-feeds">
                <div id="feeds-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h4 display"><a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box"><b>Booking Guidelines</b></a></h2>
                  <div class="right-column">
                   @permission("dash-bguide-edit")
                    <button type="button" data-toggle="modal" data-target="#bguidelienAddMV" class="btn btn-primary"  rel="tooltip" title="Add Booking Guidelines"><i class="fas fa-plus-square"></i></button>
                    @endpermission
                    &nbsp;
                    <a data-toggle="collapse" data-parent="#daily-feeds" href="#feeds-box" aria-expanded="true" aria-controls="feeds-box"><i class="fa fa-angle-down"></i></a>
                  </div>
                </div>

                <div id="feeds-box" role="tabpanel" class="collapse show">
                  <div class="feed-box">
                    <ul class="feed-elements list-unstyled">

                    @if($data['guides'] != null)
                   @foreach($data['guides'] as $d)
                    <!-- Item-->
                    <li class="d-flex justify-content-between"> 
                      <div class="left-col d-flex">
                        
                        <div class="title">
                         
                          <p class="news-bulletin-item" data-info="{{$d->id}}">{{$d->content}}</p>
                            
                            @permission("dash-bguide-edit")
                            <button type="button" data-toggle="modal" data-target="#bguidelienEditMV" class="btn btn-primary editBookingGuideline" data-info="{{$d->id}}" rel="tooltip" title="Edit Booking Guidelines"><i class="fas fa-edit"></i></button>
                            @endpermission

                             @if($d->filename != "")                              

                              <a class="btn btn-warning btn-view-guide" target="_blank" target="_blank" href="/bookingguideview/{{$d->id}}"><i class="fas fa-paperclip"></i> <b>View </b></a>  
                            @else
                              <button id="print" class="btn btn-secondary" disabled rel="tooltip" title="View Full Details of Booking Guidelines" ><i class="fas fa-paperclip"></i> View </button>
                            @endif
                        </div>

                      </div>                    
                    </li>
                    @endforeach
                    @endif

                    </ul>
                  </div>
                </div>

              </div>
              <!--  Booking Guideline End-->
              @endpermission

            </div>

            @permission("dash-bguide-edit")
              @include('partials.mvbookinguideadd')
              @include('partials.mvbookingguideedit')
            @endpermission

             <div class="col-lg-6 col-md-12">

              @permission(["dash-news-view-specific", "dash-news-view-all", "dash-news-add", "dash-news-edit"])
              <!-- News -->
              <div id="news-bulletin" class="card updates recent-updated">
                <div id="news-bulletin-header" class="card-header d-flex justify-content-between align-items-center">
                  <h2 class="h4 display"><a data-toggle="collapse" data-parent="#news-bulletin" href="#news-bulletin-box" aria-expanded="true" aria-controls="news-bulletin-box"><b>News Bulletin</b></a></h2>
                  <div class="right-column">
                    @permission(["dash-news-view-all", "dash-news-edit"])
                    <button type="button" data-toggle="modal" data-target="#newsViewAllMV" class="btn btn-warning" data-info="" rel="tooltip" title="View All News"><i class="fas fa-newspaper"></i></button>
                    @endpermission

                    @permission("dash-news-add")
                      <button type="button" data-toggle="modal" data-target="#newsAddMV" class="btn btn-primary" data-info="" rel="tooltip" title="Add News"><i class="fas fa-plus-square"></i></button>
                    @endpermission
                      &nbsp;
                      <a data-toggle="collapse" data-parent="#news-bulletin" href="#news-bulletin-box" aria-expanded="true" aria-controls="news-bulletin-box"><i class="fa fa-angle-down"></i></a>
                  </div>
                </div>
                <div id="news-bulletin-box" role="tabpanel" class="collapse show">
                  <ul class="news list-unstyled">
                   @if($data['news'] != null)
                   @foreach($data['news'] as $d)
                    <!-- Item-->
                    <li class="d-flex justify-content-between"> 
                      <div class="left-col d-flex">
                        
                        <div class="title">
                          <strong>{{$d->title}}</strong>
                          <br>
                          <p class="news-bulletin-item" data-info="{{$d->id}}">{{$d->content}}</p>
                          
                            @if($d->filename != "")
                              <a class="btn btn-warning btn-view-guide" target="_blank" target="_blank" href="/nbview/{{$d->id}}"><i class="fas fa-paperclip"></i> <b></b></a>
                            @endif
                        </div>

                      </div> 
                      <div class="right-col">
                        <small>{{ Carbon\Carbon::parse($d->created_at)->format('m/d/Y') }} </small>
                      </div>                     
                    </li>
                    @endforeach
                    @endif
                  </ul>
                </div>
              </div>
              <!-- News End-->
              @endpermission

            </div>
          </div>
        </div>
      </section>

      @permission("dash-news-view-specific")
        @include('partials.mvnewsview')
      @endpermission

      @permission(["dash-news-view-all","dash-news-add"])
        @include('partials.mvnewsviewall')
      @endpermission

      @permission("dash-news-add")
        @include('partials.mvnewsadd')
      @endpermission

      @permission("dash-news-edit")
        @include('partials.mvnewsedit')
      @endpermission

@endsection

@section('scripts')
<script src="/js/custom-contract-drop.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  bsCustomFileInput.init()

});

$('#btnResetForm2').on('click', function(event) {
  $('#bookingGuidelineFile').val('');
  // $('#fileName').text('');
});

</script>

<script type="text/javascript">
$(document).ready(function() {
  var table = $('#newsTable').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        bFilter: false
    } );

  var showChar = 80;
  var ellipsestext = "...";

  $('.news-bulletin-item').each(function() {
    var content = $(this).html();
    var id = $(this).data("info");

    if(content.length > showChar) {

      var c = content.substr(0, showChar);
      // var h = content.substr(showChar-1, content.length - showChar);
      
      var html = c + ellipsestext + '&nbsp;&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#newsViewMV" class="btn btn-secondary viewNewsBulletin" data-info="'+id+'">Read more</button>';

      $(this).html(html);
    }

  });

});

</script>
@endsection
