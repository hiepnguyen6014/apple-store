<style>
     .hover-item:hover {
         background-color: #a3a3a3;
     }
</style>

<div class="header__height"></div>
<div class="header__background">
    <!-- Điện thoại -->
    <div class="smartphone__header__logo">
        <a href="/">
            <img width="30px" height="30px" src="{{ asset('images/logo.png')}}" alt="logo">
        </a>
    </div>
    <div class="smartphone__header__search">
        <i class="fas fa-search"></i>
        <input type="text" name="search-content" id="search-content" placeholder="Bạn cần tìm gì?">
    </div>
    <div class="smartphone__shopping__cart">
        <i class="ti-bag"></i>
        <p>Giỏ hàng</p>
    </div>
    <div class="smartphone__modal">
    </div>
    <!-- End Điện thoại -->
</div>
<!-- Header Background Tablet -->
<div class="tablet__modal"></div>
<div class="tablet__header__background">
    <!-- Tablet -->
    <div class="tablet__header__top">
        <div class="tablet__header__logo">
            <a href=""><img src="{{ asset('images/logo.png')}}" alt=""></a>
        </div>
        <div class="tablet__header__logo__scroll">
            <a href=""><img src="{{ asset('images/logo.png')}}" alt=""></a>
        </div>
        <div class="tablet__header__bottom__scroll">
            <i class="fas fa-search"></i>
            <input type="text" name="search" id="search" placeholder="Bạn cần tìm gì?">
        </div>
        <div class="tablet__header__top__right">
            <div class="tablet__shopping__cart">
                <i class="ti-bag"></i>
                <p>Giỏ hàng</p>
            </div>
        </div>
    </div>
    <div class="tablet__header__bottom">
        <i class="fas fa-search"></i>
        <input type="text" name="" id="" placeholder="Bạn cần tìm gì?">
    </div>
    <!-- End Tablet -->
</div>
<!-- End Header Background tablet -->
<div class="header grid wide">
    <div class="row">
        <!-- Logo Image -->
        <div class="header__logo__img">
            <a href="/"><img width="274px" height="66px" src="{{ asset('images/logo.png')}}" alt=""></a>
        </div>
        <!-- Submenu modal -->
        <div class="header__location__submenu__modal"></div>
        <!-- Search bar -->
        <div class="header__search__bar">
            <div class="header__search__bar__icon">
                <i class="search-icon icon"></i>
            </div>
            <div class="header__search__bar__input">
                <input type="text" placeholder="Bạn cần tìm gì?">
            </div>
            <div class="header__search__bar__modal">
            </div>
        </div>
        <!-- Navbar list -->
        <div class="header__navbar">
            <ul class="header__navbar__list">
                <li class="header__navbar__item">
                    <div class="header__navbar__item__wrapper">
                        <a href="tel:08909090" class="header__navbar__item__link">
                            <i class="support-icon nav-icon"></i>
                            <div class="header__navbar__item__link__desc__wrapper">
                                <p>Tổng đài hỗ trợ</p>
                                <p>1800.2097</p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="header__navbar__item">
                    <div class="header__navbar__item__wrapper">
                        <a href="/lookup" class="header__navbar__item__link">
                            <i class="ship-icon nav-icon"></i>
                            <div class="header__navbar__item__link__desc__wrapper">
                                <p>Tra cứu</p>
                                <p>đơn hàng</p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="header__navbar__item">
                    <div class="header__navbar__item__wrapper">
                        <a href="/cart" class="header__navbar__item__link">
                            <i class="cart-icon nav-icon"></i>
                            <div class="header__navbar__item__link__desc__wrapper">
                                <p>Giỏ hàng</p>
                            </div>
                        </a>
                    </div>
                </li>
                <li class="header__navbar__item" style="position: relative;">
                    <div class="header__navbar__item__wrapper">
                        <a href="/" class="header__navbar__item__link">
                            <i class="user-icon nav-icon"></i>
                        </a>
                    </div>
                    <ul class="login-popup">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <div class="hover-item">
                                <a href="/profile">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>

                            <div class="hover-item">
                                <a href="/order">
                                    Lịch sử mua hàng
                                </a>
                            </div>

                            <div class="hover-item">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

@yield('content')