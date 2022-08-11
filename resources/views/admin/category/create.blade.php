@extends('admin.master')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                thêm loại rượu
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
                    <form role="form" action="{{route('admin.category.store')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mã loại rượu</label>
                            <input type="text" maxlength="10" name="ma_lr" value="{{old('ma_lr')}}" class="form-control " placeholder="Mã loại rượu" required>
                            @if ($errors->has('ma_lr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ma_lr')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên loại rượu</label>
                            <input type="text" name="ten_lr" value="{{old('ten_lr')}}" class="form-control" placeholder="Tên loại rượu" required onkeyup="ChangeToSlug();" id="slug">
                            @if ($errors->has('ten_lr'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('ten_lr')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" name="slug" value="{{old('slug')}}" class="form-control" id="convert_slug">
                            @if ($errors->has('slug'))
                            <span style="color: red; font-weight: 700;">{{$errors->first('slug')}}</span>
                            @endif
                        </div>
                        <button type="submit" name="add_category_product" class="btn btn-info">Thêm loại rượu</button>
                        <button type="button" class="btn btn-default"
                                    onclick="window.location.assign('{{route('admin.category.index')}}')">Hủy</button>
                    </form>
                </div>

            </div>
        </section>

    </div>
    @endsection
