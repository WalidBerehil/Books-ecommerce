@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 card p-3 p3">
            <h4 class="text-dark">Your cart</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Qautité</th>
                        <th>Prix</th>
                        <th>Totale</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($item->associatedModel->image) }}" alt="{{ $item->title }}" width="50" height="50" class="img-fluid rounded">
                        </td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            <form class="d-flex flex-row justify-content-center align-items-center" action="{{ route("update.cart",$item->associatedModel->slug) }}" method="post">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <input type="number" name="qty" id="qty" value="{{ $item->quantity }}" placeholder="Quantité" max="{{ $item->associatedModel->inStock }}" min="1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td>
                            {{ $item->price }} $
                        </td>
                        <td>
                            {{ $item->price * $item->quantity}} $
                        </td>
                        <td>
                            <form class="d-flex flex-row justify-content-center align-items-center" action="{{ route("remove.cart",$item->associatedModel->slug) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="text-dark font-weight-bold">
                        <td colspan="3" class="border border-success">
                            Totale
                        </td>
                        <td colspan="3" class="border border-success" style="font-family: sans-serif;">
                            {{ Cart::getSubtotal() }} $
                        </td>
                    </tr>
                </tbody>
            </table>
            @if(Cart::getSubtotal() > 0)
            <div class="form-group">
                <a style="cursor: default;" class="btn btn-secondary mt-3" aria-disabled="">
                    Pay {{ Cart::getSubtotal() }} $ via PayPal (soon)
                </a>


                <button type="button" class="btn btn-primary mt-3 mt" data-toggle="modal" data-target="#exampleModalCenter">
                    Pay {{ Cart::getSubtotal() }} $ via Cash
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to order ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="{{ route("cash.payment") }}" class="btn btn-primary">
                    Yes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection