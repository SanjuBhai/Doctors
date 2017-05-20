@include('layouts.sections.header')
<body>
   <div class="wrapper">
      <div class="container">
         <nav id="navigation" class="row menu-wrap">
            <div class="col-md-4"><a href="{{ url('/') }}" class="navbar-brand">LOGO</a></div>
            <div class="col-md-8 menu-list">
               <ul class="">
                  <li><a href="#">List your practice for free</a></li>
                  <li class="dropdown other-category">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Practo for Providers <b class="caret"></b></a>
                     <ul class="dropdown-menu category-list">
                        <li><a href="doctor-list.html">Doctor</a></li>
                        <li><a href="doctor-list.html">Doctor</a></li>
                        <li><a href="doctor-list.html">Doctor</a></li>
                     </ul>
                  </li>
                  <li><a href="#" class="login-btn">Sign Up/Login</a></li>
               </ul>
            </div>
         </nav>
      </div>
      <div class="main">
         @yield('content')
      </div>
      @include('layouts.sections.footer')
   </div>

<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script>
jQuery(function($){
   $('.tab-wrap a').click(function (e) {
     e.preventDefault();
     $(this).tab('show');
   });
   
   $('a[href="#"]').click(function (e) {
     e.preventDefault();
   });   
});
</script>

</body>
</html>