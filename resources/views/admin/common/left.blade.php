<aside class="main-sidebar hidden-print">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image"><img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"></div>
      <div class="pull-left info">
        <p>{{ Auth::guard('admin')->user()->username }} </p>

        <!-- <p class="designation">Frontend Developer</p> -->
      </div>
    </div>
    <!-- Sidebar Menu-->
    <ul class="sidebar-menu">
      <li class="active"><a href="/admin/index"><i class="fa fa-dashboard"></i><span>首页</span></a></li>
      <!-- <li class="treeview"><a href="#"><i class="fa fa-laptop"></i><span>UI Elements</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="bootstrap-components.html"><i class="fa fa-circle-o"></i> Bootstrap Elements</a></li>
          <li><a href="http://fontawesome.io/icons/" target="_blank"><i class="fa fa-circle-o"></i> Font Icons</a></li>
          <li><a href="ui-cards.html"><i class="fa fa-circle-o"></i> Cards</a></li>
          <li><a href="widgets.html"><i class="fa fa-circle-o"></i> Widgets</a></li>
        </ul>
      </li>
      <li><a href="charts.html"><i class="fa fa-pie-chart"></i><span>Charts</span></a></li>
      <li class="treeview"><a href="#"><i class="fa fa-edit"></i><span>Forms</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="form-components.html"><i class="fa fa-circle-o"></i> Form Components</a></li>
          <li><a href="form-custom.html"><i class="fa fa-circle-o"></i> Custom Components</a></li>
          <li><a href="form-samples.html"><i class="fa fa-circle-o"></i> Form Samples</a></li>
          <li><a href="form-notifications.html"><i class="fa fa-circle-o"></i> Form Notifications</a></li>
        </ul>
      </li>
      <li class="treeview"><a href="#"><i class="fa fa-th-list"></i><span>Tables</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="table-basic.html"><i class="fa fa-circle-o"></i> Basic Tables</a></li>
          <li><a href="table-data-table.html"><i class="fa fa-circle-o"></i> Data Tables</a></li>
        </ul>
      </li>
      <li class="treeview"><a href="#"><i class="fa fa-file-text"></i><span>Pages</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="blank-page.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
          <li><a href="page-login.html"><i class="fa fa-circle-o"></i> Login Page</a></li>
          <li><a href="page-lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen Page</a></li>
          <li><a href="page-user.html"><i class="fa fa-circle-o"></i> User Page</a></li>
          <li><a href="page-invoice.html"><i class="fa fa-circle-o"></i> Invoice Page</a></li>
          <li><a href="page-calendar.html"><i class="fa fa-circle-o"></i> Calendar Page</a></li>
          <li><a href="page-mailbox.html"><i class="fa fa-circle-o"></i> Mailbox</a></li>
          <li><a href="page-error.html"><i class="fa fa-circle-o"></i> Error Page</a></li>
        </ul>
      </li>
      <li class="treeview"><a href="#"><i class="fa fa-share"></i><span>Multilevel Menu</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="blank-page.html"><i class="fa fa-circle-o"></i> Level One</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i><span> Level One</span><i class="fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
              <li><a href="blank-page.html"><i class="fa fa-circle-o"></i> Level Two</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i><span> Level Two</span></a></li>
            </ul>
          </li>
        </ul>
      </li> -->

      <!-- 会员管理 -->
      <li class="treeview"><a href=""><i class="fa fa-user"></i><span>会员管理</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="/admin/member"><i class="fa fa-circle-o"></i>用户列表</a></li>
        </ul>
      </li>
      <!-- 订单管理 -->
      <li class="treeview"><a href="#"><i class="fa fa-th-list"></i><span>订单管理</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="/admin/order?type=all_orders"><i class="fa fa-circle-o"></i>全部订单</a></li>
          <li><a href="/admin/order?type=confirm"><i class="fa fa-circle-o"></i>待确认</a></li>
          <li><a href="/admin/order?type=pending"><i class="fa fa-circle-o"></i>待付款</a></li>
          <li><a href="/admin/order?type=accepted"><i class="fa fa-circle-o"></i>待发货</a></li>
          <li><a href="/admin/order?type=shipped"><i class="fa fa-circle-o"></i>待收货</a></li>
          <li><a href="/admin/order?type=finished"><i class="fa fa-circle-o"></i>待评价</a></li>
          <li><a href="/admin/order?type=done"><i class="fa fa-circle-o"></i>已完成</a></li>
          <li><a href="/admin/order?type=cancel"><i class="fa fa-circle-o"></i>已取消</a></li>
          <li><a href="/admin/order?type=fight"><i class="fa fa-circle-o"></i>售后中</a></li>
          <li><a href="/admin/order?type=moneyback"><i class="fa fa-circle-o"></i>退款中</a></li>
        </ul>
      </li>
      <!-- ta的交易 -->
      <li class="treeview"><a href="#"><i class="fa fa-calendar-check-o "></i><span>ta的交易</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="/admin/trade"><i class="fa fa-circle-o"></i>用户列表</a></li>

        </ul>
      </li>
      <!-- 交易介入 -->
      <li class="treeview"><a href="#"><i class="fa fa-handshake-o"></i><span>交易介入</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>用户列表</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>添加用户</a></li>
        </ul>
      </li>
      <!-- 数据中心 -->
      <li class="treeview"><a href="#"><i class="fa fa-pie-chart"></i><span>数据中心</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>用户列表</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>添加用户</a></li>
        </ul>
      </li>
      <!-- 园林俱乐部 -->
      <li class="treeview"><a href="#"><i class="fa fa-tree"></i><span>园林俱乐部</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>用户列表</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>添加用户</a></li>
        </ul>
      </li>
      <!-- 分销中心 -->
      <li class="treeview"><a href="#"><i class="fa fa-cubes"></i><span>分销中心</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i>用户列表</a></li>
          <li class="treeview"><a href="#"><i class="fa fa-circle-o"></i>添加用户</a></li>
        </ul>
      </li>
      <!-- 添加用户 -->
      <li class="treeview"><a href="#"><i class="fa fa-share"></i><span>管理员操作</span><i class="fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="/admin/admins"><i class="fa fa-circle-o"></i>管理员用户列表</a></li>
          <li class="treeview"><a href="/admin/register"><i class="fa fa-circle-o"></i>添加用户</a></li>
        </ul>
      </li>

    </ul>
  </section>
</aside>
