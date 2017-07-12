@include('layouts.sections.header')
<body>
   <div class="wrapper">
      <div class="container">
         <nav id="navigation" class="row menu-wrap">
            <div class="col-md-4"><a href="{{ url('/') }}" class="navbar-brand">LOGO</a></div>
            <div class="col-md-8 menu-list">
               <ul>
                  @if( Auth::check() )
                     <li class="dropdown other-category">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->getFullName() }} <b class="caret"></b></a>
                        <ul class="dropdown-menu category-list">
                           <li><a href="{{ url('account') }}">My Account</a></li>
                           <li><a href="{{ url('account/change-password') }}">Change Password</a></li>
                           <li><a href="{{ route('logout') }}">Logout?</a></li>
                        </ul>
                     </li>
                  @else
                     <li><a href="{{ url('doctor/register') }}" class="login-btn">Signup as Doctor</a></li>
                     <li><a href="{{ url('register') }}" class="login-btn">Signup</a></li>
                     <li><a href="{{ url('login') }}" class="login-btn">Login</a></li>
                  @endif
               </ul>
            </div>
         </nav>
      </div>
      <div class="main">
         @yield('content')
      </div>
      @include('layouts.sections.footer')
   </div>

<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
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

   // Prevent entering alphabets in numeric field
   $(document).on('keypress','.numeric,input[type="number"]', function(evt){
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
         return true;
      }
     
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
         return false;
      }
      return true;
   });
    
   $(document).on('paste drop', '.numeric,input[type="number"]', function(e){
      e.preventDefault();
   });
});
</script>

</body>
</html>