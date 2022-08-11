@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thương hiệu
            </div>
            {{ csrf_field() }}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                        style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                        onclick="window.location.assign('{{ route('admin.trademark.create') }}')"><span
                            style="margin-left: 10px">Thương hiệu</span></i></a>
                <form style="float: right" action="{{ route('admin.trademark.index') }}" method="get">
                    <div class="group-input f-r">
                        <input type="text" name="key_search" value="{{ $key_search ?? '' }}" placeholder="Tìm kiếm">
                        <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
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
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Mã thương hiệu</th>
                            <th>Tên thương hiệu</th>
                            <th>Hình ảnh</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th style="width:30px;">Hành động</th>
                        </tr>
                    </thead>
                    <style type="text/css">
                        #category_order .ui-state-highlight {
                            padding: 24px;
                            background-color: #ffffcc;
                            border: 1px dotted #ccc;
                            cursor: move;
                            margin-top: 12px;
                        }
                    </style>

                    <tbody id="category_order">

                        @foreach ($all_trademark as $key => $trademark)
                            <tr id="{{ $trademark->ma_th }}">
                                <td>{{ $trademark->ma_th }}</td>
                                <td>{{ $trademark->ten_th }}</td>
                                <td><img src="/uploads/type/{{ $trademark->hinh_anh }}" height="100%" width="100px"></td>
                                <td>{{ $trademark->slug }}</td>
                                <td>{{ $trademark->mo_ta }}</td>
                                <td>
                                    <a href="{{ route('admin.trademark.show', ['id' => $trademark->ma_th]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.trademark.delete', ['id' => $trademark->ma_th]) }}"
                                        onclick="event.preventDefault();
                            window.confirm('Bạn có chắc là muốn xóa nhà cung cấp này không?') ?
                            document.getElementById('trademark-delete-{{ $trademark->ma_th }}').submit():
                            0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.trademark.delete', ['id' => $trademark->ma_th]) }}"
                                        method="post" id="trademark-delete-{{ $trademark->ma_th }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
