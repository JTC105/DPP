<!DOCTYPE html>
<html>
<head>
	@include('includes.header')
</head>
  <body>
    <script>
    if (self == top) {
      var theBody = document.getElementsByTagName('body')[0];
      theBody.style.display = "block";
    } else {
      top.location = self.location;
    }
    </script>
    <div class="se-pre-con"></div>

    @include('includes.sidebar')
  	
    <div class="page">
      
  		@include('includes.topnav')

    	@yield('content')
    	@include('includes.footer')

    </div>


    <script src="/js/jquery/jquery.min.js"></script>
    @include('includes.footerscripts')
    @yield('scripts')
    
    <script type="text/javascript">
      // -- Used in sidebar
      sideBar();

    $(document).ready(function() {
      $(".se-pre-con").fadeOut("fast");
    });
    </script> 

  </body>
</html>