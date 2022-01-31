@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header head">{{ $product->title }}</h3>
                <div class="card-img-top top">
                    <img class="img-fluid w-100" src="{{ asset($product->image) }}" alt="{{ $product->title }}">
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $product->title }}
                    </h5>
                    <p class="text-dark font-weight-bold">
                        {{ $product->category->title }}
                    </p>
                    <p class="text-dark font-weight-bold">
                        {{ $product->author->name }}
                    </p>
                    <p class="d-flex flex-row justify-content-between align-items-center">
                        <span class="text-muted">
                            {{ $product->price }} $
                        </span>
                        @if($product->old_price)
                        <span class="text-danger">
                            <strike>
                                {{ $product->old_price }} $
                            </strike>
                        </span>
                        @endif
                    </p>
                    <p class="card-text">
                        {{ $product->description }}
                    </p>
                    <p class="font-weight-bold">
                        @if($product->inStock > 0)
                        <span class="text-success">
                            In Stock
                        </span>
                        @else
                        <span class="text-danger">
                            N/A
                        </span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
           <div class="form">
            <form action="{{ route("add.cart",$product->slug) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="qty" class="label-input inpu">
                        Quantité :
                    </label>
                    @if($product->inStock > 0)
                    <input type="number" name="qty" id="qty" value="1" placeholder="Quantité" max="{{ $product->inStock }}" min="1" class="form-control f-cntr">

                    @else
                    <span class="text-danger">
                        <input type="number" name="qty" id="qty" value="0" placeholder="Quantité" max="{{ $product->inStock }}" min="0" class="form-control f-cntr">

                    </span>
                    @endif
                </div>
                <div class="form-group">

                    @if($product->inStock > 0)
                    <button type="submit" class="btn text-white btn-block bg-dark  bh">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                    @else
                    <span class="text-danger">
                        <p style="cursor: default;" aria-disabled="" class="btn text-white btn-block bg-outofstock">
                            <i class="fa fa-shopping-cart"></i>
                            Out of stock
                        </p>
                    </span>
                    @endif
                </div>
            </form> </br>
            </div>
        </div>
    </div>
</div>
@endsection