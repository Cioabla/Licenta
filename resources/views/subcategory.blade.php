@extends('layouts.layout')

@section('style')
    <link href="{{ URL::asset('css/subcategory.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section id="advertisement">
        <div class="container">
            <img src="images/shop/advertisement.jpg" alt="" />
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            @foreach($data['categories'] as $category)

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordian" href="#{{ $category['id'] }}">
                                                <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                                {{ $category['name'] }}
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="{{ $category['id'] }}" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <ul>
                                                @foreach($data['subcategories'] as $subcategory)

                                                    @if($subcategory['category_id'] == $category['id'])
                                                        <li><a href="/category/{{ $subcategory['name'] }}/1">{{ $subcategory['name'] }}</a></li>
                                                    @endif
                                                @endforeach

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div><!--/brands_products-->
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ URL::asset('css/images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-9 padding-right">
                    <div class="features_items here"><!--features_items-->
                        <div id="page-content">
                        @foreach($data['products'] as $product)
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="productinfo text-center">
                                            <img src="{{ $product['img'] }}" alt="" />
                                            <h2>${{ $product['price'] }}</h2>
                                            <p>{{ $product['name'] }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="choose">
                                            <ul class="nav nav-pills nav-justified">
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                                <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </div>
                    </div><!--features_items-->
                    <?php
                        $length = ceil($data['length']/12);
                    ?>
                    <div class="text-center">
                        <div class="pagination">
                            @if($length>1)
                                <a class="previousPage">&laquo;</a>
                                @for($i=0;$i<$length;$i++)
                                    @if($i==$data['page']-1)
                                        <a class="active page page{{$i+1}}" data-id="{{ $i+1 }}">{{ $i+1 }}</a>
                                    @else
                                        <a class="page page{{$i+1}}" data-id="{{$i+1}}">{{$i+1}}</a>
                                    @endif
                                @endfor
                                <a class="nextPage">&raquo;</a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <div class="name" data-id="{{ $data['name'] }}" style="display: none;">
    <div class="nrPage" data-id="{{ $length }}" style="display: none;">
@endsection

@section('script')
    <script>
        $(document).on('click','.previousPage',function (event) {
            event.preventDefault();
            var page = $('.pagination > a.active').attr('data-id');
            if(page != 1)
            {
                page--;
                history.pushState(null,null,'/category/'+name+'/'+page);
                var name = $('.name').attr('data-id');
                $.ajax({
                    type: "GET" ,
                    url:'/products/'+name+'/'+page ,

                    success: function (data) {

                        $('#page-content').remove();
                        $('.here').append('<div id="page-content"></div>');
                        $('.page').removeClass('active');
                        $('.page'+data['page']).addClass('active');

                        $.each(data['products'],function (index,value) {
                            $('#page-content').append(
                                '<div class="col-sm-4">' +
                                '<div class="product-image-wrapper">' +
                                '<div class="single-products">' +
                                '<div class="productinfo text-center">' +
                                '<img src="'+value['img']+'" alt="" />' +
                                '<h2>$'+value['price']+'</h2>' +
                                '<p>'+value['name']+'</p>' +
                                '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="choose">' +
                                '<ul class="nav nav-pills nav-justified">' +
                                '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>' +
                                '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        })

                    },
                    dataType: 'json'
                })
            }

        });

        $(document).on('click','.nextPage',function (event) {
            event.preventDefault();
            var page = $('.pagination > a.active').attr('data-id');
            var nrPage = $('.nrPage').attr('data-id');
            if(page != nrPage)
            {
                page++;
                var name = $('.name').attr('data-id');
                history.pushState(null,null,'/category/'+name+'/'+page);
                $.ajax({
                    type: "GET" ,
                    url:'/products/'+name+'/'+page ,

                    success: function (data) {

                        $('#page-content').remove();
                        $('.here').append('<div id="page-content"></div>');
                        $('.page').removeClass('active');
                        $('.page'+data['page']).addClass('active');
                        $.each(data['products'],function (index,value) {
                            $('#page-content').append(
                                '<div class="col-sm-4">' +
                                '<div class="product-image-wrapper">' +
                                '<div class="single-products">' +
                                '<div class="productinfo text-center">' +
                                '<img src="'+value['img']+'" alt="" />' +
                                '<h2>$'+value['price']+'</h2>' +
                                '<p>'+value['name']+'</p>' +
                                '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                '</div>' +
                                '</div>' +
                                '<div class="choose">' +
                                '<ul class="nav nav-pills nav-justified">' +
                                '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>' +
                                '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                        })

                    },
                    dataType: 'json'
                })
            }

        });

        $(document).on('click','.page',function (event) {
            event.preventDefault();
            var page = $(this).attr('data-id');
            var name = $('.name').attr('data-id');
            history.pushState(null,null,'/category/'+name+'/'+page);
            $.ajax({
                type: "GET" ,
                url:'/products/'+name+'/'+page ,

                success: function (data) {

                    $('#page-content').remove();
                    $('.here').append('<div id="page-content"></div>');
                    $('.page').removeClass('active');
                    $('.page'+data['page']).addClass('active');
                    $.each(data['products'],function (index,value) {
                        $('#page-content').append(
                            '<div class="col-sm-4">' +
                                '<div class="product-image-wrapper">' +
                                    '<div class="single-products">' +
                                        '<div class="productinfo text-center">' +
                                            '<img src="'+value['img']+'" alt="" />' +
                                            '<h2>$'+value['price']+'</h2>' +
                                            '<p>'+value['name']+'</p>' +
                                            '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
                                         '</div>' +
                                     '</div>' +
                                     '<div class="choose">' +
                                        '<ul class="nav nav-pills nav-justified">' +
                                            '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>' +
                                            '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>' +
                                        '</ul>' +
                                    '</div>' +
                                '</div>' +
                            '</div>');
                    })

                },
                dataType: 'json'
            })
        })

        // $(document).ready(function () {
        //     var name = $('.name').attr('data-id');
        //
        //     $.ajax({
        //         type: 'get',
        //
        //         url: '/products/'+name,
        //
        //         success: function (data) {
        //             var count = 0;
        //             var count2 = 0;
        //             var length;
        //             var objects = [];
        //             var go;
        //             console.log(data);
        //             $.each(data,function (index,value) {
        //                     objects.push('<div class="col-sm-4">' +
        //                                     '<div class="product-image-wrapper">' +
        //                                         '<div class="single-products">' +
        //                                             '<div class="productinfo text-center">' +
        //                                                 '<img src="'+value['img']+'" alt="" />' +
        //                                                 '<h2>$'+value['price']+'</h2>' +
        //                                                 '<p>'+value['name']+'</p>' +
        //                                                 '<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>' +
        //                                             '</div>' +
        //                                         '</div>' +
        //                                         '<div class="choose">' +
        //                                             '<ul class="nav nav-pills nav-justified">' +
        //                                                 '<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>' +
        //                                                 '<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>' +
        //                                             '</ul>' +
        //                                         '</div>' +
        //                                     '</div>' +
        //                                 '</div>');
        //                // $.each(value,function (index,value) {
        //                 //
        //                 // })
        //             });
        //             length = Math.floor(objects.length / 12);
        //             if(objects.length % 12 != 0){
        //                 length++;
        //             }
        //             var visible;
        //             if(length<10){
        //                 visible = length;
        //             }else{
        //                 visible = 10;
        //             }
        //             var content = '';
        //             // alert(objects[0]);
        //
        //             $('#pagination-demo').twbsPagination({
        //
        //                 totalPages: length,
        //                 visiblePages: visible,
        //                 onPageClick: function (event, page) {
        //                     $(content = '');
        //
        //                     if(page*12 > objects.length){
        //                         go = objects.length;
        //                     }else{
        //                         go = page*12;
        //                     }
        //
        //                     for(var i = page*12-12; i<go;i++){
        //                         content = content+objects[i];
        //
        //                     }
        //
        //                     $('#page-content').remove();
        //                     // $('#page-content').text(content);
        //                     // $('<div id="page-content">'+content+'</div>').insertBefore('.pagination-sm');
        //                     $('.here').append('<div id="page-content">'+content+'</div>');
        //                 }
        //             });
        //         },
        //         dataType: 'json'
        //         // error: function (data) {
        //         // },complete: function()
        //         // {
        //         // }
        //     });
        //
        //
        //
        // })
        
    </script>
@endsection