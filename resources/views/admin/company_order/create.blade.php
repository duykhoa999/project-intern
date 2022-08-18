@extends('admin.master')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Lập đơn đặt hàng
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
                        <form role="form" action="{{ route('admin.company_order.store') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã đơn đặt hàng</label>
                                <input type="text" maxlength="10" name="ma_ddh" value="{{ old('ma_ddh') }}"
                                    class="form-control " placeholder="Mã đơn đặt hàng" required>
                                @if ($errors->has('ma_ddh'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('ma_ddh') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nhà cung cấp</label>
                                <select name="ma_ncc" class="form-control input-sm m-bot15">
                                    <option value="">Chọn nhà cung cấp</option>
                                    @foreach ($manufactures as $key => $item)
                                        <option value="{{ $item->ma_ncc }}"
                                            {{ old('ma_ncc') == $item->ma_ncc ? 'selected' : '' }}>{{ $item->ten_ncc }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('ma_ncc'))
                                    <span style="color: red; font-weight: 700;">{{ $errors->first('ma_ncc') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-info">Lập đơn đặt hàng</button>
                            <button type="button" class="btn btn-default"
                                onclick="window.location.assign('{{ route('admin.company_order.index') }}')">Hủy</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    @endsection
