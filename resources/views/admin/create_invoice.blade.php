@extends('admin.main')

@section('content')

<form action="{{ route('invoice.store') }}" method="post">
    @csrf
    <div class="form-control d-flex box">
        <div class="d-flex justify-content-between my-1">
            <label for="name">Product Name</label>
            <input type="text" name="name" id="name">
        </div>

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
<script src="{{ asset('js/jquery-3.6.0.min') }}"></script>
@endsection
