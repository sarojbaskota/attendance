<aside class="main-sidebar"
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::user()->avatar)
            <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
          @else
            <img src="{{asset('images/site-content/defaults/default_avatar.png')}}" class="img-circle" alt="User Image">
          @endif  
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->full_name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigation</li>
        <!-- Optionally, you can add icons to the links -->
         <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : null }}"><a href="{{url('administration/dashboard')}}"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> <small class="label pull-right bg-green">New Feed</small></a></li>
        <li class="treeview {{ Request::segment(2) === 'users' ? 'active' : null }}">
          <a href="#"><i class="glyphicon glyphicon-user"></i> <span>Manage User</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="{{url('administration/users')}}">All Users</a></li>
            <li><a href="{{url('administration/admin')}}">View Admin</a></li>
            <li><a href="{{url('administration/employee')}}">Employee</a></li>
            
          </ul>
        </li>
        <li><a href="{{url('administration/employee')}}"><i class="fa fa-link"></i> <span>Employee</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>