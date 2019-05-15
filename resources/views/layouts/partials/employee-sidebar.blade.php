<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        @if(Auth::user()->avatar)
                           <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                        @else
                        <img src="{{asset('images/site-content/defaults/avatar.png')}}" class="img-circle" alt="User Image">
                        @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->username}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">NAVIGATION</li>
        <li class="{!! Request::is('employee_dashboard') ? 'active' : '' !!}">
          <a href="{{url('employee_dashboard')}}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview {!! Request::is('employee_dashboard/*') ? 'active' : '' !!}">
          <a href="#" class="{!!route('employee_dashboard','test' )!!}">
            <i class="fa fa-pie-chart"></i>
            <span>Manage Leaves</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> Leaves</a></li>
          </ul>
        </li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li class="treeview {!! Request::is('employee_dashboard/*') ? 'active' : '' !!}">
          <a href="#" class="{!!route('employee_dashboard','test' )!!}">
            <i class="fa fa-pie-chart"></i>
            <span>Action</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> Leaves</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
