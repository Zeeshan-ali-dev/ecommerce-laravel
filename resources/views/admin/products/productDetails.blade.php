@extends('admin.layouts.master')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Product Details</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 border-0 shadow">
            <div class="card-header border-0 bg-gradient-primary text-white">Product Details</div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <label for="" class="mr-3 font-weight-bold text-dark" style="min-width: 250px">Product Name</label>
                    <span>{{$product ? $product->name : ''}}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <label for="" class="mr-3 font-weight-bold text-dark" style="min-width: 250px">Price</label>
                    <span>{{$product ? $product->price : ''}}</span>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <label for="" class="mr-3 font-weight-bold text-dark" style="min-width: 250px">Description</label>
                    <span>{{$product ? $product->description : ''}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection