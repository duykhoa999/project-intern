@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin hàng hoá
            </div>
            <div class="row w3-res-tb">
                <form style="float: right" action="{{ route('admin.company_order.show', ['id' => $company_order->ma_ddh]) }}" method="get">
                    <div class="group-input f-r">
                        <input type="text" name="key_search" value="{{ $key_search ?? '' }}" placeholder="Tìm kiếm">
                        <button class="btn btn-primary" type="submit">Tìm Kiếm</button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                @if (session('message_add'))
                    <div class="alert alert-success">
                        {{ session('message_add') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error_add') }}
                    </div>
                @endif
                <form action="{{route('admin.company_order.add_detail', ['id' => $company_order->ma_ddh])}}" method="POST">
                    {{csrf_field()}}
                    <table class="table table-striped b-t b-light" id="myTable">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                </th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Thương hiệu</th>
                                <th>Số lượng tồn</th>
                                <th>Giá đặt</th>
                                <th>Số lượng đặt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_product as $key => $pro)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkBox" data-id="{{$pro->ma_dr}}" name="data[{{$pro->ma_dr}}][check]" {{(!empty($session_order) && array_key_exists($pro->ma_dr ,$session_order)) ? 'checked' : '' }}>
                                    </td>

                                    <td>{{ $pro->ten_dr }}</td>
                                    <input type="hidden" name="data[{{$pro->ma_dr}}][ten_dr]" id="name_{{$pro->ma_dr}}" value="{{$pro->ten_dr}}">
                                    <td><img src="/uploads/product/{{ $pro->hinh_anh }}" height="100px" width="100px"></td>
                                    <td>{{ $pro->thuong_hieu->ten_th }}</td>
                                    <td>{{ $pro->sl_ton }}</td>
                                    <td><input style="vertical-align: center;" class="CurrencyInput" value="{{(!empty($session_order) && array_key_exists($pro->ma_dr ,$session_order)) ? $session_order[$pro->ma_dr]['gia'] : '' }}" id="price_{{$pro->ma_dr}}" name="data[{{$pro->ma_dr}}][gia_dat]"></td>
                                    <td><input style="vertical-align: center;" type="number" value="{{(!empty($session_order) && array_key_exists($pro->ma_dr ,$session_order)) ? $session_order[$pro->ma_dr]['so_luong'] : '' }}" min="1" id="qty_{{$pro->ma_dr}}" name="data[{{$pro->ma_dr}}][so_luong]"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </form>
            </div>
            <footer class="panel-footer">
                <div class="row">

                    <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {!! $all_product->links() !!}
                        </ul>
                    </div>
                </div>
            </footer>

        </div>
    </div>
    <br>
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>

            <div class="table-responsive">
                @if (session('message_edit'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('error_edit'))
                    <div class="alert alert-danger">
                        {{ session('error_add') }}
                    </div>
                @endif

                <table class="table table-striped b-t b-light">
                    <thead>

                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Mã Đơn Đặt Hàng</th>
                            <th>Số lượng</th>
                            <th>Giá đặt</th>
                            <th>Tổng tiền</th>

                            <th style="width:30px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($company_order_detail as $details)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                @if (isset($details['products']['0']))
                                    <td>{{ $details['products']['0']->ten_dr }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $company_order->ma_ddh }}</td>
                                <td>{{ $details->so_luong }}</td>
                                <td>{{ number_format($details->gia, 0, ',', ',') }} VND</td>
                                <td>{{ number_format($details->gia * $details->so_luong, 0, ',', ',') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tr>
                        <td colspan="2">
                            @if (isset($order_by_id['0']['order']['0']))
                                @if ($order_by_id['0']['order']['0']->trang_thai == 0)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="0">Đơn
                                                Hàng Mới</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="1">Duyệt
                                                đơn</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id['0']['order']['0']->trang_thai == 1)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" selected
                                                value="1">Đã duyệt</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="2">Phân
                                                công nhân viên</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id['0']['order']['0']->trang_thai == 2)
                                    <form action="">
                                        @csrf
                                        <select name="" class="form-control order_details" id="">
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" selected
                                                value="2">Đã phân công nhân viên</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="3">Hoàn
                                                tất</option>
                                            <option id="{{ $order_by_id['0']['order']['0']->id_pd }}" value="4">Hủy
                                                Đơn Hàng</option>
                                        </select>
                                    </form>
                                @elseif($order_by_id['0']['order']['0']->trang_thai == 3)
                                    <p style="color: #9c3328">Hoàn tất</p>
                                @else
                                    <p style="color: #9c3328">Đã Hủy Đơn hàng</p>
                                @endif
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

        </div>
        <a type="button" class="btn btn-success" href="{{ route('admin.company_order.index') }}">Trở về</a>
    </div>

@endsection
<script src="{{asset('backend/js/jquery.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".checkBox").click(function () {
            if($(this).is(':checked')) {
                id = $(this).data('id');
                qty = $('#qty_' + id).val();
                price = $('#price_' + id).val();
                $.ajax({ 
                    url: "{{ route('admin.company_order.saveSession') }}",
                    type: 'GET',
                    data: {
                        ma_dr: id,
                        so_luong: qty,
                        gia: price
                    },
                    // method: 'GET',
                    // dataType: "JSON",
                    success: function(response){
                        
                    }
                });
            }
        });
    });
</script> 
