@extends('admin.main')

@section('content')
<div class="search-overlay"></div>


<form action="{{ route('invoice.store') }}" method="post">
    @csrf
    <div class="form-control d-flex box">

        <div class="form-container">
            <form class="ajax-search">
                <div class="form-group search-container">
                    <label for="search" style="margin:0px;">
                        <i class="fas fa-search form-control" style='border-radius: 0px; background: #e4e2e2;'></i>
                    </label>
                    <div class="d-flex inputs-parent justify-content-between">
                        <label for="search">search</label>
                        <input type="text" class="form-control search" name="search-recommended[]" style='border-radius: 0px; text-align: right;' id="search" data-productnumber=1 placeholder="جستجو">
                        <div class="plus" style="margin-left: 10px; cursor: pointer">&plus;</div>
                    </div>
                </div>

                <div class="recommended-list">
                </div>
                <div class="recommended-items">
                    <ul>

                    </ul>
                </div>
            </form>
        </div>


        <div class="d-flex justify-content-between my-1">
            <label for="price">Price</label>
            <div class="d-flex" style="flex-direction: row-reverse">
                <input type="text" id="price" name="price[]" data-price='1' placeholder="product#1">
            </div>
            {{-- <input type="hidden" name="price[]" id="price" data-price='1'> --}}

        </div>

        <div class="d-flex justify-content-between my-1">
            <label for="qty">qty</label>
            <div class="d-flex" style="flex-direction: row-reverse">
                <input type="text" name="qty[]" id="qty" data-qty='1' placeholder="quantity#1">
            </div>
        </div>

        <div class="d-flex justify-content-between my-1">
            <label for="length">length</label>
            <input type="text" name="length" id="length">
        </div>

        <input type="submit" value="submit" name="submit">

    </div>
</form>
@error('search-recommended')
    search-recommended
@enderror

@error('product_id')
    product_id
@enderror

@error('price')
    price
@enderror

@error('qty')
    qty
@enderror

@error('length')
    length
@enderror
{{-- {{ $products }} --}}
{{-- @foreach ($products as $product)
{{  $product->name    }}

@endforeach --}}
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
@include('admin/products/autocomplete')

<script>
    let i = 2;

    document.querySelector('.plus').addEventListener('click', e =>{
        let input = document.createElement('input');
        input.classList.add('form-control', 'search');
        input.setAttribute('name', 'search-recommended[]');
        input.setAttribute('placeholder', 'جستجو');
        input.setAttribute('data-productnumber', i++);
        document.querySelector('.inputs-parent').appendChild(input);

        addPrice();
        addqty();

    })

    addPrice = function () {
        const colnedprice = document.querySelector('#price').cloneNode();
        document.querySelector('#price').parentNode.appendChild(colnedprice);
        document.querySelector('#price').setAttribute('data-price', --i);
        document.querySelector("#price").setAttribute('placeholder', "product#"+i);
        document.querySelector("#price").value="";
        i++;

     }

     addqty = function () {
        const colnedqty = document.querySelector('#qty').cloneNode();
        document.querySelector('#qty').parentNode.appendChild(colnedqty);
        document.querySelector('#qty').setAttribute('data-qty', --i);
        document.querySelector("#qty").setAttribute('placeholder', "qty#"+i);
        document.querySelector("#qty").value="";

        i++;

      }
</script>

@endsection
