@extends('admin.master')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê mã giảm giá
        </div>
        {{ csrf_field() }}
        <div class="row w3-res-tb">
            <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                    style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                    onclick="window.location.assign('{{ route('admin.coupon.create') }}')"><span style="margin-left: 10px">Mã giảm giá</span></i></a>
            <form style="float: right" action="{{ route('admin.coupon.index') }}" method="get">
                <div class="group-input f-r">
                    <input type="text" name="key_search" value="{{ $key_search ?? '' }}" placeholder="Tìm kiếm">
                    <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-alert">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Tên mã giảm giá</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Mã giảm giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $cou)
                    <tr>

                        <td>{{ $cou->ten_km }}</td>
                        <td>{{ $cou->ngay_bd }}</td>
                        <td>{{ $cou->ngay_kt }}</td>

                        <td>{{ $cou->ma_km }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.coupon.show', ['id' => $cou->ma_km]) }}"
                                class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-eye text-success text-active"></i></a>
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
                        {!!$coupon->links()!!}
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection