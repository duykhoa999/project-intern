@extends('admin.master')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Lập đơn phiếu nhập
                </header>
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
                <div class="panel-body">

                    <div class="position-center">
                        <form role="form" action="{{ route('admin.import.store') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã phiếu nhập</label>
                                <input type="text" maxlength="10" name="ma_pn" value="{{ old('ma_pn') }}"
                                    class="form-control " placeholder="Mã đơn đặt hàng" required>
                                @if ($errors->has('ma_pn'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('ma_pn') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Đơn đặt hàng</label>
                                <select name="ma_ddh" class="form-control input-sm m-bot15">
                                    <option value="">Chọn đơn đặt hàng</option>
                                    @foreach ($order as $key => $item)
                                        <option value="{{ $item->ma_ddh }}"
                                            {{ old('ma_ddh') == $item->ma_ddh ? 'selected' : '' }}>{{ $item->ma_ddh }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ma_ddh'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('ma_ddh') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nhân viên lập phiếu</label>
                                <input type="text" disabled value="<?php echo Session::get('user')->ho_ten ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ngày lập phiếu</label>
                                <input type="date" disabled value="<?php echo date('Y-m-d') ?>"
                                    class="form-control">
                            </div>
                            <button type="submit" class="btn btn-info">Lập phiếu nhập</button>
                            <button type="button" class="btn btn-default"
                                onclick="window.location.assign('{{ route('admin.import.index') }}')">Hủy</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
