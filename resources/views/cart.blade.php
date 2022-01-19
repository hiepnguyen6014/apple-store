<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="shortcut icon" href="{{asset('favi.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>

<body>
    @include('layouts.header')

    <section id="shopping-cart">
        <div class="shopping-cart">
            <!-- header -->
            <div class="shopping-cart__header">
                <a href="/">
                    Tiếp tục mua hàng
                </a>
                <h2 class="shopping-cart__title">Giỏ hàng của bạn</h2>
            </div>

            @if(count($cart) > 0)
            <div class="shopping-cart__list">
                <!-- Sản phẩm -->
                @foreach($cart as $item)
                <div class="shopping-cart__list__product">
                    <div class="shopping-cart__list__product-block">
                        <div class="shopping-cart__list__product-block__left">
                            <img src="{{asset('images/product/'.$item->img)}}" alt="img">
                        </div>
                        <div class="shopping-cart__list__product-block__right">
                            <a href="/product/{{$item->productId}}" class="product__name">
                                {{$item->name}}
                            </a>
                            <p class="product__price">
                                <?php
                                    if ($item->oldPrice > $item->newPrice) {
                                        $price = $item->newPrice;
                                    }
                                    else {
                                        $price = $item->oldPrice;
                                    }
                                ?>
                                {{number_format($price)}}&nbsp;₫
                            </p>
                        </div>

                        <form action="/delete-cart/{{$item->id}}" method="post"
                            class="shopping-cart__list__product__bottom" id="delecart">
                            @csrf
                        </form>

                        <div>
                            <button type="submit" form="delecart" class="btn-delete-cart btn">Xóa khỏi giỏ</button>
                        </div>

                    </div>
                </div>
                @endforeach



                <!-- Nhập khuyến mãi -->
                <div class="col-md-12">
                    <label for="note">Lưu ý</label>
                    <input class="form-control" type="text" name="note" require id="note" placeholder="Lưu ý">
                </div>
                <div class="coupon">
                    <span class="align-middle">Nhập mã khuyến mãi: </span>
                    <input class="coupon-input" type="text" value="" name="coupon">
                    <button class="btn coupon-btn btn-outline-primary">Áp dụng</button>
                </div>
                <div class="coupon-price">
                    <span class="coupon-price-left">Mã giảm giá: </span>
                    <span class="coupon-price-right">0 ₫</span>
                </div>
                <!-- Tổng tiền -->
                <?php
                    #sum oldprice in cart
                    $total = 0;
                    foreach($cart as $item){
                        if ($item->oldPrice > $item->newPrice) {
                            $price = $item->newPrice;
                        }
                        else {
                            $price = $item->oldPrice;
                        }
                        $total += $price;
                    }
                ?>
                <div class="total-price">
                    <span class="total-price-left">Tổng tiền:</span>
                    <span class="total-price-right" style="font-size: 1.5rem;">{{number_format($total)}} ₫</span>
                </div>

            </div>

            <div class="shopping-cart__address mt-3">
                <h3 class="shopping-cart__address-title">Địa chỉ giao hàng</h3>
                <div class="row">
                    <div class="shopping-cart__address-content col-md-9">
                        @if (!(Auth::user()->name == null|| 
                        Auth::user()->phone == null||
                        Auth::user()->address == null||
                        Auth::user()->district == null||
                        Auth::user()->city == null||
                        Auth::user()->province == null))
                        <div class="shopping-cart__address-content__left">
                            <div class="shopping-cart__address-content__left__name">
                                <p>{{Auth::user()->name}}</p>
                                <p>{{Auth::user()->phone}}</p>
                            </div>
                            <div class="shopping-cart__address-content__left__address">
                                <p>{{Auth::user()->address}} - {{Auth::user()->district}} -{{Auth::user()->city}}
                                    -{{Auth::user()->province}}</p>
                            </div>
                        </div>
                        @else
                            <p>Vui lòng nhập địa chỉ</p>
                        @endif
                    </div>
                    <div class="col-md-3">
                        <a href="/profile" class="btn btn-outline-primary">Chỉnh sửa</a>
                    </div>
                </div>
                <hr>
                @if (!(Auth::user()->name == null|| 
                        Auth::user()->phone == null||
                        Auth::user()->address == null||
                        Auth::user()->district == null||
                        Auth::user()->city == null||
                        Auth::user()->province == null))
                <form action="/insert-order" method="post" class="mb-3">
                    @csrf
                    <input type="hidden" name="qty" value="{{$total}}">
                    <button type="submit" class="btn btn-primary align-content-center w-100 mt-4 p-2">
                        ĐẶT HÀNG
                    </button>
                </form>
                @endif
            </div>
            @else

            <div class="shopping-cart__empty d-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" fill="currentColor" class="bi bi-emoji-frown"
                    viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z" />
                </svg>
                <p class="shopping-cart__empty-title">Không có sản phẩm nào trong giỏ hàng, vui lòng tải lại trang</p>
                <a href="/" class="btn btn-light shopping-cart__empty__btn-return">Quay về trang chủ</a>
            </div>
            @endif


        </div>
    </section>
    <!--  -->


    <script src="{{asset('js/app.js')}}">
    < /scrip> < /
    body >