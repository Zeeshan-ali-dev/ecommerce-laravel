@extends('admin.layouts.master')


@section('content')
    <?php 
        $products = $order->products ? json_decode($order->products) : '';
    
    ?>
    <div class="my-5">
        <h1>Order Details</h1>

    <div class="card shadow my-3">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <label for="" class="mr-3 font-bold mb-0">Email:</label>
                <span>{{$order->user->email}}</span>
            </div>
            <div class="d-flex align-items-center mb-2">
                <label for="" class="mr-3 font-bold mb-0">Total:</label>
                <span>{{$order->total}}</span>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quanity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($products): foreach($products as $p): ?>
                        <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->quantity}}</td>
                            <td>{{$p->quantity * $p->price}}</td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if($order->status == PENDING): ?>
    <a href="{{route('fill-order', encrypt($order->id))}}" class="btn btn-primary btn-sm my-2">Fill Order</a>
    <?php endif; ?>
    </div>
@endsection