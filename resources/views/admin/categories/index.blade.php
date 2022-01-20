@extends('layoutsadmin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
            <!--Search -->


            <div class="searchparentadmin">

                <form method="get" action="{{ route("admin.categories") }}" enctype="multipart/form-data">
                    @csrf


                    <div class="main-search-input-wrap">
                        <div class="main-search-input fl-wrap">
                            <div class="main-search-input-item"> <input type="text" name="search" placeholder="Search Orders..."> </div> <button type="submit" class="main-search-button">Search</button>
                        </div>
                    </div>
                </form>


            </div>
            <!--End of Search -->


        </div>

        <div class="col-md-12 text-center">
            <a href="{{ route("categories.create") }}" class="btn btn-primary my-2">
                <i class="fa fa-plus"></i>
            </a>
        </div>

        <div class="col-md-12">

            <table class="table table-hover fix-th-width">
                <thead>
                    <tr>
                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('title')</th>
                        <th>@sortablelink('slug')</th>
                        <th>@sortablelink('created_at')</th>
                        <th>@sortablelink('updated_at')</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <a href="{{ route("categories.edit",$category->slug) }}" class="btn btn-sm btn-warning mr-2 small-icon-action">
                                <i class="fa fa-edit "></i>
                            </a>
                            <form id="{{ $category->id }}" method="POST" action="{{ route("categories.destroy",$category->slug) }}">
                                @csrf
                                @method("DELETE")
                                <button onclick="event.preventDefault();
                                       if(confirm('Do you really want to delete the category {{ $category->id  }} ?'))
                                        document.getElementById({{ $category->id }}).submit();
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
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection