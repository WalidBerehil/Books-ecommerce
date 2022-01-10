@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <form method="get" action="{{ route("home") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" name="search" placeholder="Search" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <h3 class="card-header">New Products !</h3>
                <div class="card-body">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-6 mb-2 shadow-sm">
                            <div class="card" style="width:100%;height:100%">
                                <div class="card-img-top">
                                    <img class="img-fluid rounded" src="{{ asset($product->image) }}" alt="{{ $product->title }}" style="width: 327px;height: 235px;">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $product->title }}
                                    </h5>
                                    <p class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="text-muted">
                                            {{ $product->price }} DH
                                        </span>
                                        <span class="text-danger">
                                            <strike>
                                                {{ $product->old_price }} DH
                                            </strike>
                                        </span>
                                    </p>
                                    <p class="card-text">
                                        {{ Str::limit($product->description,100) }}
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
                                    <a href="{{ route("products.show",$product->slug) }}" class="btn btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="justify-content-center d-flex">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="list-group">
                    <li class="list-group-item active">
                        Categories
                    </li>
                    @foreach ($categories as $category)
                    <a href="{{ route("category.products",$category->slug) }}" class="list-group-item list-group-item-action">
                        {{ $category->title }}
                        ({{ $category->products->count() }})
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-12">
                <div class="list-group">
                    <li class="list-group-item active">
                        Author
                    </li>
                    @foreach ($authors as $author)
                    <a href="{{ route("author.products",$author->slug) }}" class="list-group-item list-group-item-action">
                        {{ $author->name }}
                        ({{ $author->products->count() }})
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection