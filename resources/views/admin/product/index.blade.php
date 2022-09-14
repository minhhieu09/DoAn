@php(
    $i = 1
)
@extends('admin.index')
@section('content')
    <div class="row mb-3">
        <div class="col-lg-6">
            <div>
                <h1 class="h3 d-inline align-middle">Danh sách</h1>
                <a class="badge bg-dark text-white ms-2">
                    Danh sách sản phẩm
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <a class="btn btn-success" href="{{ route(ADMIN_PRODUCT_CREATE) }}">Thêm mới</a>
            <a class="btn btn-primary ml-3" href="{{ route(ADMIN_DASHBOARD) }}">Quay lại</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover table-striped" id="users-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Sản phẩm đặc biệt</th>
                        <th>Màu sắc</th>
                        <th>Dung lượng</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        @foreach($product->component as $key => $row)
                            <tr>
                                @if($key == 0)
                                    <td {{ 'rowspan=' . count($product->component) }}>{{ $i }}</td>
                                    <td {{ 'rowspan=' . count($product->component) }}>{{ $product->name }}</td>
                                    <td {{ 'rowspan=' . count($product->component) }}>
                                        @foreach($product->special as $special)
                                            <div class="btn btn-info">{{ $special->name }}</div>
                                        @endforeach
                                    </td>
                                @endif
                                    <td>{{ $row->color->name }}</td>
                                    <td>{{ $row->memory }}</td>
                                    <td>{{ $row->amount }}</td>
                                    <td>{{ $row->price }}</td>
                                    <td>
                                        <a href="{{ route(ADMIN_PRODUCT_EDIT, $row->id) }}" class="btn btn-primary">Thay đổi</a>
                                        <a href="{{ route(ADMIN_PRODUCT_DELETE, $row->id) }}"
                                           onclick="return confirm('Bạn có chắc chắn muốn xoá không?');"
                                           class="btn btn-danger">Xoá</a>
                                    </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
