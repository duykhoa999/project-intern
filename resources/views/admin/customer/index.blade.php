@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Khách hàng
            </div>

            {{ csrf_field() }}
            <div class="row w3-res-tb">
                <form style="float: right" action="{{ route('admin.customer.index') }}" method="get">
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
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            {{-- <th style="width:30px;">Hành động</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($all_customer as $key => $row)
                            <tr>
                                <td><label class="i-checks m-b-none">{{ $row->ma_kh }}</td>
                                <td>{{ $row->ho_ten }}</td>
                                <td>{{ $row->dia_chi }}</td>
                                <td>{{ $row->sdt }}</td>
                                {{-- <td>
                                    <a href="{{ route('admin.customer.show', ['id' => $row->ma_kh]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                                    <a class="active styling-edit"
                                        href="{{ route('admin.customer.delete', ['id' => $row->ma_kh]) }}"
                                        onclick="event.preventDefault();
                                        window.confirm('Bạn có chắc là muốn xóa loại rượu này không?') ?
                                        document.getElementById('customer-delete-{{ $row->ma_kh }}').submit():
                                        0;"><i
                                            class="fa fa-times text-danger text"></i></a>
                                    <form action="{{ route('admin.customer.delete', ['id' => $row->ma_kh]) }}"
                                        method="post" id="customer-delete-{{ $row->ma_kh }}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                    </form>
                                </td> --}}
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
                            {!! $all_customer->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
