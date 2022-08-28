@extends('admin.index')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session()->get('message') }}
        </div>
    @endif
    <form action="{{ route(ADMIN_PRODUCT_TYPE_STORE) }}" method="post">
        @csrf
        @if(isset($id))
            <input type="hidden" name="id" value="{{ $id }}">
        @endif
        <div class="row mb-3">
            <div class="col-lg-6">
                <div>
                    <h1 class="h3 d-inline align-middle">Thay đổi</h1>
                    <a class="badge bg-dark text-white ms-2">
                        Thay đổi loại sản phẩm
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <button class="btn btn-success" type="submit">Lưu</button>
                <a class="btn btn-primary ml-3" href="{{ route(ADMIN_PRODUCT_TYPE_INDEX) }}">Quay lại</a>
            </div>
        </div>
        @include('admin.product_type.form')
    </form>
@endsection

