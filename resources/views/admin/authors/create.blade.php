@extends('layoutsadmin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include("layouts.sidebar")
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                <h3 class="card-title">Add new author</h3>
                <div class="card-body">
                    <form method="post" action="{{ route("authors.store") }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <input type="text"
                            name="name"
                            placeholder="Name"
                            class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
