<div id="main-menu" class="main-menu collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <li class="active">
            <a href="{{URL('home')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
        </li>
        <h3 class="menu-title">Menu</h3><!-- /.menu-title -->
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Master</a>
            <ul class="sub-menu children dropdown-menu">
                <li><i class="fa fa-id-badge"></i><a href="{{URL('admin/user')}}">Users</a></li>
                <li><i class="fa fa-suitcase"></i><a href="{{URL('admin/product')}}">Products</a></li>
            </ul>
        </li>
        <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-laptop"></i>Transaction</a>
            <ul class="sub-menu children dropdown-menu">
                <li><i class="fa fa-location-arrow"></i><a href="{{URL('admin/order')}}">Orders</a></li>
            </ul>
        </li>

        <!-- <li class="menu-item-has-children dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Test2</a>
            <ul class="sub-menu children dropdown-menu">
                <li><i class="fa fa-table"></i><a href="{{URL('admin/calculator')}}">Calculator</a></li>
            </ul>
        </li> -->
    </ul>
</div><!-- /.navbar-collapse -->
