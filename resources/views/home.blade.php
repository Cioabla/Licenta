@extends('layouts.layout')

@section('style')

@endsection

@section('content')

    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>

                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ URL::asset('css/images/home/girl1.jpg') }}" class="girl img-responsive" alt="" />
                                    <img src="{{ URL::asset('css/images/home/pricing.png') }}"  class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ URL::asset('css/images/home/girl2.jpg') }}" class="girl img-responsive" alt="" />
                                    <img src="{{ URL::asset('css/images/home/pricing.png') }}"  class="pricing" alt="" />
                                </div>
                            </div>

                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="{{ URL::asset('css/images/home/girl3.jpg') }}" class="girl img-responsive" alt="" />
                                    <img src="{{ URL::asset('css/images/home/pricing.png') }}" class="pricing" alt="" />
                                </div>
                            </div>

                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($data->categories as $category)

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $category->id }}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                {{ $category->name }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{ $category->id }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach($data->subcategories as $subcategory)

                                                    @if($subcategory->category_id == $category->id)
                                                        <li><a href="/category/{{ $subcategory->name }}/1">{{ $subcategory->name }}</a></li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--/category-products-->

                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ URL::asset('css/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>
                        <?php $i = 0 ;?>
                        @foreach($data->homeproduces as $produce)
                            @if($produce->location == 'features' && $i<6)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="{{ $produce->img}}" alt="" />
                                                <h2>${{ $produce->price}}</h2>
                                                <p>{{ $produce->name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                            @endif
                        @endforeach
                    </div>

                    <div class="col-sm-12 padding-right">
                        <div class="features_items"><!--features_items-->
                            <h2 class="title text-center">Discounts</h2>
                            <?php $j = 0?>

                            @foreach($data->homeproduces as $produce)
                                @if($produce->location == 'choice' && $j<6)
                                        <div class="col-sm-4">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <img src="{{ $produce->img}}" alt="" />
                                                        <h2>${{ $produce->price}}</h2>
                                                        <p>{{ $produce->name}}</p>
                                                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                    </div>
                                                </div>
                                                <div class="choose">
                                                    <ul class="nav nav-pills nav-justified">
                                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    <?php $j++; ?>
                                @endif
                            @endforeach
                        </div>

                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">recommended items</h2>

                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php $i=0; ?>
                                @foreach($data->homeproduces as $produce)
                                    @if($produce->location == 'recomanded')
                                            @if($i==0)
                                                <div class="item active">
                                                    <div class="col-sm-4">
                                                        <div class="product-image-wrapper">
                                                            <div class="single-products">
                                                                <div class="productinfo text-center">
                                                                    <img src="{{ $produce->img}}" alt="" />
                                                                    <h2>${{ $produce->price}}</h2>
                                                                    <p>{{ $produce->name}}</p>
                                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <?php $i++; ?>
                                            @elseif($i == 2 || $i == 5)
                                                            <div class="col-sm-4">
                                                                <div class="product-image-wrapper">
                                                                    <div class="single-products">
                                                                        <div class="productinfo text-center">
                                                                            <img src="{{ $produce->img}}" alt="" />
                                                                            <h2>${{ $produce->price}}</h2>
                                                                            <p>{{ $produce->name}}</p>
                                                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <?php $i++; ?>
                                            @elseif($i == 3)
                                                        <div class="item">
                                                            <div class="col-sm-4">
                                                                <div class="product-image-wrapper">
                                                                    <div class="single-products">
                                                                        <div class="productinfo text-center">
                                                                            <img src="{{ $produce->img}}" alt="" />
                                                                            <h2>${{ $produce->price}}</h2>
                                                                            <p>{{ $produce->name}}</p>
                                                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                <?php $i++; ?>
                                            @else
                                                                    <div class="col-sm-4">
                                                                        <div class="product-image-wrapper">
                                                                            <div class="single-products">
                                                                                <div class="productinfo text-center">
                                                                                    <img src="{{ $produce->img}}" alt="" />
                                                                                    <h2>${{ $produce->price}}</h2>
                                                                                    <p>{{ $produce->name}}</p>
                                                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                        <?php $i++; ?>
                                            @endif
                                    @endif
                                @endforeach
                                {{--<div class="item active">--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="product-image-wrapper">--}}
                                            {{--<div class="single-products">--}}
                                                {{--<div class="productinfo text-center">--}}
                                                    {{--<img src="{{ URL::asset('css/images/home/gallery1.jpg') }}" alt="" />--}}
                                                    {{--<h2>$10</h2>--}}
                                                    {{--<p>Easy Polo Black Edition</p>--}}
                                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="product-image-wrapper">--}}
                                            {{--<div class="single-products">--}}
                                                {{--<div class="productinfo text-center">--}}
                                                    {{--<img src="{{ URL::asset('css/images/home/gallery1.jpg') }}" alt="" />--}}
                                                    {{--<h2>$56</h2>--}}
                                                    {{--<p>Easy Polo Black Edition</p>--}}
                                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="product-image-wrapper">--}}
                                            {{--<div class="single-products">--}}
                                                {{--<div class="productinfo text-center">--}}
                                                    {{--<img src="{{ URL::asset('css/images/home/gallery1.jpg') }}" alt="" />--}}
                                                    {{--<h2>$56</h2>--}}
                                                    {{--<p>Easy Polo Black Edition</p>--}}
                                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="item">--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="product-image-wrapper">--}}
                                            {{--<div class="single-products">--}}
                                                {{--<div class="productinfo text-center">--}}
                                                    {{--<img src="{{ URL::asset('css/images/home/gallery1.jpg') }}" alt="" />--}}
                                                    {{--<h2>$56</h2>--}}
                                                    {{--<p>Easy Polo Black Edition</p>--}}
                                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="product-image-wrapper">--}}
                                            {{--<div class="single-products">--}}
                                                {{--<div class="productinfo text-center">--}}
                                                    {{--<img src="{{ URL::asset('css/images/home/gallery1.jpg') }}" alt="" />--}}
                                                    {{--<h2>$56</h2>--}}
                                                    {{--<p>Easy Polo Black Edition</p>--}}
                                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-sm-4">--}}
                                        {{--<div class="product-image-wrapper">--}}
                                            {{--<div class="single-products">--}}
                                                {{--<div class="productinfo text-center">--}}
                                                    {{--<img src="{{ URL::asset('css/images/home/gallery1.jpg') }}" alt="" />--}}
                                                    {{--<h2>$56</h2>--}}
                                                    {{--<p>Easy Polo Black Edition</p>--}}
                                                    {{--<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                                                {{--</div>--}}

                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->

                </div>
            </div>
        </div>

    </section>
@endsection

@section('script')
    <script>



    </script>
@endsection