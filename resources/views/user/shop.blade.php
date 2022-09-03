@extends('user.layouts.layout')

@section('content')
    <!--Body Content-->
    <div id="page-content">
    	<!--Collection Banner-->
    	<div class="collection-header">
			<div class="collection-hero">
        		<div class="collection-hero__image"><img class="blur-up lazyload" data-src="{{ asset('user_assets/images/wallpapers/10.jpg')}}" src="{{ asset('user_assets/images/wallpapers/10.jpg')}}" alt="" title="" /></div>
        		<div class="collection-hero__title-wrapper"><h1 class="collection-hero__title page-width">Shop</h1></div>
      		</div>
		</div>
        <!--End Collection Banner-->
        
        <div class="container py-5">
        	<div class="row">
            	<!--Sidebar-->
            	<div class="col-12 col-sm-12 col-md-3 col-lg-3 sidebar filterbar">
                	<div class="closeFilter d-block d-md-none d-lg-none"><i class="icon icon anm anm-times-l"></i></div>
                	<div class="sidebar_tags">
                    	<!--Categories-->
                    	<div class="sidebar_widget categories filter-widget">
                            <div class="widget-title"><h2>Categories</h2></div>
                            <div class="widget-content">
                                <ul class="sidebar_categories">
                                    <li class="level1 sub-level"><a href="#;" class="site-nav">Material</a>
                                    	<ul class="sublinks">
                                        	<li class="level2"><a href="#;" class="site-nav">Material</a></li>
                                            <li class="level2"><a href="#;" class="site-nav">Smooth</a></li>
                                            <li class="level2"><a href="#;" class="site-nav">Child</a></li>
                                            <li class="level2"><a href="#;" class="site-nav">View All Clothing</a></li>
                                        </ul>
                                    </li>
                                    <li class="level1 sub-level"><a href="#;" class="site-nav">Smooth</a>
                                    	<ul class="sublinks">
                                        	<li class="level2"><a href="#;" class="site-nav">Ring</a></li>
                                            <li class="level2"><a href="#;" class="site-nav">Neckalses</a></li>
                                            <li class="level2"><a href="#;" class="site-nav">Eaarings</a></li>
                                            <li class="level2"><a href="#;" class="site-nav">View All Jewellery</a></li>
                                        </ul>
                                    </li>
                                    <li class="lvl-1"><a href="#;" class="site-nav">Flowers</a></li>
                                    <li class="lvl-1"><a href="#;" class="site-nav">Accessories</a></li>
                                    <li class="lvl-1"><a href="#;" class="site-nav">Collections</a></li>
                                    <li class="lvl-1"><a href="#;" class="site-nav">Sale</a></li>
                                    <li class="lvl-1"><a href="#;" class="site-nav">Page</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--Categories-->
                        <!--Price Filter-->
                        <div class="sidebar_widget filterBox filter-widget">
                            <div class="widget-title">
                            	<h2>Price</h2>
                            </div>
                            <form action="#" method="post" class="price-filter">
                                {{-- <div id="slider-range" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all">
                                	<div class="ui-slider-range ui-widget-header ui-corner-all"></div>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                    <span class="ui-slider-handle ui-state-default ui-corner-all" tabindex="0"></span>
                                </div> --}}
                                <div class="d-flex">
                                    <label for="" id="points_min">£<span><?= $min_price ? $min_price : 0 ?></span></label>
                                    <input type="range" id="points" name="points"  min="<?= $min_price ? $min_price : 0 ?>" max="<?= $max_price ? $max_price : 0 ?>" value="<?= $max_price ? $max_price : 0 ?>">
                                    <label for="" id="points_curr">£<span><?= $max_price ? $max_price : 0 ?></span></label>
                                </div>
                                <div class="row">
                                    {{-- <div class="col-6">
                                        <p class="no-margin"><input id="amount" type="text"></p>
                                    </div> --}}
                                    <div class="col-6 text-right margin-25px-top">
                                        <button class="btn btn-secondary btn--small">filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--End Price Filter-->
                    </div>
                </div>
                <!--End Sidebar-->
                <!--Main Content-->
                <div class="col-12 col-sm-12 col-md-9 col-lg-9 main-col">
                	<div class="productList">
                        <div class="grid-products grid--view-items">
                            <div class="row">
                                <?php if($products): foreach($products as $product): ?>
                                <div class="col-6 col-sm-6 col-md-4 col-lg-3 item">
                                    <!-- start product image -->
                                    <div class="product-image">
                                        <!-- start product image -->
                                        <a href="#">
                                            <!-- image -->
                                            <img class="primary blur-up lazyload" data-src="{{ asset("images/$product->img")}}" src="{{ asset("images/$product->img")}}" alt="image" title="product">
                                            <!-- End image -->
                                            <!-- Hover image -->
                                            <img class="hover blur-up lazyload" data-src="{{ asset("images/$product->img")}}" src="{{ asset("images/$product->img")}}" alt="image" title="product">
                                            <!-- End hover image -->
                                        </a>
                                        <!-- end product image -->
    
                                        <!-- Start product button -->
                                        <form class="variants add" action="{{route("add-to-cart")}}" method="post">
                                            @csrf
                                            <a href="{{route("p-details", encrypt($product->id))}}"><button class="btn btn-addto-cart mb-3" type="button">Details</button></a>
                                            <input type="hidden" name="product_id" value="<?= encrypt($product->id) ?>">
                                            <button class="btn btn-addto-cart" name="add_to_cart"  type="submit">Add to Cart</button>
                                        </form>
                                        <!-- end product button -->
                                    </div>
                                    <!-- end product image -->
    
                                    <!--start product details -->
                                    <div class="product-details text-center">
                                        <!-- product name -->
                                        <div class="product-name">
                                            <a href="#"><?= $product->name ? $product->name :'N/A' ?></a>
                                        </div>
                                        <!-- End product name -->
                                        <!-- product price -->
                                        <div class="product-price">
                                            <span class="price">£<?= $product->price ? $product->price :'N/A' ?></span>
                                        </div>
                                        <!-- End product price -->     
                                   
                                    </div>
                                    <!-- End product details -->
                                </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Main Content-->
            </div>
        </div>
        
    </div>
    <!--End Body Content-->
@endsection

@section('extra-scripts')

    <script>
        $(document).ready(function(){
            $('body').on("change", '#points', function(){
                console.log('change')
                $("#points_curr span").text($(this).val())
            })
        })
    </script>
    
@endsection