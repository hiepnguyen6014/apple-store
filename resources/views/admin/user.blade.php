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

    <style>
    tr {
        cursor: default;
    }
    </style>

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
        <!-- manage product -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card">
                        <div class="card-header text-center">
                            <span><i class="bi bi-table me-2"></i>Danh sách tài khoản khách hàng</span>
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
                                <table id="example" class="table data-table text-center align-middle"
                                    style="width: 100%;">
                                    <thead>

                                        <tr>
                                            <th>Họ và tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th>Hành động</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        @if ($user->role != 1)

                                        <tr onclick="deleteUser({{$user->id}})" class="employee">
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->address}}</td>
                                            <td>
                                                <button class="btn btn-outline-danger">Xoá</button>
                                            </td>
                                        </tr>

                                        @endif
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Họ và tên</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Địa chỉ</th>
                                            <th>Hành động</th>
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

    <script>
    function deleteUser(id) {
        var r = confirm("Bạn có chắc chắn muốn xoá tài khoản này?");
        if (r) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/delete-user';
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;
            form.appendChild(input);
            const input1 = document.createElement('input');
            input1.type = 'hidden';
            input1.name = '_token';
            input1.value = '{{ csrf_token() }}';
            form.appendChild(input1);
            document.body.appendChild(form);
            form.submit();
        }
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

    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    @if(session('status'))
    <script>
    swal("{{ session('status')}}");
    </script>
    @endif
</body>

</html>