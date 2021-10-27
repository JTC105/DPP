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
    @yield('content')

    <script src="/js/jquery/jquery.min.js"></script>
    @include('includes.footerscripts')
    @yield('scripts')
    <script type="text/javascript">
    $(document).ready(function() {
      $(".se-pre-con").fadeOut("fast");
    });
    </script> 
  </body>
</html>