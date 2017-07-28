<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav" id='menu'>
        <li id='menu-dashboard'>
            <a href="{{ route('admin.dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li id='menu-setting'>
            <a href="{{ route('admin.settings') }}"><i class="fa fa-fw fa-gear"></i> Settings</a>
        </li>
        <li id='menu-media'>
            <a href="{{ route('admin.media') }}"><i class="fa fa-fw fa-picture-o"></i> Media</a>
        </li>
        <li id='menu-user'>
            <a href="{{ route('admin.users') }}"><i class="fa fa-fw fa-user"></i> Users</a>
        </li>
        <li id='menu-doctor'>
            <a href="{{ route('admin.doctors') }}"><i class="fa fa-fw fa-user"></i> Doctors</a>
        </li>
    </ul>
</div>