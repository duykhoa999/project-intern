@extends('master')
@section('content')
<div class="table-agile-info container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Thông tin Khách Hàng</h2>
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

                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>


                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($order_by_id['0']['order']) && $order_by_id['0']['order']['0']->ma_kh ==$user->ma_kh )
                    <tr>
                        <td>{{$user->ho_ten}}</td>
                        <td>{{$user->sdt}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>

    </div>
</div>
<br>
<div class="table-agile-info container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Thông tin vận chuyển hàng</h2>
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

                        <th>Tên người Nhận</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                        <th>Hình thức thanh toán</th>


                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>

                    @if(isset($order_by_id['0']['order']))
                        <td>{{$order_by_id['0']['order']['0']->ho_ten_nn}}</td>
                        <td>{{$order_by_id['0']['order']['0']->dia_chi_nn}}</td>
                        <td>{{$order_by_id['0']['order']['0']->sdt_nn}}</td>
                        <td>{{$order_by_id['0']['order']['0']->email}}</td>
                        <td>{{$order_by_id['0']['order']['0']->ghi_chu}}</td>
                        <td>@if($order_by_id['0']['order']['0']->hinh_thuc_thanh_toan==1) VNPAY @else Tiền Mặt @endif</td>
                    @else

                    @endif

                    </tr>

                </tbody>
            </table>

        </div>

    </div>
</div>
<br><br>
<div class="table-agile-info container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Liệt kê chi tiết đơn hàng</h2>
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
                        <th>Tên sản phẩm</th>
                        <th>Mã Đơn Hàng</th>
                        <!-- <th>Phí ship hàng</th> -->
                        <th>Số lượng</th>
                        <th>Giá bán</th>
                        <!-- <th>Giá gốc</th> -->
                        <th>Tổng tiền</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 0;
                    @endphp
                    @foreach($order_by_id as $details)
                    @php
                    $i++;
                    @endphp
                    <tr>
                         @if(isset($details['products']['0']))
                        <td>{{$details['products']['0']->ten_dr}}</td>
                        @else
                        <td></td>
                        @endif
                        @if(isset($details['bills']['0']))
                        <td>{{$details['bills']['0']->ma_hd}}</td>
                        @else
                        <td></td>
                        @endif
                        <td>{{$details->so_luong}}</td>
                        <td>{{number_format($details->gia,0,',','.')}} VNĐ</td>
                        <td>{{number_format(($details->so_luong * $details->gia),0,',','.')}} VNĐ</td>
                        <td></td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
            <div style="display: flex;">
                <h3>Tổng Tiền phải thanh toán : </h3>
                <span style="color: red;font-weight: 700; padding-left: 10px; font-size: 24px;">{{number_format($order_by_id['0']['bills']['0']->tong_tien,0,',','.')}} VNĐ</span>

            </div>
            <div style="display: flex;">
            <a class="btn btn-warning" href="{{route('customer.index')}}">Trở về</a>
            </div>
        </div>

    </div>
</div>

@endsection
