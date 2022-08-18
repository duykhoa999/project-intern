@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Đơn đặt hàng của cửa hàng
            </div>
            {{-- <div class="row w3-res-tb">
            <form style="float: right" method="get" action="{{route('admin.order.index')}}" id="filterOrder">
                <div class="group-input f-r">
                    <select name="trang_thai_dh" id="trang-thai-dong-hang">
                        <option value="">Chọn trạng thái đơn hàng</option>
                        <option value="0" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 0) echo 'selected';
                        ?>>Chưa duyệt
                        </option>
                        <option value="1" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 1) echo 'selected';
                        ?>>Đã duyệt
                        </option>
                        <option value="2" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 2) echo 'selected';
                        ?>>Đã phân công nhân viên
                        </option>
                        <option value="3" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 3) echo 'selected';
                        ?>>Hoàn tất
                        </option>
                        <option value="4" <?php //if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 4) echo 'selected';
                        ?>>Đã hủy
                        </option>
                    </select>
                </div>

            </form>
        </div> --}}
            <div class="row w3-res-tb">
                <a style="font-size: 18px"><i class="fa fa-plus-circle -aqua"
                        style="float:left; margin-left:5px;cursor: pointer;padding-bottom: 13px"
                        onclick="window.location.assign('{{ route('admin.company_order.create') }}')"><span
                            style="margin-left: 10px">Lập đơn đặt hàng</span></i></a>
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

                            <th>Mã đơn hàng</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Nhân viên lập đơn</th>
                            <th>Tổng Tiền</th>
                            <th>Ngày đặt</th>

                            <th style="width:90px;">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($all_order as $key => $ord)
                            @php
                                $i++;
                            @endphp
                            <tr>
                                <td>
                                    <a href="{{ route('admin.company_order.show', ['id' => $ord->ma_ddh]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        {{ $ord->ma_ddh }}</a>
                                </td>
                                <td>{{ $ord->manufacture->ten_ncc }}</td>
                                <td>{{ $ord->staff->ho_ten }}</td>
                                <td>0</td>
                                <td>{{ date('d-M-Y', strtotime($ord->ngay_dat)) }}</td>
                                <td>
                                    <a href="{{ route('admin.company_order.show', ['id' => $ord->ma_ddh]) }}"
                                        class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i></a>

                                    <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
                                        href="{{ URL::to('/delete-order/' . $ord->ma_ddh) }}" class="active styling-edit"
                                        ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="panel-footer">
            <div class="row">

                <div class="col-sm-5 text-center">
                    <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                </div>
                <div class="col-sm-7 text-right text-center-xs">
                    <ul class="pagination pagination-sm m-t-none m-b-none">
                        {!! $all_order->links() !!}
                    </ul>
                </div>
            </div>
        </footer>

    </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        
    </script>
@endsection
