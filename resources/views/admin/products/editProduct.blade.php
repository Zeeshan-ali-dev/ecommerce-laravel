@extends('admin.layouts.master')


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Edit product</h1>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4 border-0 shadow">
            <div class="card-header border-0 bg-gradient-primary text-white">Edit product</div>
            <div class="card-body">
                <form method="post" action="{{route('update-product', encrypt($product->id))}}" enctype="multipart/form-data">
                    <?php notifications(); ?>
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <div class="profile_img_wrapper">
                                    <img width="100" height="100" src="{{asset("images/$product->img")}}" alt="">
                                    <label class="profile_img--overlay" for="pf_img">
                                    <i class="fas fa-upload"></i>
                                    <label>Upload</label>
                                </label>
                                <input class="d-none" type="file" name="product_img" value="" id="pf_img">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="small mb-1" for="inputname">Product Name</label>
                            <input class="form-control" id="inputname" type="text" value="{{ $product ? $product->name : 'N/A'}}" placeholder="Enter product's name" name="product_name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="small mb-1" for="inputindividual">Product Price</label>
                            <input class="form-control" id="inputindividual" type="number" value="{{ $product ? $product->price : 'N/A'}}" placeholder="Enter individual products's price" name="product_price" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label class="small mb-1" for="inputindividual">Product Description</label>
                            <textarea name="product_description" class="form-control" id="" cols="30" rows="10" placeholder="Enter product descripton">{{ $product ? $product->description : 'N/A'}}</textarea>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection