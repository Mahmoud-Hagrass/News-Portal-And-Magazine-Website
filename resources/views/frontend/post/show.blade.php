@extends('frontend.master')
@section('status', 'active')
@section('title', 'show-post')
@section('content')
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($post->images as $postImage)
                                <div class="carousel-item {{ $loop->index == 0 ? 'active' : ' ' }}">
                                    <img src="{{ asset('storage/uploads/' . $postImage->image) }}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $post->title }}</h5>
                                       
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">
                        <h2>{!! $post->description !!}</h2>
                    </div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <form id="commentFormId">
                            <div class="comment-input">
                                <input type="text" name="comment" placeholder="Add a comment..." id="comment_id" />
                                <input type="hidden" name="user_id" id="user_id" value="{{ (Auth::check()) ? Auth::id() : 0 }}"/>
                                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}"/>
                                <button id="addCommentBtn">Add Comment</button>
                            </div>
                        </form>
                        <!--Display Validation Error Comming From Ajax-->
                        <div id="errorMessage" style="display:none;" class="alert alert-danger">

                         </div>

                        <!-- Display Comments -->
                            <div class="comments">
                            @foreach($post->comments as $comment)
                                <div class="comment">
                                    <img src="{{ $post->user->image }}" alt="User Image"
                                        class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{  $post->user->name }}</span>
                                        <p class="comment-text">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreComments" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach($relatedPosts as $relatedPost)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ asset('storage/uploads/'. $relatedPost->images->first()->image) }}" class="img-fluid"
                                            alt="{{ $relatedPost->title }}" />
                                        <div class="sn-title">
                                            <a href="{{ route('frontend.post.show', $relatedPost->slug)}}">{{ $relatedPost->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" class="img-fluid"
                                        alt="Related News 4" />
                                    <div class="sn-title">
                                        <a href="#">Interdum et fames ac ante</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">Related Posts</h2>
                            @foreach ($relatedPosts as $relatedPost)
                                <div class="news-list">
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ asset('storage/uploads/' . $relatedPost->images->first()->image) }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#featured">Latest</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="featured" class="container tab-pane active">
                                        @foreach ($latestCachedPosts as $latestCachedPost)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset('storage/uploads/' . $latestCachedPost->images->first()->image) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $latestCachedPost->slug) }}">{{ $latestCachedPost->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="popular" class="container tab-pane fade">
                                        @foreach($cachedPopularPosts as $cachedPopularPost)
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('storage/uploads/'. $cachedPopularPost->images->first()->image) }}" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="{{ route('frontend.post.show' , $cachedPopularPost->slug)}}">{{ $cachedPopularPost->title }}</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div id="latest" class="container tab-pane fade">
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-5.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                        <div class="tn-news">
                                            <div class="tn-img">
                                                <img src="{{ asset('assets-front') }}/img/news-350x223-3.jpg" />
                                            </div>
                                            <div class="tn-title">
                                                <a href="">Lorem ipsum dolor sit amet consec adipis elit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach($newCatgories as $category)
                                        <li><a href="{{ route('frontend.category-posts' , $category->slug)}}">{{ $category->name }}</a><span>({{ $category->posts_count }})</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection

@push('js')
    <script>
        $(document).on('click' , '#showMoreComments' , function(e){
             e.preventDefault() ; 
             $.ajax({
                url:"{{ route('frontend.post.comments' , $post->slug) }}" , 
                type:"GET",
                success:function(response){
                    if(response.status == 200){
                        $('.comments').empty() ; 
                        var user = response.data.user ; 
                        $.each(response.data.comments , function(key , comment){
                            $('.comments').append(`<div class="comment">
                                            <img src="${user.image}" alt="User Image"
                                                class="comment-img" />
                                            <div class="comment-content">
                                                <span class="username">${user.name}</span>
                                                <p class="comment-text">${comment.comment}</p>
                                            </div>
                                    </div>
                                </div>`) ; 
                        }) ; 

                        $('#showMoreComments').hide() ; 
                    }
                }, 
                error:function(response){
                    alert(response.message) ; 
                }
             }) ; 
         }); 
         
         


   $(document).on('submit' , '#commentFormId' , function(e){
            e.preventDefault() ; 
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData($(this)[0]) ; 
            console.log(formData) ; 
            $.ajax({
                url:"{{ route('frontend.post.comments.store') }}" , 
                method:"POST" , 
                data:formData , 
                dataType:"json" ,
                processData:false ,
                contentType:false ,
                headers: {
                    'X-CSRF-TOKEN' : csrfToken , 
                }, 
                success:function(response){
                    if(response.status == 201){
                        $('#errorMessage').hide() ;  // hide the validation error after adding comment correctly
                        $('.comments').prepend(`<div class="comment">
                                        <img src="${response.data.user.image}" alt="User Image"
                                            class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${response.data.user.name}</span>
                                            <p class="comment-text">${response.data.comment}</p>
                                        </div>
                                    </div>`) ; 
                    }
                    //$('#commentFormId').trigger('reset') ;  // clear all form inputs data fields
                    $('#comment_id').val('') ; 
                }, 
            error:function(response){
                var errorMessage = response.responseJSON.errors.comment[0]  
                $('#errorMessage').text(errorMessage).show() ;
            }
            });
        }); 
    </script>
@endpush
