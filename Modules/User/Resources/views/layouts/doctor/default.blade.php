<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>@yield('title', 'Doctor Admin Panel')</title>
<link href="{{ url('modules/user/admin/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ url('modules/user/admin/css/style.css') }}" rel="stylesheet">
<link href="{{ url('modules/user/admin/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script src="{{ url('modules/user/admin/js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript">
function activateMenu(menuid){
    $('#'+ menuid).addClass('active');
}
</script>
</head>
<body>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('doctor.dashboard') }}">Dashboard</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <!-- @include('user::layouts.doctor.sections.messages')
                @include('user::layouts.doctor.sections.notifications') -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->getFullName() }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('doctor.profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('doctor.change-password') }}"><i class="fa fa-fw fa-lock"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            
            @include('user::layouts.doctor.sections.nav')
        </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

<script src="{{ url('modules/user/admin/js/bootstrap.min.js') }}"></script>
<script>
jQuery(function($){
    $(document).on('click', 'a[href="#"]', function(e){
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

    $('#filterForm #reset').click(function(){
        $('#filterForm .form-control').val('');
        $('#filterForm').submit();
    });

    $('#perPage').change(function(){
        $('#filterForm').submit();
    });

    // Set menu active
    var url = window.location.href;
    $('#menu a').each(function(){
        if( $(this).attr('href') == url ) {
            $(this).parent('li').addClass('active');
        }
    });
});
</script>
</body>
</html>