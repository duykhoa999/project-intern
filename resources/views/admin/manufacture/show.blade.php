@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
               Cập nhật nhà cung cấp
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
                    <form role="form" action="{{route('admin.manufacture.update', ['id' => $edit_manufacture->ma_ncc])}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã nhà cung cấp</label>
                            <input disabled type="text" value="{{$edit_manufacture->ma_ncc}}" data-validation="length" data-validation-length="min10" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control " placeholder="Mã nhà cung cấp" required>
                            @if ($errors->has('ma_ncc'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_ncc')}}</span>
                            @endif
                            <input type="hidden" value="{{$edit_manufacture->ma_ncc}}" name="ma_ncc" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                            <input type="text" name="ten_ncc"  value="{{$edit_manufacture->ten_ncc}}" class="form-control" placeholder="Tên nhà cung cấp" required>
                            @if ($errors->has('ten_ncc'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ten_ncc')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Địa chỉ</label>
                            <textarea style="resize: none"rows="8" class="form-control" id="ckeditor1" name="dia_chi" placeholder="Địa chỉ" required>{{$edit_manufacture->dia_chi}}</textarea>
                            @if ($errors->has('dia_chi'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('dia_chi')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" value="{{$edit_manufacture->email}}" name="email" placeholder="Điền email" required>
                            @if ($errors->has('email'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_manufacture" class="btn btn-info">Cập nhật nhà cung cấp</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.manufacture.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
