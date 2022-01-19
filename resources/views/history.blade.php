<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tra cứu đơn hàng</title>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="shortcut icon" href="{{asset('favi.ico')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <style>
    input[type="text"]::placeholder {
        text-align: center;
    }

    .order {
        position: relative;
    }

    .order:hover {
        background-color: #f5f5f5;
    }

    .order-items {
        position: absolute;
        display: none;
        right: 0;
        top: 125%;
        z-index: 1;
        padding: 0.5rem;
        border-radius: 4px;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.6);
        background-color: #fff;
    }

    .order-items::before {
        content: "";
        position: absolute;
        top: -10px;
        right: 25%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 10px solid transparent;
        border-right: 10px solid transparent;
        border-bottom: 10px solid red;

    }

    .order:hover .order-items {
        display: block;
    }

    .item-history {
        display: flex;
        align-items: center;
        margin-bottom: 2px;
        box-sizing: border-box;
        text-align: right;
        padding: 0.2rem;
        
    }

    .item-history ~ .item-history {
        border-top: 1px solid #000;
    }

    .item-history .price-history {
        color: red;
        font-size: 0.8rem;
        font-weight: 900;
    }

    .img-history {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        border: 1px solid #ccc;
    }
    </style>
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <div class="row">
            <table class="table table-bordered mt-4 text-center">
                <thead>
                    <tr>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Thời gian đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr class="order">
                        <td>{{$order['id']}}

                        </td>
                        <td>{{date_format(date_create($order['orderTime']), 'H:i d/m/Y')}}</td>
                        <td>{{number_format($order['total'])}} VNĐ</td>
                        <td>{{($order['pay']) ? "Đã thanh toán" : "Chưa thanh toán"}}</td>
                        <td>
                            @if ($order['status'] == 0)
                            Đang chờ xử lý
                            @elseif ($order['status'] == 1)
                            Đang giao hàng
                            @elseif ($order['status'] == 2)
                            Đã giao hàng
                            @elseif ($order['status'] == 3)
                            Đã hủy
                            @endif
                            <div class="order-items">
                                @foreach ($order['items'] as $detail)
                                <div class="item-history">
                                    <img class="img-history" src="images/product/{{$detail['img']}}" alt="1" width="50px" height="50px">
                                    <div>
                                        <div>{{$detail['name']}} </div>
                                        <p class="price-history">{{number_format($detail['price'])}} VNĐ</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </td>

                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col-12 text-right mt-5">
                <div class="col-12 text-center">
                    <a href="/" class="btn btn-danger">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>