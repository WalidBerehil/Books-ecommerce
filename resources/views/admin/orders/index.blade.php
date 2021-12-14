@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-8">
            <!--Search -->
            <div>
                <form method="get" action="{{ route("admin.orders") }}" enctype="multipart/form-data">
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>@sortablelink('id')</th>
                        <th>@sortablelink('user.name','Client')</th>
                        <th>@sortablelink('status')</th>
                        <th>@sortablelink('qty','Qty(N° Products)')</th>
                        <th>@sortablelink('price')</th>
                        <th>@sortablelink('total')</th>
                        <th>@sortablelink('paid')</th>
                        <th>@sortablelink('delivered')</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>{{ $order->price }} $</td>
                        <td>{{ $order->total }} $</td>
                        <td>
                            @if($order->paid)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-hourglass-half text-danger"></i>
                            @endif
                        </td>
                        <td>
                            @if($order->delivered)
                            <i class="fa fa-check text-success"></i>
                            @else
                            <i class="fa fa-hourglass-half text-danger"></i>
                            @endif
                        </td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <a href="{{ route("orders.show",$order->id) }}" class="btn btn-sm btn-warning mr-2 small-icon-action">
                                <i class="fa fa-info"></i>
                            </a>
                            <form id="update {{ $order->id }}" method="POST" action="{{ route("orders.update",$order->id) }}">
                                @csrf
                                @method("PUT")
                                <button onclick="event.preventDefault();
                                       if(confirm('Do you really want to update the order {{ $order->id  }} ?'))
                                        document.getElementById('update {{ $order->id }}').submit();
                                    " class="btn btn-sm btn-success small-icon-action mr-2">
                                    <i class="fa fa-check"></i>
                                </button>
                            </form>
                            <form id="{{ $order->id }}" method="POST" action="{{ route("orders.destroy",$order->id) }}">
                                @csrf
                                @method("DELETE")
                                <button onclick="event.preventDefault();
                                       if(confirm('Do you really want to delete the order {{ $order->id  }} ?'))
                                        document.getElementById({{ $order->id }}).submit();
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
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection