@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card p-3">
                <h3 class="card-title">Update {{ $user->name }}</h3>
                <div class="card-body">
                    <form method="post" action="{{ route("users.update",$user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" value="{{ $user->email }}" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <input type="text" name="address" placeholder="Address" value="{{ $user->address }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="city" placeholder="City" value="{{ $user->city }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="country" placeholder="Country" value="{{ $user->country }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="text" name="phone" placeholder="Phone" value="{{ $user->phone }}" class="form-control">
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