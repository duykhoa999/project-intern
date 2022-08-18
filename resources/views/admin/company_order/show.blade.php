@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin Khách Hàng
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
                        @foreach ($all_user as $user)
                            @if (isset($order_by_id['0']['order']) && $order_by_id['0']['order']['0']->ma_kh == $user->ma_kh)
                                <tr>
                                    <td>{{ $user->ho_ten }}</td>
                                    <td>{{ $user->sdt }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
    <br>
    <br><br>
    <div class="table-agile-info">

        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
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
                        @foreach ($order_by_id as $details)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                @if (isset($details['products']['0']))
                                    <td>{{ $details['products']['0']->ten_dr }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if (isset($details['bills']['0']))
                                    <td>{{ $details['bills']['0']->ma_hd }}</td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ $details->so_luong }}</td>
                                <td>{{ $details->gia }}</td>
                                @if (isset($details['bills']['0']))
                                    <td>{{ $details['bills']['0']->tong_tien }}</td>
                                @else
                                    <td></td>
                                @endif
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
        <a type="button" class="btn btn-success" href="{{route('admin.order.index')}}">Trở về</a>
    </div>

@endsection
