<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="{{asset('favi.ico')}}" type="image/x-icon">


    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <style>
    .item-his {
        position: absolute;
        right: 20px;
        top: 125%;
        z-index: 1;
        padding: 0.5rem;
        border-radius: 4px;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.6);
        background-color: #fff;
    }

    .item-his-sub {
        display: flex;
        align-items: center;
        margin-bottom: 2px;
        box-sizing: border-box;
        text-align: right;
        padding: 0.2rem;
        justify-content: space-around;
        border: 1px solid #edbebe;
        border-radius: 5px;
    }

    .item-his-sub ~ .item-his-sub {
        margin-top: 4px;
    }

    .item-his-sub img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 10px;
        border: 1px solid #edbebe;
    }
    </style>
</head>

<body>
    <!-- top navigation bar -->
    @include('admin.navbar')
    <!-- top navigation bar -->
    <!-- offcanvas -->
    @include('admin.offcanvas')
    <!-- offcanvas -->
    <main class="mt-5 pt-5">
        <!-- manage product -->
        <div class="container-fluid" style="height: calc(100% - 96px);">
            <div class="row" style="height:100%;">
                <div class="col-md-12 mb-3">
                    <div class="card" style="height: calc(100% - 0.8rem);">
                        <div class="card-header text-center">
                            <span><i class="bi bi-table me-2"></i>Lịch sử đơn hàng</span>
                            <div class="search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search-content" id="search-content">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="btn-search-click">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="height:100%;">
                                <table id="example" class="table table-hover data-table text-center"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Tình trạng</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($histories as $h)
                                        <tr class="line-his employee" onclick="showModal({{$h->id}})">
                                            <td>{{$h->id}}</td>
                                            <td>{{$h->phone}}</td>
                                            <td>{{date_format(date_create($h->orderTime), 'H:i d/m/Y')}}</td>
                                            <td>
                                                @if ($h->status == 0)
                                                Đang chờ xử lý
                                                @elseif ($h->status == 1)
                                                Đang giao hàng
                                                @elseif ($h->status == 2)
                                                Đã giao hàng
                                                @elseif ($h->status == 3)
                                                Đã hủy
                                                @endif
                                            </td>
                                            <td>{{number_format($h->total)}} VNĐ
                                            </td>
                                        </tr>
                                        <div class="modal" tabindex="-1" id="viewHistory{{$h->id}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Chi tiết đơn hàng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach($h->item as $it)
                                                        <div class="item-his-sub">
                                                            <div>
                                                                <img src="/images/product/{{$it->img}}" alt="a">
                                                            </div>
                                                            <div>
                                                                <div>
                                                                    <p style="font-size:1.4rem;font-weight:700;">{{$it->name}}</p>
                                                                </div>
                                                                <div>
                                                                    <p style="color:red;font-weight:700;">{{number_format($it->price)}} VNĐ</p>
                                                                </div>
                                                                <div>{{$it->serial}}</div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button onclick="printBill({{$h->id}}, '{{$h->phone}}', '{{date_format(date_create($h->orderTime), 'H:i d/m/Y')}}')" class="btn btn-primary">Xuất hoá đơn</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Thoát</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Số điện thoại</th>
                                            <th>Ngày đặt hàng</th>
                                            <th>Tình trạng</th>
                                            <th>Tổng tiền</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
    function showModal(id) {
        $('#viewHistory' + id).modal('show');
    }

    const searchContent = document.getElementById('search-content');
    searchContent.addEventListener('keyup', function(e) {
        const search = e.target.value;
        console.log(search);
        const employees = document.querySelectorAll('tr.employee');
        employees.forEach(function(employee) {
            if (employee.innerText.toLowerCase().indexOf(search) != -1) {
                employee.style.display = 'table-row';
            } else {
                employee.style.display = 'none';
            }
        });
    });

    function printBill(id) {
        window.open('/print/' + id);
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
</body>