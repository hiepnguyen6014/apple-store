<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sản phẩm bán chạy</title>

    <link rel="shortcut icon" href="{{ asset('favi.ico') }}" type="image/x-icon">
    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body class="antialiased">
    <div id="main">
        @include('layouts.header')
        <div class="featured__phone grid wide" id="iPhone">
            <!-- Title -->
            <div class="row featured__phone__gutter">
                <div class="c-5">
                    <div class="featured__phone__title featured__phone__title__text">
                        <a href="/">Trở về trang chủ</a>
                    </div>
                </div>
            </div>
            <div class="featured__phone__product__list">
                <!-- 5th -->
                @foreach($products as $product)
                <div class="featured__phone__product__item">
                    <!--  Discount -->
                    <?php
                        
                        $price = $product->oldPrice;
                        $old_price = $product->newPrice;
                        if ($price > $old_price) {
                            $temp = $price;
                            $price = $old_price;
                            $old_price = $temp;
                        }
                        if ($old_price > 0) {
                            // $discount = 100 - round(($price * 100) / $old_price);
                            $discount = ceil(($old_price - $price) / $old_price * 100);
                        } else {
                            $discount = 0;
                        }
                        
                    ?>
                    @if($discount > 0)
                    <div class="flash__sale__discount">
                        <p>Giảm {{$discount}}%</p>
                        @endif
                    </div>
                    @if($product->sale != 0)
                    <div class="hot__sale">
                        <img src="{{ asset('images/hot_sale.webp')}}" alt="sale">
                    </div>
                    @endif

                    <div class="featured__phone__product__img__wrapper">
                        <?php
                            $img = "/images/product/" . $product->img;
                        ?>
                        <a href="/product/{{$product->id}}">
                            <img src="{{$img}}" alt="">
                        </a>
                    </div>
                    <div class="featured__phone__product__desc">
                        <div class="featured__phone__product__desc__title">
                            <a href="/product/{{$product->id}} class=" featured__phone__product">
                                {{$product->name}}
                            </a>
                        </div>
                        <div class="featured__phone__product__desc__price">
                            <div class="featured__phone__product__desc__price__new">
                                <p>
                                    {{$product->oldPrice}}
                                    <span class="featured__phone__product__desc__price__unit__new">đ</span>
                                </p>
                            </div>

                            @if($product->newPrice != 0)
                            <div class="featured__phone__product__desc__price__old">
                                <p>
                                    {{$product->newPrice}}
                                    <span class="featured__phone__product__desc__price__unit__old">đ</span>
                                </p>
                            </div>
                            @endif
                        </div>
                        <div class="featured__phone__product__promotion__info">
                            <p>{{$product->offer}}</p>
                        </div>
                        @if ($product->sellQty > 0)
                        <div class="featured__phone__product__desc__rare featured__phone__rare">
                            <div class="featured__phone__product__desc__rare__star">
                                <?php
                                    $star = $product->rate;
                                    $star_full = floor($star);
                                    $star_haft = $star - $star_full;
                                    $star_empty = 5 - $star_full - ceil($star_haft);
                                ?>

                                @for($i = 0; $i < $star_full; $i++) <i class="star-full-icon star-icon"></i>
                                    @endfor
                                    @if ($star_haft > 0)
                                    <i class="star-haft-icon star-icon"></i>
                                    @endif
                                    @for($i = 0; $i < $star_empty; $i++) <i class="star-border-icon star-icon"></i>
                                        @endfor
                            </div>
                            <div class="featured__phone__product__desc__rare__vote">
                                <p>&nbsp;{{$product->sellQty}} đã bán</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="{{asset('js/app.js')}}"></script>

</body>