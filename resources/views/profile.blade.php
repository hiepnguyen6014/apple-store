<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->name }}</title>

    <link rel="shortcut icon" href="{{asset('favi.ico')}}" type="image/x-icon">

    <style>
    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }
    </style>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    @include('layouts.header')
    <div class="container rounded bg-white mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-5 border">
                <div class="d-flex flex-column align-items-center text-center pt-5">
                    <h3 class="font-weight-bold font">{{ Auth::user()->name }}</h3>
                    <span class="text-black-50">{{ Auth::user()->email }}</span>
                </div>
                <form action="/insert-profile/{{Auth::user()->id}}" method="POST" class="p-3">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Họ & tên: </label>
                            <input type="text" name="name" class="form-control" placeholder="Nguyễn Văn A"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Số điện thoại: </label>
                            <input type="text" name="phone" class="form-control" placeholder="09016545131"
                                value="{{ Auth::user()->phone }}" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Tỉnh: </label>
                            <input type="text" name="province" class="form-control" placeholder="Ho Chi Minh"
                                value="{{ Auth::user()->province }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Thành phố:</label>
                            <input type="text" name="city" class="form-control" placeholder="Ho Chi Minh"
                                value="{{ Auth::user()->city }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label class="labels">Xã/phường: </label>
                            <input type="text" name="district" class="form-control" placeholder="Quan 7"
                                value="{{ Auth::user()->district }}" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">

                            <label class="labels">Số nhà/tên đường: </label>
                            <input type="text" name="address" class="form-control" placeholder="123/123 Lê Đức Thọ"
                                value="{{ Auth::user()->address }}" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <h5 class="d-block">Địa chỉ:</h5>
                        <p class="d-block">{{ Auth::user()->address }} - {{ Auth::user()->district }} - {{ Auth::user()->city }} - {{ Auth::user()->province }}</p>
                    </div>
                    <div class="mt-3 text-center">
                        <button class="btn btn-primary profile-button" type="submit">
                            Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>