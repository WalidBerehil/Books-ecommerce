@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">Order</h3>
                <div class="card-img-top">

                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $order->status }}
                    </h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_products as $item)
                            <tr>
                                <td><img src="{{ asset($item->product->image) }}" alt="{{ $item->title }}" width="50" height="50" class="img-fluid rounded">

                                </td>
                                <td>{{ $item->product->title }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->product->price }}</td>
                                <td>{{ $item->qty * $item->product->price }}</td>

                            </tr>
                            @endforeach
                            <tr class="text-dark font-weight-bold">
                                <td colspan="3" class="border border-success">
                                    Total
                                </td>
                                <td colspan="3" class="border border-success">
                                    {{ $total }} $
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection