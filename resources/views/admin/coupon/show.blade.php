@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin hàng hoá
            </div>
            <div class="row w3-res-tb">
                <form style="float: right" action="{{ route('admin.coupon.show', ['id' => $coupon->ma_km]) }}" method="get">
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
                <form action="{{route('admin.coupon.add_detail', ['id' => $coupon->ma_km])}}" method="POST">
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
                                <th>Số lượng khuyến mãi</th>
                                <th>Được giảm(%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_product as $key => $pro)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkBox" data-id="{{$pro->ma_dr}}" name="data[{{$pro->ma_dr}}][check]" {{(!empty($session_coupon) && array_key_exists($pro->ma_dr ,$session_coupon)) ? 'checked' : '' }}>
                                    </td>

                                    <td>{{ $pro->ten_dr }}</td>
                                    <input type="hidden" name="data[{{$pro->ma_dr}}][ten_dr]" id="name_{{$pro->ma_dr}}" value="{{$pro->ten_dr}}">
                                    <td><img src="/uploads/product/{{ $pro->hinh_anh }}" height="100px" width="100px"></td>
                                    <td>{{ $pro->thuong_hieu->ten_th }}</td>
                                    <td>{{ $pro->sl_ton }}</td>
                                    <td><input style="vertical-align: center;" type="number" value="{{(!empty($session_coupon) && array_key_exists($pro->ma_dr ,$session_coupon)) ? $session_coupon[$pro->ma_dr]['so_luong'] : '' }}" min="1" id="qty_{{$pro->ma_dr}}" name="data[{{$pro->ma_dr}}][so_luong]"></td>
                                    <td><input style="vertical-align: center;" type="number" value="{{(!empty($session_coupon) && array_key_exists($pro->ma_dr ,$session_coupon)) ? $session_coupon[$pro->ma_dr]['phantram_km'] : '' }}" min="1" id="percent_{{$pro->ma_dr}}" name="data[{{$pro->ma_dr}}][phantram_km]"></td>
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
                Liệt kê chi tiết khuyến mãi
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
                            <th>Mã khuyến mãi</th>
                            <th>Được giảm</th>
                            <th>Số lượng còn lại</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($coupon_detail as $details)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                @if (isset($details->products))
                                    <td>{{ $details->products->ten_dr }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $coupon->ma_km }}</td>
                                <td>{{ $details->phantram_km }}%</td>
                                <td>{{ $details->so_luong }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <a type="button" class="btn btn-success" href="{{ route('admin.coupon.index') }}">Trở về</a>
    </div>

@endsection
<script src="{{asset('backend/js/jquery.min.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".checkBox").click(function () {
            if($(this).is(':checked')) {
                id = $(this).data('id');
                qty = $('#qty_' + id).val();
                percent = $('#percent_' + id).val();
                $.ajax({ 
                    url: "{{ route('admin.coupon.saveSession') }}",
                    type: 'GET',
                    data: {
                        ma_dr: id,
                        so_luong: qty,
                        phantram_km: percent,
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
