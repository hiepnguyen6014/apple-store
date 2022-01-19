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
</head>

<body>
    <!-- top navigation bar -->
    @include('admin.navbar')
    <!-- top navigation bar -->
    <!-- offcanvas -->
    @include('admin.offcanvas')
    <!-- offcanvas -->
    <main class="mt-5 pt-5">
        <div class="button-add">
            <span class="btn btn-primary d-flex" style="align-items: center" data-bs-target="#createDiscount"
                data-bs-toggle="modal">
                <i class="fas fa-plus-circle"></i>
                <span>Thời gian</span>
            </span>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">

                    <div class="card">
                        <div class="card-header text-center">
                        
                            <span><i class="bi bi-table me-2"></i>Các mặt hàng đang sale</span>
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
                                <table id="example" class="table table-hover data-table text-center align-middle"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá 1</th>
                                            <th>Giá 2</th>
                                            <th>Đánh giá</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($discounts as $d)
                                        <tr class="employee">
                                            <td>{{$d->name}}</td>
                                            <td>{{number_format($d->oldPrice)}} VNĐ</td>
                                            <td>{{number_format($d->newPrice)}} VNĐ</td>
                                            <td>{{$d->rate}}</td>
                                            <td>
                                                <button class="btn btn-outline-primary">Huỷ</button>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                    <?php
                                        $date = date('H:i d/m/Y');
                                        $time = $time[0];
                                    ?>
                    <span>Ngày kết thúc khuyễn mãi: {{$time->hours}}:{{$time->minutes}} {{$time->day}}/{{$time->month}}/{{$time->year}}</span>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal fade" id="createDiscount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thời gian kết thúc khuyễn mãi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <h4>Ngày kết thúc khuyễn mãi: {{$time->hours}}:{{$time->minutes}} {{$time->day}}/{{$time->month}}/{{$time->year}}</h4>
                    <form action="/change-discount" method="post" id="discount-form">
                        @csrf
                        <label for="dateEnd">Thời gian: </label>
                        <input type="datetime-local" name="dateEnd" id="dateEnd" class="form-control">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                    <button type="submit" form="discount-form" class="btn btn-primary">Cài đặt</button>
                </div>
            </div>
        </div>
    </div>

    <script>
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

    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @if (session('success'))
        <script>
            swal("{{ session('success')}}");
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
</body>