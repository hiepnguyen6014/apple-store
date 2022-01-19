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
</head>

<body>
    <!-- top navigation bar -->
    @include('admin.navbar')
    <!-- top navigation bar -->
    <!-- offcanvas -->
    @include('admin.offcanvas')
    <!-- offcanvas -->
    <main class="mt-5 pt-3">
        <!-- dashboard -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 p-3">
                    <h4 class="m-0 text-center">Tổng quan</h4>
                </div>
            </div>
            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-header">
                            <i class="fas fa-check-circle"></i>
                            <span class="p-1">Đơn hàng thành công</span>
                        </div>
                        <div class="card-body py-5">Nội dung</div>
                        <div class="card-footer">Tổng tiền: </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-header">
                            <i class="far fa-comment-dots"></i>
                            <span class="p-1">Đơn hàng đang xử lý</span>
                        </div>
                        <div class="card-body py-5">Nội dung</div>
                        <div class="card-footer">Tổng tiền: </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-danger text-white h-100">
                        <div class="card-header">
                            <i class="fas fa-times-circle"></i>
                            <span class="p-1">Đơn hàng bị huỷ</span>
                        </div>
                        <div class="card-body py-5">Nội dung</div>
                        <div class="card-footer">Tồng tiền:</div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2">
                                <i class="fas fa-chart-line"></i>
                            </span> Doanh thu theo tháng
                        </div>
                        <div class="card-body">
                            <canvas class="chart" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card h-100">
                        <div class="card-header">
                            <span class="me-2">
                                <i class="fas fa-chart-line"></i>
                            </span> Doanh thu theo ngày
                        </div>
                        <div class="card-body">
                            <canvas class="chart" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
</body>