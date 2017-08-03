<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav" id='menu'>
        <li id='menu-dashboard'>
            <a href="{{ route('doctor.dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li id='menu-education'>
            <a href="{{ route('doctor.educations') }}"><i class="fa fa-fw fa-book"></i> Educations</a>
        </li>
        <li id='menu-video'>
            <a href="{{ route('doctor.videos') }}"><i class="fa fa-fw fa-video-camera"></i> Videos</a>
        </li>
        <li id='menu-calendar'>
            <a href="{{ route('doctor.calendar') }}"><i class="fa fa-fw fa-calendar"></i> Calendar</a>
        </li>
        <li id='menu-appointment'>
            <a href="{{ route('doctor.appointments') }}"><i class="fa fa-fw fa-calendar-o"></i> Appointments</a>
        </li>
    </ul>
</div>