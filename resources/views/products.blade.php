@extends('layout')

@section('content')

<style>
    /* Add custom CSS for the card design */
    .product-card {
        border: 1px solid #ddd; /* Add a border with light gray color */
        border-radius: 8px; /* Add some border radius for rounded corners */
        padding: 15px; /* Add padding inside the card */
        margin-bottom: 20px; /* Add some space between each card */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
        transition: box-shadow 0.3s ease; /* Add smooth transition for box shadow */
    }

    .product-card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Add a stronger box shadow on hover */
    }

    .product-card img {
        max-width: 100%; /* Make sure the image fits within the card */
        border-radius: 6px; /* Add border radius to the image */
    }

    .product-card h4 {
        margin-top: 10px; /* Add some space above the product name */
    }

    .product-card p {
        color: #555; /* Set text color to a dark gray */
    }

    .product-card .btn-holder {
        margin-top: 15px; /* Add space between the description and the button */
    }

    /* Center the product cards within the row */
    .product-card-wrapper {
        display: flex;
        justify-content: center;
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="product-card-wrapper">
            @foreach($products as $product)
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="product-card">
                    <img src="{{ asset('img') }}/{{ $product->photo }}" class="img-fluid" alt="{{ $product->product_name }}">
                    <div class="caption">
                        <h4>{{ $product->product_name }}</h4>
                        <p>{{ $product->product_description }}</p>
                        <p><strong>Price: </strong> ${{ $product->price }}</p>
                        <p class="btn-holder">
                            <a href="{{ route('add_to_cart', $product->id) }}" class="btn btn-primary btn-block text-center" role="button">Add to cart</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
