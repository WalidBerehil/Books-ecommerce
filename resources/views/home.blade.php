@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="searchparent">

            <form method="get" action="{{ route("home") }}" enctype="multipart/form-data">
                @csrf


                <div class="main-search-input-wrap">
                    <div class="main-search-input fl-wrap">
                        <div class="main-search-input-item"> <input type="text" name="search" placeholder="Search Products..."> </div> <button type="submit" class="main-search-button main-sea">Search</button>
                    </div>
                </div>
            </form>


        </div>

    </div>



    <div class="row">

        <div class="col-md-9">
            <div class="card">
                <h3 class="card-header card-hea">Books</h3>
                <div class="card-body card-bd">
                    <div class="row">
                        @foreach ($products as $product)
                        <div class="col-md-3 mb-2 shadow-sm">
                            <div class="card" style="width:100%;height:100%">
                                <div class="card-img-top">
                                    <img class="img-fluid rounded" src="{{ asset($product->image) }}" alt="{{ $product->title }}" style="width: 327px;height: 235px;">
                                </div>
                                <div class="card-body card-bd">
                                    <h5 class="card-title title-height">
                                        {{ $product->title }}
                                    </h5>
                                    <p class="d-flex flex-row justify-content-between align-items-center">
                                        <span class="text-muted">
                                            {{ $product->price }} DH
                                        </span> 
                                        @if($product->old_price)
                                        
                                        <span class="text-danger">
                                            <strike>
                                              {{ $product->old_price }} DH
                                            </strike>
                                        </span>
                                        @endif
                                    </p>
                                    <p class="card-text">
                                        {{ Str::limit($product->description,100) }}
                                    </p>
                                    <p class="font-weight-bold">
                                        @if($product->inStock > 0)
                                        <span class="text-success txt-succ">
                                            In Stock
                                        </span>
                                        @else
                                        <span class="text-danger">
                                            N/A
                                        </span>
                                        @endif
                                    </p>
                                    <a href="{{ route("products.show",$product->slug) }}" class="btn btn-outline-primary bt-primary">
                                    More info 
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
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="list-group">
                    <li class="list-group-item active list">
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
                    <li class="list-group-item active list">
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