<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
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
    td,
    tr {
        text-align: center;
        vertical-align: middle;
    }

    .item-his-sub {
        display: flex;
        align-items: center;
        margin-bottom: 2px;
        box-sizing: border-box;
        text-align: right;
        padding: 0.2rem;
        justify-content: space-between;
        border: 1px solid #edbebe;
        border-radius: 5px;
        padding: 6px 27px;
    }

    .item-his-sub img {
        width: 50px;
        height: 50px;
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <span><i class="bi bi-table me-2"></i>Đơn hàng yêu cầu</span>
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
                            <div class="table-responsive">
                                <table id="example" class="table table-hover data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Thời gian đặt</th>
                                            <th>Tổng tiền</th>
                                            <th>Thanh toán</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ships as $order)
                                        <tr data-id="{{$order->id}}" onclick="viewHistory({{$order->id}})" class="employee">
                                            <td>{{$order->id}}</td>
                                            <td>{{date_format(date_create($order->orderTime), 'H:i d/m/Y')}}</td>
                                            <td>{{number_format($order->total)}} VNĐ</td>
                                            <td>
                                                <span class="text-success">
                                                    {{($order->pay) ? "Đã thanh toán" : "Chưa thanh toán"}}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-primary">
                                                    @if ($order->status == 0)
                                                    Đang chờ xử lý
                                                    @elseif ($order->status == 1)
                                                    Đang giao hàng
                                                    @elseif ($order->status == 2)
                                                    Đã giao hàng
                                                    @elseif ($order->status == 3)
                                                    Đã hủy
                                                    @endif
                                                </span>
                                            </td>
                                            <div class="modal" tabindex="-1" id="viewHistory{{$order->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Chi tiết đơn hàng</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div id="form{{$order->id}}">
                                                                @foreach($order->items as $it)
                                                                <p>Số lượng còn lại: {{$it->sellQty}}</p>
                                                                <div class="mb-4">
                                                                    <div class="item-his-sub">
                                                                        <div>
                                                                            <img src="/images/product/{{$it->img}}"
                                                                                alt="a">
                                                                        </div>
                                                                        <div>
                                                                            <div>{{$it->name}}</div>
                                                                            <div>{{number_format($it->price)}} VNĐ</div>
                                                                        </div>
                                                                    </div>
                                                                    <form action="/add-serial" method="post">
                                                                        <input type="hidden" name="id"
                                                                            value="{{$it->id}}">
                                                                        <input type="text" class="form-control"
                                                                            name="serial" placeholder="Serial"
                                                                            value="{{$it->serial}}">
                                                                            <input type="hidden" class="form-control"
                                                                            name="back" 
                                                                            value="{{$order->id}}">
                                                                        @csrf
                                                                        <button
                                                                            class="btn btn-outline-primary w-100">Thêm</button>
                                                                    </form>

                                                                </div>

                                                                @endforeach
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer" style="background-color:white;">
                                                            <button onclick="showOrderDismiss({{$order->id}})"
                                                                class="btn btn-danger">Từ chối</button>
                                                            <button onclick="showOrderAcp({{$order->id}})"
                                                                class="btn btn-primary">Đồng ý</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Thời gian đặt</th>
                                            <th>Tổng tiền</th>
                                            <th>Thanh toán</th>
                                            <th>Trạng thái</th>
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

    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
    function viewHistory(id) {
        $('#viewHistory' + id).modal('show');
    }

    function showOrderDismiss(id) {

        let r = confirm("Bạn có chắc chắn muốn hủy đơn hàng này?");
        if (r) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/dis-order';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;
            form.appendChild(input);
            const input3 = document.createElement('input');
            input3.type = 'hidden';
            input3.name = 'status';
            input3.value = 3;
            form.appendChild(input3);
            const input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = '_token';
            input1.value = '{{ csrf_token() }}';
            form.appendChild(input1);
            document.body.appendChild(form);
            form.submit();
        }

    }

    function showOrderAcp(id) {
        $('#form' + id).submit();
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/dis-order';
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'id';
        input.value = id;
        form.appendChild(input);
        const input3 = document.createElement('input');
        input3.type = 'hidden';
        input3.name = 'status';
        input3.value = 1;
        form.appendChild(input3);
        const input1 = document.createElement('input');
        input1.type = 'hidden';
        input1.name = '_token';
        input1.value = '{{ csrf_token() }}';
        form.appendChild(input1);
        document.body.appendChild(form);
        form.submit();
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
    
    </script>
    @if(session('id'))
        <script>
            $('#viewHistory' + {{ session('id')}}).modal('show');
        </script>
    @endif
    @if(session('status'))
        <script>
            swal("{{ session('status')}}");
        </script>
    @endif
</body>

</html>