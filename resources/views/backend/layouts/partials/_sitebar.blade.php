<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar"
    style="padding-bottom: 22px !important;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('welcome')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{$siteName}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Website Manager
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userDropDown" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="userDropDown" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Users:</h6>
                <a class="collapse-item" href="{{route('user.all')}}">All User</a>
                <a class="collapse-item" href="{{route('user.add-new')}}">Add New</a>
                <a class="collapse-item" href="{{route('user.admins')}}">Admins</a>
                <a class="collapse-item" href="{{route('user.authors')}}">Authors</a>
                <a class="collapse-item" href="{{route('user.contributors')}}">Contributors</a>
                <a class="collapse-item" href="{{route('user.trashed')}}">Trashed</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-blog"></i>
            <span>Post</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Post:</h6>
                <a class="collapse-item" href="{{route('post.index')}}">All Post</a>
                <a class="collapse-item" href="{{route('post.create')}}">Add New</a>
                <a class="collapse-item" href="{{route('post.published')}}">Published</a>
                <a class="collapse-item" href="{{route('post.pending')}}">Pending</a>
                <a class="collapse-item" href="{{route('post.trashed')}}">Trashed</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-tag"></i>
            <span>Category</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Category:</h6>
                <a class="collapse-item" href="{{route('category.index')}}">All Categories</a>
                <a class="collapse-item" href="{{route('category.create')}}">Add New</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        System manager
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#setting" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-plus"></i>
            <span>Setting</span>
        </a>
        <div id="setting" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage System:</h6>
                <a class="collapse-item" href="">Front-end</a>
                <a class="collapse-item" href="">Back-end</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-backward"></i>
            <span>Backup-website</span>
        </a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
