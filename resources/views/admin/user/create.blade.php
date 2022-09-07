@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm nhân viên
            </header>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="panel-body">

                <div class="position-center">
                    <form role="form" action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="ma_nv">Mã nhân viên</label>
                            <input type="text" name="ma_nv" value="{{old('ma_nv')}}" placeholder="Mã nhân viên" class="form-control" />
                            @if ($errors->has('ma_nv'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_nv')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="ho_ten">Họ Và Tên</label>
                            <input type="text" name="ho_ten" value="{{old('ho_ten')}}" placeholder="Họ và tên" class="form-control" />
                            @if ($errors->has('ho_ten'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ho_ten')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="sdt">Số Điện Thoại</label>
                            <input type="tel" name="sdt" value="{{old('sdt')}}" placeholder="Số điện thoại" class="form-control" />
                            @if ($errors->has('sdt'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('sdt')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="dia_chi">Địa chỉ</label>
                            <input type="text" id="dia_chi" name="dia_chi" value="{{old('dia_chi')}}" placeholder="Địa chỉ" class="form-control" />
                            @if ($errors->has('dia_chi'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('dia_chi')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="ngay_sinh">Ngày sinh</label>
                            <input type="date"  name="ngay_sinh" value="{{old('ngay_sinh')}}" placeholder="Ngay sinh" class="form-control" />
                            @if ($errors->has('ngay_sinh'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('ngay_sinh')}}</span>
                            @endif
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
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{old('email')}}" placeholder="Email" class="form-control" />
                            @if ($errors->has('email'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Mật Khẩu</label>
                            <input type="password" id="password" name="password" value="" placeholder="Mật khẩu" class="form-control" />
                            @if ($errors->has('password'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Xác nhận Mật Khẩu</label>
                            <input type="password" name="password_confirmation" value="" placeholder="Xác nhận mật khẩu" class="form-control" />
                            @if ($errors->has('password_confirmation'))
                                <span style="color: red; font-weight: 700;">{{$errors->first('password_confirmation')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_user" class="btn btn-info">Thêm nhân viên</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.user.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
