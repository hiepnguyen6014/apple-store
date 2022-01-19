@php
$item = $item[0];
@endphp

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>{{$item->name}}</title>

    <link rel="shortcut icon" href="{{asset('favi.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

</head>

</head>

<body>
    <!-- nav -->
    @include('layouts.header')
    <!-- Product -->

    <div id="content-wrapper">
        <div class="container">
            <div class="row p-3 shadow">
                <div class="col-lg-4 col-md-6 col-sm-6 justify-content-center" style="box-shadow: 0px 0px 3px #00000073;
    padding: 11px;">
                    <img id=featured src="{{  asset('images/product/'.$item->img)  }}" width="100%">
                    <div id="slide-wrapper">
                        <img id="slideLeft" class="arrow" src="{{ asset('images/arrow/arrow-left.png')}}">
                        <div id="slider">
                            <img class="thumbnail active" src="{{  asset('images/product/'.$item->img)  }}">
                            <img class="thumbnail" src="{{  asset('images/product/'.$item->img1)  }}">
                            <img class="thumbnail" src="{{  asset('images/product/'.$item->img2)  }}">
                            <img class="thumbnail" src="{{  asset('images/product/'.$item->img3)  }}">
                            <img class="thumbnail" src="{{  asset('images/product/'.$item->img4)  }}">
                        </div>

                        <img id="slideRight" class="arrow" src="{{ asset('images/arrow/arrow-right.png')}}">
                    </div>
                </div>


                <!--  -->
                <div class="col-lg-5 col-md-6 col-sm-6"
                    style="display: flex; flex-direction: column;padding: 0 1.4rem;">
                    <!-- Name product -->
                    <div class="detail-product__box-name">
                        <div class="cps-container">
                            <div class="box-name__box-product-name">
                                <h1>{{$item->name}}</h1>
                            </div>
                            <div class="box-name__box-raiting">


                                <?php
                            $star = $item->rate;
                            $star_full = floor($star);
                            $star_haft = $star - $star_full;
                            $star_empty = 5 - $star_full - ceil($star_haft);
                            ?>
                                @if ($star > 0 && $item->sellQty > 0)
                                @for($i = 0; $i < $star_full; $i++) <i class="fas fa-star checked"></i>
                                    @endfor
                                    @if ($star_haft > 0)
                                    <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for($i = 0; $i < $star_empty; $i++) <i class="far fa-star"></i>
                                        @endfor

                                        <p class="rate_cmt" style="padding-left: 10px;"> {{$item->sellQty}} đã bán</p>
                                        @endif
                            </div>
                        </div>
                    </div>
                    <?php
            $new_price = $item->oldPrice;
            $old_price = $item->newPrice;
            if ($new_price > $old_price) {
                $temp = $new_price;
                $new_price = $old_price;
                $old_price = $temp;
            }
            ?>
                    <!-- price -->
                    <div class="box-info__price">
                        <p class="new-price">
                            {{number_format($new_price)}}₫
                        </p>
                        <p class="old-price">
                            {{number_format($old_price)}}₫
                        </p>
                    </div>
                    <!-- Select colors product -->
                    <div class="box-colors__product">
                        <div class="card mt-3">
                            <div class="card-header bg-danger text-white">
                                <i class="fas fa-gift"></i> Khuyến Mãi
                            </div>
                            <div class="card-body">

                                <p class="card-text">{{$item->offer}}</p>

                            </div>
                        </div>
                        <form action="{{url('insert-cart')}}" method="post" id="buy-form">
                            @csrf
                            <?php
                            if (Auth::check()) {
                                $userId = Auth::user()->id;
                            } else {
                                $userId = 0;
                            }
                        ?>
                            <input type="text" name="userId" class="d-none" value="{{ $userId }}">
                            <input type="text" name="productId" class="d-none" value="{{$item->id}}">
                            <input type="text" name="qty" class="d-none" value="1">
                            <input type="text" name="price" class="d-none" value="{{$new_price}}">
                        </form>

                        <button type="submit" form="buy-form" class="btn btn-danger mt-3" style="width:100%">
                            Mua ngay
                        </button>

                        <form action="{{url('insert-cart')}}" method="post" id="cart-form">
                            @csrf
                            <input type="text" name="userId" class="d-none" value="{{ $userId }}">
                            <input type="text" name="productId" class="d-none" value="{{$item->id}}">
                            <input type="text" name="qty" class="d-none" value="1">
                            <input type="text" name="price" class="d-none" value="{{$new_price}}">
                            <input type="text" name="price1" class="d-none" value="{{$new_price}}">
                        </form>

                        <button type="submit" form="cart-form" class="btn btn-primary mt-3" style="width:100%">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </div>

                <div class="col-lg-3 mt-3" style="height: 440px">
                    <div class="card" style="height: 100%">
                        <div class="card-body">
                            <h5>Chính sách đổi trả</h5>
                            <p class="card-text">
                                - Trong 30 ngày đầu nhập lại máy, trừ phí 20% trên giá hiện tại(hoặc
                                giá mua nếu giá mua thấp hơn giá hiện tại).
                                <br>
                                - Sau 30 ngày nhập lại máy theo giá thoả thuận.
                                <br>
                                - Bảo hành 12 tháng tại trung tâm bảo hành chính hãng Apple Việt Nam. 1 ĐỔI 1 trong 30
                                ngày nếu có lỗi phần cứng nhà sản xuất. Gia hạn bảo hành thời gian giãn cách.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="title-row">
                    Sản phẩm tương tự
                </div>
            </div>
            <!-- end row -->

            <!-- row san pham tuong tu -->
            <div class="row mt-3 item-list">

                <!-- item 1 -->
                @foreach ($item__similar as $item1)
                <div class="col-md-12">
                    <div class="item">
                        <a href="/product/{{$item1->id}}" class="detail-item__similar">
                            <img src="{{ asset('images/product/'.$item1->img)}}" alt="" width="235px" height="186px">
                        </a>
                        <div class="user-info">
                            <a href='/product/{{$item1->id}}' class="detail-item__similar">
                                <p class="title">{{$item1->name}}</p>
                            </a>
                            <div class="pos-price">
                                <p class="price-new__detail">{{$item1->newPrice}} ₫</p>
                                <p class="price-old__detail">{{$item1->oldPrice}} ₫</p>
                            </div>
                            <div class="box-name__box-raiting">
                                <?php
                                $star = $item->rate;
                                $star_full = floor($star);
                                $star_haft = $star - $star_full;
                                $star_empty = 5 - $star_full - ceil($star_haft);
                                ?>

                                @for($i = 0; $i < $star_full; $i++) <i class="fas fa-star checked"></i>
                                    @endfor
                                    @if ($star_haft > 0) <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for($i = 0; $i < $star_empty; $i++) <i class="far fa-star"></i>
                                        @endfor
                                        @if($item1->sellQty > 0){{$item1->sellQty}} đã bán
                                        @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach


            </div>
            <!-- end row san pham tuong tu -->


            <div class="table-responsive mt-5">
                <!--Table-->
                <table class="table table-striped table-bordered table-hover overflow-hidden">

                    <!--Table head-->
                    <thead>
                        <tr>
                            <h3>Thông số kĩ thuật</h3>
                        </tr>
                    </thead>
                    <!--Table head-->

                    <!--Table body-->
                    <tbody>
                        @if($item->cpu)
                        <tr>
                            <th scope="row">CPU</th>
                            <td>{{$item->cpu}}</td>
                        </tr>
                        @endif
                        @if ($item->screen)
                        <tr>
                            <th scope="row">Màn hình</th>
                            <td>{{$item->screen}}</td>
                        </tr>
                        @endif
                        @if($item->resolution)
                        <tr>
                            <th scope="row">Độ phân giải</th>
                            <td>{{$item->resolution}}</td>
                        </tr>
                        @endif
                        @if ($item->ram)
                        <tr>
                            <th scope="row">Ram</th>
                            <td>{{$item->ram}}</td>
                        </tr>
                        @endif
                        @if ($item->weight)
                        <tr>
                            <th scope="row">Trọng lượng</th>
                            <td>{{$item->weight}}</td>
                        </tr>
                        @endif
                        @if ($item->camera)
                        <tr>
                            <th scope="row">Camera</th>
                            <td>{{$item->camera}}</td>
                        </tr>
                        @endif
                        @if(($item->storage))
                        <tr>
                            <th scope="row">Bộ nhớ</th>
                            <td>{{$item->storage}}</td>
                        </tr>
                        @endif
                        @if($item->pin)
                        <tr>
                            <th scope="row">Pin</th>
                            <td>{{$item->pin}}</td>
                        </tr>
                        @endif
                        @if ($item->port)
                        <tr>
                            <th scope="row">Cổng</th>
                            <td>{{$item->port}}</td>
                        </tr>
                        @endif
                        @if($item->feature)
                        <tr>
                            <th scope="row">Tính năng</th>
                            <td>{{$item->feature}}</td>
                        </tr>
                        @endif
                        @if($item->bluetooth)
                        <tr>
                            <th scope="row">Bluetooth</th>
                            <td>{{$item->bluetooth}}</td>
                        </tr>
                        @endif
                        @if($item->compatible)
                        <tr>
                            <th scope="row">Compatible</th>
                            <td>{{$item->compatible}}</td>
                        </tr>
                        @endif


                    </tbody>
                    <!--Table body-->
                </table>
                <!--Table-->
            </div>


        </div>

        <!-- San pham tuong tu -->
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
    let thumbnails = document.getElementsByClassName('thumbnail')

    let activeImages = document.getElementsByClassName('active')

    for (var i = 0; i < thumbnails.length; i++) {

        thumbnails[i].addEventListener('mouseover', function() {
            console.log(activeImages)

            if (activeImages.length > 0) {
                activeImages[0].classList.remove('active')
            }


            this.classList.add('active')
            document.getElementById('featured').src = this.src
        })
    }


    let buttonRight = document.getElementById('slideRight');
    let buttonLeft = document.getElementById('slideLeft');

    buttonLeft.addEventListener('click', function() {
        document.getElementById('slider').scrollLeft -= 180
    })

    buttonRight.addEventListener('click', function() {
        document.getElementById('slider').scrollLeft += 180
    })

    // let color = document.querySelectorAll('.js_click');
    // for (var i=0; i < color.length; i++){
    // 	color[i].addEventListener('click', function() {
    // 		console.log(color[i].firstElementChild.innerHTML)
    // 		document.getElementById('featured').src = color[i].nextElementSibling.src
    // 	})
    // }


    // Slick silder product detail
    $(document).ready(function() {
        $('.item-list').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 4.5,
            slidesToScroll: 2,
            dots: true,
            arrows: false,
            prevArrow: "<button type='button' class='slick-prev slick-arrow'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
            nextArrow: "<button type='button' class='slick-next slick-arrow'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
            responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        centerPadding: '70px',
                        centerMode: true,
                    }
                },

            ]
        });
    });
    </script>
</body>