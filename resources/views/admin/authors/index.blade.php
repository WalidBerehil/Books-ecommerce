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

                <form method="get" action="{{ route("admin.authors") }}" enctype="multipart/form-data">
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
            <a href="{{ route("authors.create") }}" class="btn btn-primary my-2">
                <i class="fa fa-plus"></i>
            </a>
            </div>

            <div class="col-md-12">

            <table class="table table-hover fix-th-width">
                <thead>
                    <tr>
                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('name')</th>
                        <th>@sortablelink('slug')</th>
                        <th>@sortablelink('created_at')</th>
                        <th>@sortablelink('updated_at')</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->id }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->slug }}</td>
                        <td>{{ $author->created_at }}</td>
                        <td>{{ $author->updated_at }}</td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <a href="{{ route("authors.edit",$author->slug) }}" class="btn btn-sm btn-warning mr-2 small-icon-action">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form id="{{ $author->id }}" method="POST" action="{{ route("authors.destroy",$author->slug) }}">
                                @csrf
                                @method("DELETE")
                                <button onclick="event.preventDefault();
                                       if(confirm('Do you really want to delete the author {{ $author->id  }} ?'))
                                        document.getElementById({{ $author->id }}).submit();
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
                {{ $authors->links() }}
            </div>
        </div>
    </div>
</div>
@endsection