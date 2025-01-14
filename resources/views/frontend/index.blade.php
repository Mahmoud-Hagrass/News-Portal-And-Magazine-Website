@extends('frontend.master')
@section('title' , 'Home Page')
@section('status' , 'active')
@section('content')
@php
 $firstThreePosts = $posts->take(3) ;
 $firstFourPosts = $posts->take(4) ; 
@endphp
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @foreach($firstThreePosts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ $post->images->first()->image }}" />
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @foreach($firstFourPosts as $post)
                            <div class="col-md-6">
                                <div class="tn-img">
                                    <img src="{{ $post->images->first()->image}}" />
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">
                @foreach($category_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">
                            @foreach($category->posts as $post)
                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img src="{{ $post->images->first()->image }}" />
                                        <div class="cn-title">
                                            <a href="">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category News End-->

    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">Oldest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">
                            @foreach($oldestPosts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $post->images->first()->image }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="popular" class="container tab-pane fade">
                            @foreach($popularPosts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $post->images->first()->image }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Most Viewed Posts</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                            <div id="m-viewed" class="container tab-pane active">
                                @foreach($firstThreePosts as $post) 
                                    <div class="tn-news">
                                        <div class="tn-img">
                                            <img src="{{ $post->images->first()->image }}" />
                                        </div>
                                        <div class="tn-title">
                                            <a href="">{{ $post->title }} </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        <div id="m-read" class="container tab-pane fade">
                            @foreach($mostViewedPosts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $post->images->first()->image }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="">{{ $post->title }} ({{ $post->number_of_views }})</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ $post->images->first()->image }}" />
                                    <div class="mn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div> 
                        @endforeach   
                    </div>
                    {{ $posts->render('pagination::bootstrap-4') }}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            <li><a href="">Lorem ipsum dolor sit amet</a></li>
                            <li><a href="">Pellentesque tincidunt enim libero</a></li>
                            <li><a href="">Morbi id finibus diam vel pretium enim</a></li>
                            <li>
                                <a href="">Duis semper sapien in eros euismod sodales</a>
                            </li>
                            <li><a href="">Vestibulum cursus lorem nibh</a></li>
                            <li>
                                <a href="">Morbi ullamcorper vulputate metus non eleifend</a>
                            </li>
                            <li><a href="">Etiam vitae elit felis sit amet</a></li>
                            <li><a href="">Nullam congue massa vitae quam</a></li>
                            <li><a href="">Proin sed ante rutrum</a></li>
                            <li><a href="">Curabitur vel lectus</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
