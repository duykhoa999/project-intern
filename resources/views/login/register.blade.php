<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/cart_detail.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/cart.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/signup.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="shortcut icon" href="dist/img/logodocument.png" type="image/png" />
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>
    <title>ĐĂNG KÝ</title>
</head>

<body>
    <section class="section-sign">
        <!-- <div class="col-xs-2 col-sm-3 col-md-3 col-lg-4"></div> -->
        <div class="col-xs-8 col-sm-6 col-md-6 col-lg-4 form-background">
            <h3>Tạo Tài Khoản!</h3>
            <div class="icon">
                <a href=""><i class="fab fa-facebook-f"></i></a>
                <a href=""><i class="fab fa-google-plus-g"></i></a>
                <a href=""><i class="fab fa-linkedin-in"></i></a>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form">
                <div class="row">
                    <form action="{{route('postRegister')}}" name="sign-form" id="sign-form" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="ho_ten">Họ Và Tên</label>
                                <input type="text" name="ho_ten" value="{{old('ho_ten')}}" placeholder="Họ và tên" class="form-control" />
                                @if ($errors->has('ho_ten'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('ho_ten')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="sdt">Số Điện Thoại</label>
                                <input type="tel" name="sdt" value="{{old('sdt')}}" placeholder="Số điện thoại" class="form-control" />
                                @if ($errors->has('sdt'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('sdt')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="dia_chi">Địa chỉ</label>
                                <input type="text" id="dia_chi" name="dia_chi" value="{{old('dia_chi')}}" placeholder="Địa chỉ" class="form-control" />
                                @if ($errors->has('dia_chi'))
                                    <span style="color: red; font-weight: 700;">{{$errors->first('dia_chi')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="ngay_sinh">Ngày sinh</label>
                                <input type="date"  name="ngay_sinh" value="{{old('ngay_sinh')}}" placeholder="Ngay sinh" class="form-control" />
                                @if ($errors->has('ngay_sinh'))
                                    <span style="color: red; font-weight: 700;">{{$errors->first('ngay_sinh')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label class="radio-inline">
                                    <input type="radio" name="phai" value="0" checked>&nbsp;Nam
                                </label>
                                &emsp;&emsp;&emsp;&emsp;
                                <label class="radio-inline">
                                    <input type="radio" name="phai" value="1">&nbsp;Nữ
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control" />
                                @if ($errors->has('email'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('email')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="password">Mật Khẩu</label>
                                <input type="password" id="password" name="password" value="" placeholder="Mật khẩu" class="form-control" />
                                @if ($errors->has('password'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('password')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <label for="password_confirmation">Xác nhận Mật Khẩu</label>
                                <input type="password" name="password_confirmation" value="" placeholder="Xác nhận mật khẩu" class="form-control" />
                                @if ($errors->has('password_confirmation'))
                                    <span style="color: red; font-weight: 700;">{{$errors->first('password_confirmation')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item">
                                <button type="submit" class="btn-login miss">Đăng
                                    Ký</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item center">
                                <h2>Đã có tài khoản ?</h2>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-item center">
                                <a href="{{route('getLogin')}}" class="creat">Đăng Nhập </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>
<script src="{{asset('frontend/js/search.js')}}"></script>
<script src="{{asset('frontend/js/detail.js')}}"></script>

</html>
