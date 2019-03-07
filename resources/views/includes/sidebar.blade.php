<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
              <img src="{{ asset($getname->user_image) }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          @guest
          Guest
          @else
          <p> {{ $getname->first_name }} {{ $getname->middle_name }} {{ $getname->last_name }}</p>
          @endguest
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Customer</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('indexcust') }}"><i class="fa fa-circle-o"></i> Index</a></li>
            <li><a href="{{ route('addcust') }}"><i class="fa fa-circle-o"></i> Add</a></li>
          </ul>
        </li>
        @role('Admin')
        @if (auth()->user()->can('user view') || auth()->user()->can('Delete') || auth()->user()->can('Create'))
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user_list') }}"><i class="fa fa-circle-o"></i> Index</a></li>
            <li><a href="{{ route('addcust') }}"><i class="fa fa-circle-o"></i> Add</a></li>
          </ul>
        </li>
        @endif
        @endrole
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Roles</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('rolegroup') }}"><i class="fa fa-circle-o"></i> Index</a></li>
            <li><a href="{{ route('rolescreate') }}"><i class="fa fa-circle-o"></i> Add</a></li>
            <li><a href="{{ route('users.roles_permission') }}"><i class="fa fa-circle-o"></i>Roles Permissions</a></li>
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>