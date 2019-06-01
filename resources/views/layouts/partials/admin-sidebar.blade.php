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

         <li class="treeview {{ Request::segment(2) === 'users' ? 'active' : null }}
         {{ Request::segment(2) === 'employee' ? 'active' : null }}
         {{ Request::segment(2) === 'admin' ? 'active' : null }}">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Manage Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ Request::segment(2) === 'users' ? 'active' : null }}"><a href="{{url('administration/users')}}"><i class="fa fa-circle-o"></i> All</a></li>
            <li class="{{ Request::segment(2) === 'admin' ? 'active' : null }}"><a href="{{url('administration/admin')}}"><i class="fa fa-circle-o"></i> Admin</a></li>
            <li class="{{ Request::segment(2) === 'employee' ? 'active' : null }}"><a href="{{url('administration/employee')}}"><i class="fa fa-circle-o"></i>Employee</a></li>
          </ul>
        </li>
          </ul>
        </li>
        <li><a href="{{url('administration/employee')}}"><i class="fa fa-link"></i> <span>Employee</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>