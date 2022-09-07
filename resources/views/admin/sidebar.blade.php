<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                 <li>
                    <a class="{{(isset($controller) && $controller == config('define.controller.admin.dashboard')) ? 'active' : ''}}" href="{{route('admin.index')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <!--<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Slider</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-slider')}}">Liệt kê slider</a></li>
                        <li><a href="{{URL::to('/add-slider')}}">Thêm slider</a></li>
                    </ul>
                </li>

                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>


                    </ul>
                </li>
               
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>



                    </ul>
                </li> -->
                <li class="sub-menu">
                    <a href="{{route('admin.manufacture.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.manufacture')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Nhà cung cấp</span>
                    </a>
                </li>
                <li class="sub-menu"> {{--{{route('all-trademark')}} --}}
                    <a href="{{route('admin.trademark.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.trademark')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>

                </li>
                <li class="sub-menu"> {{--{{route('all-category')}} --}}
                    <a href="{{route('admin.category.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.category')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Loại sản phẩm</span>
                    </a>

                </li>
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>

                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-brand-product')}}">Thêm hiệu sản phẩm</a></li>
                        <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>

                    </ul>
                </li>-->
                <li class="sub-menu"> {{--{{route('all-product')}} --}}
                    <a href="{{route('admin.product.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.product')) ? 'active' : ''}}">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>

                </li>
                <li class="sub-menu">
                    <a href="{{route('admin.coupon.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.coupon')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Khuyến mãi</span>
                    </a>
                </li>
                <li class="sub-menu"> {{--{{route('all-ddh')}} --}}
                    <a href="{{route('admin.order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.order')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Đơn đặt hàng của khách hàng</span>
                    </a>

                </li>
                <li class="sub-menu"> {{--{{route('all-ddh')}} --}}
                    <a href="{{route('admin.company_order.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.company_order')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Đặt hàng từ nhà cung cấp</span>
                    </a>

                </li>
                <li class="sub-menu"> {{--{{route('all-ddh')}} --}}
                    <a href="{{route('admin.import.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.import')) ? 'active' : ''}}">
                        <i class="fa fa-money"></i>
                        <span>Phiếu nhập</span>
                    </a>

                </li>
                @if (trim(session()->get('user')->ma_nv) == 'NV001')
                    <li class="sub-menu"> {{--{{route('all-users')}} --}}
                        <a href="{{route('admin.customer.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.customer')) ? 'active' : ''}}">
                            <i class="fa fa-book"></i>
                            <span>Quản lý khách hàng</span>
                        </a>

                    </li>
                    <li class="sub-menu"> {{--{{route('all-employees')}} --}}
                        <a href="{{route('admin.user.index')}}" class="{{(isset($controller) && $controller == config('define.controller.admin.user')) ? 'active' : ''}}">
                            <i class="fa fa-book"></i>
                            <span>Quản lý Nhân viên</span>
                        </a>

                    </li>
                @endif
               <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-users')}}">Thêm user</a></li>
                        <li><a href="{{URL::to('/all-users')}}">Liệt kê user</a></li>

                    </ul>
                </li> -->

            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>
</aside>
