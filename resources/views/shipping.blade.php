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

    tr img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
        border: 1px solid #ccc;
    }

    .table td, .table th {
    padding: .75rem;
    vertical-align: middle;
    border-top: 1px solid #dee2e6;
}

    </style>
</head>

<body>
    @include('layouts.header')
    <div class="container">
        <div class="row justify-content-center mt-3 bg-light p-3">
            <h4>KIỂM TRA THÔNG TIN ĐƠN HÀNG & TÌNH TRẠNG VẬN CHUYỂN</h4>
            <form class="form-inline mt-3" action="/look" method="post">
                @csrf
                <label for="sdt" class="mr-sm-2 mb-2 font-weight-bold">Số điện thoại:</label>
                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="(Bắt buộc)" id="sdt" name="phone">
                <label for="mdh" class="mr-sm-2 mb-2 font-weight-bold">Mã đơn hàng:</label>
                <input type="text" class="form-control mb-2 mr-sm-2" placeholder="(Bắt buộc)" id="mdh" name="id">
                <button type="submit" class="text-center btn btn-danger mb-2 pl-4 pr-4">KIỂM TRA</button>
            </form>
        </div>
        <div class="row">
            @if(isset($data))
            @if ($data == null)
            <p class="w-100 text-center mt-5" style="font-size:1.7rem;">Mã đơn hàng không tồn tại</p>
            @else

            <?php
            $total = 0;
                foreach ($data as $value) {
                    $total += $value->price;
                }
            ?>
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá tiền</th>
                        <th scope="col">Số lượng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>
                            <img src="/images/product/{{$item->img}}" alt="a">
                            {{$item->name}}
                        </td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->qty}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <table class="table table-hover data-table align-middle text-center mt-4">
                <thead>
                    <tr>
                        <th>Mã đơn: {{$data[0]->order_id}}</th>
                        <th>Thời gian đặt: {{date_format(date_create($data[0]->orderTime), 'H:i d/m/Y')}}</th>

                        <th>Tình trạng: @if ($data[0]->status == 0)
                            Đang chờ xử lý
                            @elseif ($data[0]->status == 1)
                            Đang giao hàng
                            @elseif ($data[0]->status == 2)
                            Đã giao hàng
                            @elseif ($data[0]->status == 3)
                            Đã hủy
                            @endif</th>
                        <th>Tổng tiền:
                            {{number_format($total)}} VNĐ
                        </th>
                    </tr>
                </thead>
            </table>

            @endif
            @else
            <p class="w-100 text-center mt-5" style="font-size:1.7rem;">Vui lòng nhập số điện thoại và mã đơn hàng của
                bạn</p>

            @endif
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