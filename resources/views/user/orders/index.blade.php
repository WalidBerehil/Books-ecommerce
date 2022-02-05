@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        
                        <th>Client</th>
                        <th>Status</th>
                        <th>Nb Product</th>
                        <th>Total</th>
                        <th>Paid</th>
                        <th>Delivered</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>{{ $order->total }} $</td>
                        <td>
                            @if($order->paid)
                            <i class="fa fa-check txt-succ"></i>
                            @else
                            <i class="fa fa-hourglass-half text-danger"></i>
                            @endif
                        </td>
                        <td>
                            @if($order->delivered)
                            <i class="fa fa-check txt-succ"></i>
                            @else
                            <i class="fa fa-hourglass-half text-danger"></i>
                            @endif
                        </td>
                        <td class="d-flex flex-row justify-content-center align-items-center">
                            <a href="{{ route("orders.uo",Crypt::encrypt($order->id)) }}" class="btn btn-sm btn-warning small-icon-action mr-2">
                                <i class="fa fa-info"></i>
                            </a>

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