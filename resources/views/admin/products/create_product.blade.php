@extends('admin.main')
@section('content')

<form action="{{ route('product.store') }}" method="post">
    @csrf
    <div class="form-control d-flex box">
        <div class="d-flex justify-content-between my-1">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>

        <div class="d-flex justify-content-between my-1">
            <label for="price">Price</label>
            <input type="text" name="price" id="price"  value="{{ old('price') }}">

        </div>

        <input type="submit" value="submit" name="submit">

    </div>

    {{ session()->get('success') }}

    @error('name')
        <div id="errors">
            error conceded for product
        </div>
    @enderror

    @error('price')
        <div id="errors">
            error conceded for price
        </div>
    @enderror


</form>

@endsection
