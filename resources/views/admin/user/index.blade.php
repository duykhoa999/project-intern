@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Nhân viên
            </div>

            {{ csrf_field() }}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                    style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                    onclick="window.location.assign('{{ route('admin.user.create') }}')"><span style="margin-left: 10px">Nhân viên</span></i></a>
                <form style="float: right" action="{{ route('admin.user.index') }}" method="get">
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
                <table class="table table-striped b-t b-light" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã nhân viên</th>
                            <th>Tên nhân viên</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th style="width:200px; text-align: center;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_user as $key => $row)
                            <tr>
                                <td><label class="i-checks m-b-none">{{ $row->ma_nv }}</td>
                                <td>{{ $row->ho_ten }}</td>
                                <td>{{ $row->dia_chi }}</td>
                                <td>{{ $row->sdt }}</td>
                                <td style="text-align: center;">
                                    <a href="{{ route('admin.user.show', ['id' => $row->ma_nv]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.user.delete', ['id' => $row->ma_nv]) }}"
                                        onclick="event.preventDefault();
                                        window.confirm('Bạn có chắc là muốn xóa nhân viên này không?') ?
                                        document.getElementById('user-delete-{{ $row->ma_nv }}').submit():
                                        0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.user.delete', ['id' => $row->ma_nv]) }}"
                                        method="post" id="user-delete-{{ $row->ma_nv }}">
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
                            {!! $all_user->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
