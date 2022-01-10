@extends('layoutsadmin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
            <!--Search -->
            <div>
                <form method="get" action="{{ route("admin.products") }}" enctype="multipart/form-data">
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
            <!--End of Search -->

            <a href="{{ route("products.create") }}" class="btn btn-primary my-2">
                <i class="fa fa-plus"></i>
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('title')</th>
                        <th>@sortablelink('description')</th>
                        <th>@sortablelink('inStock','qty')</th>
                        <th>@sortablelink('price')</th>
                        <th>in Stock</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title}}</td>
                        <td>{{ Str::limit($product->description,50) }}</td>
                        <td>{{ $product->inStock }}</td>
                        <td>{{ $product->price }} DH</td>
                        <td>
                            @if($product->inStock > 0)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-times text-danger"></i>
                            @endif
                        </td>
                        <td>
                            <img src="{{ asset($product->image) }}" alt="{{ $product->title }}" width="50" height="50" class="img-fluid rounded">
                        </td>
                        <td>
                            {{ $product->category->title }}
                        </td>
                        <td>
                            {{ $product->author->name }}
                        </td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <a href="{{ route("products.edit",$product->slug) }}" class="btn btn-sm btn-warning mr-2 small-icon-action">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form id="{{ $product->id }}" method="POST" action="{{ route("products.destroy",$product->slug) }}">
                                @csrf
                                @method("DELETE")
                                <button onclick="event.preventDefault();
                                       if(confirm('Do you really want to delete {{ $product->title  }} ?'))
                                        document.getElementById({{ $product->id }}).submit();
                                    " class="btn btn-sm btn-danger small-icon-action">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div class="justify-content-center d-flex">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection