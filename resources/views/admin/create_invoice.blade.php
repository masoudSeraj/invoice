@extends('admin.main')

@section('content')

<form class="ajax-search" method="POST" action="{{ route('recommended.items') }}">
    @csrf
    <div class="form-group search-container">
        <label for="search" style="margin:0px;">
            <i class="fas fa-search form-control" style='border-radius: 0px; background: #e4e2e2;'></i>
        </label>
    <input type="text" class="form-control search" name="search-recommend" style='border-radius: 0px; text-align: right;' id="search" placeholder="جستجو">
    </div>

    <div class="recommended-list">
    </div>
     <div class="recommended-items">
        <ul>

        </ul>
     </div>
</form>

<form action="{{ route('invoice.store') }}" method="post">
    @csrf
    <div class="form-control d-flex box">




        <div class="d-flex justify-content-between my-1">
            <label for="price">Price</label>
            <input type="text" name="price" id="price">

        </div>

        <div class="d-flex justify-content-between my-1">
            <label for="qty">qty</label>
            <input type="text" name="price" id="qty">
        </div>

        <input type="submit" value="submit" name="submit">

    </div>
</form>
{{-- {{ $products }} --}}
{{-- @foreach ($products as $product)
{{  $product->name    }}

@endforeach --}}
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
@include('admin/products/autocomplete')
@endsection
