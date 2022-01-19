<!DOCTYPE html>
<html lang="en">

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
            <span class="btn btn-primary d-flex" style="align-items: center" data-bs-target="#createEmployee"
                data-bs-toggle="modal">
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
                            <span><i class="bi bi-table me-2"></i>Danh sách nhân viên</span>
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
                                            <th>Tên</th>
                                            <th>SĐT</th>
                                            <th>Email</th>
                                            <th>Chức vụ</th>
                                            <th>Địa chỉ</th>
                                            <th>Mức lương</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        @if($user->role == 2 || $user->role == 3)
                                        <tr onclick="showDetailProduct({{$user->id}})" class="employee">
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            @switch($user->role)
                                            @case(1)
                                            <td>Admin</td>
                                            @break
                                            @case(2)
                                            <td>Nhân viên bán hàng</td>
                                            @break
                                            @case(3)
                                            <td>Nhân viên viên kho</td>
                                            @break
                                            @default

                                            @endswitch
                                            <td>{{$user->address}}</td>
                                            <td>{{$user->salary}}</td>
                                            <div class="modal fade" id="{{$user->id}}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Nhân viên
                                                                {{$user->name}}</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{url('update-employee/'.$user->id)}}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="fullname">Họ và tên:</label>
                                                                        <input type="text" name="name" id="name1"
                                                                            class="form-control"
                                                                            value="{{$user->name}}">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="email1">Email:</label>
                                                                        <input type="text" name="email"
                                                                            value="{{$user->email}}" id="email1"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="phone1">Số điện thoại:</label>
                                                                        <input type="text" name="phone" id="phone1"
                                                                            value="{{$user->phone}}"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="email1">Địa chỉ:</label>
                                                                        <input type="text" name="address" id="address1"
                                                                            value="{{$user->address}}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="salary">Lương:</label>
                                                                        <input type="number" name="salary" id="salary1"
                                                                            value="{{$user->salary}}"
                                                                            class="form-control">
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label for="role">Chức vụ:</label>
                                                                        @switch($user->role)
                                                                        @case(1)
                                                                        <select class="form-select" name="role"
                                                                            aria-label="Default select example">
                                                                            <option value="1" selected>admin</option>
                                                                            <option value="2">Nhân viên bán hàng
                                                                            </option>
                                                                            <option value="3">Nhân viên kho</option>
                                                                        </select>
                                                                        @break
                                                                        @case(2)
                                                                        <select class="form-select" name="role"
                                                                            aria-label="Default select example">
                                                                            <option value="1">admin</option>
                                                                            <option value="2" selected>Nhân viên bán
                                                                                hàng</option>
                                                                            <option value="3">Nhân viên kho</option>
                                                                        </select>
                                                                        @break
                                                                        @case(3)
                                                                        <select class="form-select" name="role"
                                                                            aria-label="Default select example">
                                                                            <option value="1">admin</option>
                                                                            <option value="2">Nhân viên bán hàng
                                                                            </option>
                                                                            <option value="3" selected>Nhân viên kho
                                                                            </option>
                                                                        </select>
                                                                        @break
                                                                        @default

                                                                        @endswitch
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="{{url('delete-employee').'/'.$user->id}}"
                                                                    class="btn btn-warning">Xóa</a>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Huỷ bỏ</button>
                                                                <button type="submit" class="btn btn-primary">Cập
                                                                    nhập</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tên</th>
                                            <th>SĐT</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th>Chức vụ</th>
                                            <th>Mức lương</th>

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

    <div class="modal fade" id="createEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm nhân viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{url('insert-employee')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="fullname">Họ và tên:</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="email1">Email:</label>
                                <input type="text" name="email" id="email" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="phone1">Số điện thoại:</label>
                                <input type="text" name="phone" id="phone" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="email1">Địa chỉ:</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="salary">Lương:</label>
                                <input type="number" name="salary" id="salary" class="form-control">
                            </div>
                            <div class="col-md-4">
                                {{-- <label for="dateofbirth">Ngày sinh:</label>
                                <input type="text" name="dateofbirth" id="dateofbirth" class="form-control"> --}}
                                <label for="role">Chức vụ:</label>
                                <select class="form-select" name="role" aria-label="Default select example">
                                    <option value="1">admin</option>
                                    <option value="2" selected>Nhân viên bán hàng</option>
                                    <option value="3">Nhân viên kho</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ bỏ</button>
                        <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script src="{{asset('js/app.js')}}"></script>
    <script>
    function showDetailProduct(id) {
        $('#' + id).modal('show');
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

    const searchButton = document.getElementById('btn-search-click');
    //click searchButton by press enter
    searchContent.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Cancel the default action, if needed
            event.preventDefault();
            // Trigger the button element with a click
            searchButton.click();
        }
    });
    </script>

    @if(session('status'))
    <script>
    swal("{{ session('status')}}");
    </script>
    @endif
    <!-- @yield('scripts') -->
</body>



</html>