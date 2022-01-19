<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <title>Admin</title>
    <link rel="shortcut icon" href="{{asset('favi.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
    .pad-left-right {
        padding-right: calc(1.5rem * .5);
        padding-left: calc(1.5rem * .5);
    }

    .pad-left {
        padding-left: calc(1.5rem * .5);
    }
    </style>
</head>

<body>
    @include('admin.navbar')
    @include('admin.offcanvas')

    <main class="mt-5 pt-5">
        <div class="button-add">
            <span class="btn btn-primary d-flex" style="align-items: center" data-bs-toggle="modal"
                data-bs-target="#createProduct">
                <i class="fas fa-plus-circle"></i>
                <span>Thêm</span>
            </span>
        </div>
        <!-- manage product -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <span><i class="bi bi-table me-2"></i>Quản lý sản phẩm</span>
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
                                <table id="example" class="table table-hover data-table align-middle text-center"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá 1</th>
                                            <th>Giá 2</th>
                                            <th>Đánh giá</th>
                                            <th>Bảo hành (tháng)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr data-id="{{$product->id}}" onclick="showDetailProduct({{$product->id}})" class="employee">
                                            <td>
                                                <img src="{{asset('images/product/'.$product->img)}}" alt=""
                                                    width="40px" height="40px">
                                            </td>
                                            <td>{{$product->name}}</td>
                                            <td>{{number_format($product->oldPrice)}} VNĐ</td>
                                            <td>{{number_format($product->newPrice)}} VNĐ</td>
                                            <td>{{number_format($product->rate, 1)}}</td>
                                            <td>{{$product->guarantee}}</td>
                                            @foreach ($products_detail as $pro_de)
                                                @if($pro_de->product_id === $product->id)
                                                    <div class="modal fade" id="{{$product->id}}" role="dialog">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Chi tiết sản phẩm</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form method="post" action="{{ url('update-product/'.$product->id)}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="price1" class="form-label">Giá 1</label>
                                                                                    <input type="number" class="form-control"  name="oldPrice"
                                                                                        placeholder="12.000.000VNĐ" value="{{$product->oldPrice}}">
                                                                                </div>
                                                                                <div class="form-group col-md-6">
                                                                                    <label for="price2" class="form-label">Giá 2</label>
                                                                                    <input type="number" class="form-control"  name="newPrice"
                                                                                    value="{{$product->newPrice}}"  placeholder="12.000.000VNĐ">
                                                                                </div>
                                                                            </div>
                                                                            <div class="pad-left-right">
                                                                                <label for="offer1" class="form-label">Khuyến mãi</label>
                                                                                <textarea class="form-control"  name="offer" rows="2"
                                                                                    placeholder="Giảm 500k khi mua kèm AirPods">{{$product->offer}}</textarea>
                                                                            </div>

                                                                        <div class="modal-input">
                                                                            <div class="row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label class="form-label">Tên sản phẩm</label>
                                                                                    <input type="text" class="form-control" id="name1" name="name" placeholder="iPhone 13 Pro Max"
                                                                                    value="{{$product->name}}" >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label class="form-label">Loại sản phẩm</label>
                                                                                    <input type="text" id="type1" class="form-control" value="{{$product->type}}" readonly >

                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                    <label for="version1" class="form-label">Phiên bản</label>
                                                                                    <input type="text" class="form-control" value="{{$product->version}}" name="version" id="version1" placeholder="pro" >
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="cpu1" class="form-label">CPU</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->cpu}}" id="cpu1" name="cpu" placeholder="Apple A15" >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="monitor1" class="form-label">Màn hình</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->screen}}" id="monitor1" name="screen" placeholder="6.7 inches" >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="resolution1" class="form-label">Độ phân giải</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->resolution}}" id="resolution" name="resolution" placeholder="1284 x 2778 pixel"
                                                                                        >
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="storage1" class="form-label">Bộ nhớ</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->storage}}" id="storage1" name="storage"
                                                                                        placeholder="512GB" >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="weight1" class="form-label">Cân nặng</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->weight}}" id="weight1" name="weight" placeholder="700g"
                                                                                        >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="camera1" class="form-label">Camera</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->camera}}" id="camera" name="camera"
                                                                                        placeholder="Camera trước: 12MP" >
                                                                                </div>

                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="ram1" class="form-label">RAM</label>
                                                                                    <input type="text" class="form-control" value="{{$pro_de->ram}}" id="ram1" name="ram" placeholder="6GB"
                                                                                        >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="pin1" class="form-label">Pin</label>
                                                                                    <input type="text" class="form-control" id="pin1" value="{{$pro_de->pin}}" name="pin" placeholder="4325mAh"
                                                                                        >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="port1" class="form-label">Cổng kết nối</label>
                                                                                    <input type="text" class="form-control" id="port1" value="{{$pro_de->port}}" name="port" placeholder="Type-C"
                                                                                        >
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">

                                                                                <div class="form-group col-md-4">
                                                                                    <label for="feature1" class="form-label">Tính năng</label>
                                                                                    <input type="text" class="form-control" id="feature" value="{{$pro_de->feature}}" name="feature"
                                                                                        placeholder="Camera cận cảnh" >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="bluetooth1" class="form-label">Bluetooth</label>
                                                                                    <input type="text" class="form-control" id="bluetooth" value="{{$pro_de->bluetooth}}" name="bluetooth"
                                                                                        placeholder="Bluetooth 5.0" >
                                                                                </div>
                                                                                <div class="form-group col-md-4">
                                                                                    <label for="compatible1" class="form-label">Tương thích</label>
                                                                                    <input type="text" class="form-control" id="compatible" value="{{$pro_de->compatible}}" name="compatible"
                                                                                        placeholder="Android 13 trở lên" >
                                                                                </div>
                                                                            </div>

                                                                            <div class="px-3">
                                                                                <input type="checkbox" name="sale1" id="sale1">
                                                                                <label for="sale1" class="form-label">Hot Sale</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class=" modal-footer">
                                                                        <a href="{{url('delete-product/'.$product->id)}}"class="btn btn-warning"  {{-- data-bs-dismiss="modal" --}}>Xóa</a>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                                        <button  type="submit" class="btn btn-primary">Cập nhập</button>
                                                                        {{-- <form action="{{url('delete-product/'.$product->id)}}" method="post">
                                                                            <button type="submit" class="btn btn-warning" data-bs-dismiss="modal">Xoá</button>
                                                                        </form> --}}
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá 1</th>
                                            <th>Giá 2</th>
                                            <th>Đánh giá</th>
                                            <th>Bảo hành (tháng)</th>
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


    <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="post" id="createProduct" enctype="multipart/form-data" action="{{ url('insert-product')}}">
                    {{-- {{crsf_field()}} --}}
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-input">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="name" class="form-label">Tên sản phẩm</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        placeholder="iPhone 13 Pro Max">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="type" class="form-label">Loại sản phẩm</label>
                                    <select class="form-select" name="type" id="type"
                                        aria-label="Default select example">
                                        <option value="0" selected>iPhone</option>
                                        <option value="1">MacBook</option>
                                        <option value="2">iPad</option>
                                        <option value="3">Apple Watch</option>
                                        <option value="4">iMac</option>
                                        <option value="5">Mac mini</option>
                                        <option value="6">AirPods</option>
                                        <option value="7">Phụ kiện</option>
                                    </select>
                                </div>
                                <div class="col-md-4 ">
                                    <label for="version" class="form-label">Phiên bản</label>
                                    <input type="text" class="form-control" id="version" name="version" required
                                        placeholder="pro">
                                </div>
                            </div>
                            <div class=" row">
                                <div class="form-group col-lg-4">
                                    <label for="oldPrice" class="form-label">Giá cũ</label>
                                    <input type="number" class="form-control" id="oldPrice" name="oldPrice" required
                                        placeholder="12.000.000 VNĐ">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="newPrice" class="form-label">Giá mới</label>
                                    <input type="number" class="form-control" id="newPrice" name="newPrice" required
                                        placeholder="12.000.000 VNĐ">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="guarantee" class="form-label">Bảo hành</label>
                                    <input type="number" class="form-control" id="guarantee" name="guarantee" required
                                        placeholder="12">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cpu" class="form-label">CPU</label>
                                    <input type="text" class="form-control" id="cpu" name="cpu" placeholder="Apple A15">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="monitor" class="form-label">Màn hình</label>
                                    <input type="text" class="form-control" id="monitor" name="monitor"
                                        placeholder="6.7 inches">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="resolution" class="form-label">Độ phân giải</label>
                                    <input type="text" class="form-control" id="resolution" name="resolution"
                                        placeholder="1284 x 2778 pixel">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="storage" class="form-label">Bộ nhớ</label>
                                    <input type="text" class="form-control" id="storage" name="storage"
                                        placeholder="512GB">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="weight" class="form-label">Cân nặng</label>
                                    <input type="text" class="form-control" id="weight" name="weight"
                                        placeholder="700g">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="camera" class="form-label">Camera</label>
                                    <input type="text" class="form-control" id="camera" name="camera"
                                        placeholder="Camera trước: 12MP">
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="ram" class="form-label">RAM</label>
                                    <input type="text" class="form-control" id="ram" name="ram" placeholder="6GB">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="pin" class="form-label">Pin</label>
                                    <input type="text" class="form-control" id="pin" name="pin" placeholder="4325mAh">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="port" class="form-label">Cổng kết nối</label>
                                    <input type="text" class="form-control" id="port" name="port" placeholder="Type-C">
                                </div>
                            </div>
                            <div class="row">

                                <div class="form-group col-md-4">
                                    <label for="feature" class="form-label">Tính năng</label>
                                    <input type="text" class="form-control" id="feature" name="feature"
                                        placeholder="Camera cận cảnh">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="bluetooth" class="form-label">Bluetooth</label>
                                    <input type="text" class="form-control" id="bluetooth" name="bluetooth"
                                        placeholder="Bluetooth 5.0">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="compatible" class="form-label">Tương thích</label>
                                    <input type="text" class="form-control" id="compatible" name="compatible"
                                        placeholder="Android 13 trở lên">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mainImage">Thêm ảnh đại diện (Kích cỡ tối ưu x * x)</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <div class="col-md-6">
                                    <label for="images">Thêm ảnh 1 chi tiết sản phẩm</label>
                                    <input type="file" class="form-control" id="image1" name="image1" multiple>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label for="images">Thêm ảnh 2 chi tiết sản phẩm</label>
                                    <input type="file" class="form-control" id="image2" name="image2" multiple>
                                </div>
                                <div class="col-lg-4">
                                    <label for="images">Thêm ảnh 3 chi tiết sản phẩm</label>
                                    <input type="file" class="form-control" id="image3" name="image3" multiple>
                                </div>
                                <div class="col-lg-4">
                                    <label for="images">Thêm ảnh 4 chi tiết sản phẩm</label>
                                    <input type="file" class="form-control" id="image4" name="image4" multiple>
                                </div>
                            </div>
                            <div class="pad-left-right">
                                <label for="offer" class="form-label">Khuyến mãi</label>
                                <textarea class="form-control" id="offer" name="offer" rows="2"
                                    placeholder="Giảm 500k khi mua kèm AirPods"></textarea>
                            </div>
                            <div class="px-3">
                                <input type="checkbox" name="sale" id="sale">
                                <label for="sale" class="form-label">Hot Sale</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
    function showDetailProduct(id) {
        $('#'+id).modal('show');
        console.log(id);
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

    @if(session('status'))
        <script>
            swal("{{ session('status')}}");
        </script>
    @endif
    <!-- @yield('scripts') -->
</body>
