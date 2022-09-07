@extends('admin.master')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Đơn đặt hàng
            </div>
            <div class="row w3-res-tb">
                <form style="float: right" method="get" action="{{ route('admin.order.index') }}" id="filterOrder">
                    <div class="group-input f-r">
                        <select name="trang_thai_dh" id="trang-thai-dong-hang">
                            <option value="">Chọn trạng thái đơn hàng</option>
                            <option value="0" <?php if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 0) {
                                echo 'selected';
                            } ?>>Chưa duyệt
                            </option>
                            <option value="1" <?php if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 1) {
                                echo 'selected';
                            } ?>>Đã duyệt
                            </option>
                            <option value="2" <?php if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 2) {
                                echo 'selected';
                            } ?>>Đã phân công nhân viên
                            </option>
                            <option value="3" <?php if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 3) {
                                echo 'selected';
                            } ?>>Hoàn tất
                            </option>
                            <option value="4" <?php if (isset($arr_filter['trang_thai_dh']) && $arr_filter['trang_thai_dh'] == 4) {
                                echo 'selected';
                            } ?>>Đã hủy
                            </option>
                        </select>
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

                            <th>Mã đơn hàng</th>
                            <th>Tên Người đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th>Thời Gian</th>

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
                            @if (isset($ord['bills']))
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.order.show', ['orderId' => $ord->id_pd]) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            {{ $ord['bills']->ma_hd }}</a>
                                    </td>
                                    <td>{{ $ord->ho_ten_nn }}</td>
                                    @if (isset($ord['bills']))
                                        <td>{{ number_format($ord['bills']->tong_tien, 0, ',', ',') }} VND</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>
                                        @if ($ord->trang_thai == 0)
                                            <p style="color:black">Chưa duyệt</p>
                                        @elseif($ord->trang_thai == 1)
                                            Đã duyệt
                                        @elseif($ord->trang_thai == 2)
                                            Đã phân công nhân viên
                                        @elseif($ord->trang_thai == 3)
                                            <p style="color:blue">Hoàn tất</p>
                                        @else
                                            <p style="color:red">Đã Hủy</p>
                                        @endif
                                    </td>

                                    <td>{{ date('d-M-Y', strtotime($ord->ngay_dat)) }}</td>
                                    <td>
                                        @if ($ord->trang_thai == 1)
                                            <button type="button" class="btn btn-success setNV-edit-button"
                                                title="Phân công nhân viên" id="clickme" fee-id={{ $ord->id_pd }}
                                                fee-hd={{ $ord['bills']->ma_hd }}>
                                                <i class="fa fa-arrow-up"></i></button>
                                        @endif
                                        <a href="{{ route('admin.order.show', ['orderId' => $ord->id_pd]) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-eye text-success text-active"></i></a>

                                        <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng này ko?')"
                                            href="{{ URL::to('/delete-order/' . $ord->id_pd) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-times text-danger text"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="setNVModal" class="modal modal-default fade in" data-backdrop="static" data-keyboard="false"
                style="display: none; padding-right: 17px;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" style="text-align: center;">Phân công nhân viên giao hàng</h4>
                            <div class="alert  hide" id="errorEditSetNV">
                            </div>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" id="editSetNVForm" class="form-horizontal"
                                style="text-align: center;">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="box-body">
                                            <div class="form-group row">
                                                <label class="col-sm-3 control-label">Nhân viên giao hàng</label>
                                                <input type="hidden" id="order_id" name="order_id" value="">
                                                <input type="hidden" id="ma_hd" name="ma_hd" value="">
                                                <div class="col-sm-8">
                                                    <select name="ma_nv" class="form-control input-sm m-bot15">
                                                        @foreach ($employee as $value)
                                                            <option value="{{ $value->ma_nv }}">{{ $value->ho_ten }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-md-8 text-center">
                                            <button type="submit" class="btn btn-primary" id="editSetNVBtn">Submit</button>
                                            <button type="button" id="editSetNVFormCancel"
                                                class="btn btn-default">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        $('#editSetNVFormCancel').click(function() {
            var modal = document.getElementById('setNVModal');
            $('#errorEditSetNV').html('');
            $('#errorEditSetNV').addClass('hide');
            modal.style.display = "none";
            $('#editSetNVBtn').attr('disabled', false);

        });
        $('.setNV-edit-button').click(function(e) {
            var id = $(this).attr("fee-id");
            var ma_hd = $(this).attr("fee-hd");
            document.getElementById('order_id').value = id;
            document.getElementById('ma_hd').value = ma_hd;
            var modal = document.getElementById('setNVModal');
            modal.style.display = "block";
        });
        $('form#editSetNVForm').submit(function(event) {
            event.preventDefault();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                method: "post",
                dataType: "JSON",
                headers: {
                    _token: _token
                },
                url: "{{ route('admin.order.set-employee-order') }}",
                data: $(this).serialize(),
                success: function(data) {
                    if (data.status == true) {
                        var html = '';
                        html += '<li style="font-weight: bold;font-size: 18px ">' + data.message +
                            '</li>';
                        $('#errorEditSetNV').html(html).removeClass('hide');
                        $('#errorEditSetNV').addClass('alert-success');
                        location.reload()
                    }
                }
            });
        });
    </script>
@endsection
