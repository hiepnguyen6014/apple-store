<div class="offcanvas offcanvas-start sidebar-nav bg-dark" tabindex="-1" id="sidebar">
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li>
                    <div class="text-muted small mt-2 fw-bold text-uppercase px-3">
                        Trang chủ
                    </div>
                </li>
                <li>
                    <a href="/admin" class="nav-link nav-link-custom px-3 active">
                        <span class="me-2"><i class="fas fa-chart-line"></i></span>
                        <span>Tổng quan</span>
                    </a>
                </li>
                <li class="my-4">
                    <hr class="dropdown-divider bg-light" />
                </li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                        Chức năng
                    </div>
                </li>
                <li class="nav-item {{ Request::is('admin/product') ? 'bg-secondary' : ''}}">
                    <a href="/admin/product" class="nav-link nav-link-custom px-3">
                        <span class="me-2"><i class="icon fas fa-store"></i></span>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/ship') ? 'bg-secondary' : ''}}">
                    <a href="{{url('admin/ship')}}" class="nav-link nav-link-custom px-3">
                        <span class="me-2"><i class="icon fas fa-shipping-fast"></i></span>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/history') ? 'bg-secondary' : ''}}">
                    <a href="/admin/history" class="nav-link nav-link-custom px-3">
                        <span class="me-2"><i class="icon fas fa-history"></i></span>
                        <span>Lịch sử</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/employee') ? 'bg-secondary' : ''}}">
                    <a href="/admin/employee" class="nav-link nav-link-custom px-3">
                        <span class="me-2"><i class="icon fas fa-users"></i></i></span>
                        <span>Nhân viên</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/user') ? 'bg-secondary' : ''}}">
                    <a href="/admin/user" class="nav-link nav-link-custom px-3">
                        <span class="me-2"><i class="icon fas fa-user-times"></i></span>
                        <span>Người dùng</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('admin/discount') ? 'bg-secondary' : ''}}">
                    <a href="/admin/discount" class="nav-link nav-link-custom px-3">
                        <span class="me-2"><i class="icon fab fa-salesforce"></i></span>
                        <span>Khuyễn mãi</span>
                    </a>
                </li>
                <li class="my-4">
                    <hr class="dropdown-divider bg-light" />
                </li>
            </ul>
        </nav>
    </div>
</div>
