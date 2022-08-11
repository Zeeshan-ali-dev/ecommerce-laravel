@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
        </div>
        <div class="card-body">
            <?php notifications(); ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <a href="{{ route('delete-product', encrypt($product->id)) }}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                <a href="{{ route('edit-product', encrypt($product->id)) }}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('product-details', encrypt($product->id)) }}" class="btn btn-info"><i class="fa fa-info-circle"></i> Details</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
@endsection