<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="active">
            <a href="{{ route('admin.dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        <li>
            <a href="{{ route('admin.settings') }}"><i class="fa fa-fw fa-gear"></i> Settings</a>
        </li>
        <li>
            <a href="{{ route('admin.media') }}"><i class="fa fa-fw fa-picture-o"></i> Media</a>
        </li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#users"><i class="fa fa-fw fa-user"></i> Users</a>
            <ul class='collapse' id='users'>
                <li><a href="{{ route('admin.users') }}"><i class="fa fa-fw fa-user"></i> Users</a></li>
                <li><a href="{{ route('admin.users.add') }}"><i class="fa fa-fw fa-user"></i> Add New</a></li>
            </ul>
        </li>
        <!-- <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
                <li>
                    <a href="#">Dropdown Item</a>
                </li>
            </ul>
        </li> -->
    </ul>
</div>