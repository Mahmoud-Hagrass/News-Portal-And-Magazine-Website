@extends('frontend.master')
@section('status', 'active')
@section('title', 'show-post')
@section('meta-description', $post->small_description)
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
                                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}"/>
                                <button id="addCommentBtn">Add Comment</button>
                            </div>
                        </form>
                        <!--Display Validation Error Comming From Ajax-->
                        <div id="errorMessage" style="display:none;" class="alert alert-danger"></div>
    
                        <!-- Display Comments -->
                        <div class="comments" style="position: relative;">
                            @foreach($post->comments as $comment)
                                <div class="comment" id="display_comment_{{ $comment->id }}" data-comment-id="{{ $comment->id }}" style="position: relative; padding-right: 30px;">
                                    <img src="{{ asset('storage/uploads/' . $comment->user->image) }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{ $comment->user->name }}</span>
                                        <p class="comment-text">{{ $comment->comment }}</p>
                                    </div>
                                    <!-- Settings Icon and Dropdown (Top Right) -->
                                    @auth
                                        @if($post->user->id == Auth::guard('web')->user()->id)
                                            <div class="settings-container" style="position: absolute; top: 5px; right: 5px;">
                                                <button class="settings-btn" style="background: none; border: none; font-size: 18px; cursor: pointer; padding: 0; width: 20px; height: 20px;">⚙️</button>
                                                <div class="settings-dropdown" style="display: none; position: absolute; background-color: white; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 4px; right: 25px; top: 0;">
                                                    <button class="dropdown-item delete-comment" data-comment-id="{{ $comment->id }}" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Delete Comment</button>
                                                    <button class="dropdown-item hide-comment" data-comment-id="{{ $comment->id }}" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Hide Comment</button>
                                                </div>
                                            </div>
                                            <input type='hidden' name="post_id" value="{{ $post->id }}" id="get_post_id"/>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
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
                                        <img src="{{ asset('storage/uploads/'. $relatedPost->images->first()->image) }}" class="img-fluid" alt="{{ $relatedPost->title }}" />
                                        <div class="sn-title">
                                            <a href="{{ route('frontend.post.show', $relatedPost->slug)}}">{{ $relatedPost->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-md-4">
                                <div class="sn-img">
                                    <img src="{{ asset('assets-front') }}/img/news-350x223-4.jpg" class="img-fluid" alt="Related News 4" />
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
                                            <a href="{{ route('frontend.post.show', $relatedPost->slug) }}">{{ $relatedPost->title }}</a>
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
                                                    <a href="{{ route('frontend.post.show', $latestCachedPost->slug) }}">{{ $latestCachedPost->title }}</a>
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
    const imageUrl = 'http://news-portal.net/storage/uploads/'; 
    $(document).ready(function() {
        // Toggle dropdown on settings button click
        $(document).on('click', '.settings-btn', function(e) {
            e.preventDefault();
            var $dropdown = $(this).siblings('.settings-dropdown');
            // Toggle visibility
            if ($dropdown.css('display') === 'none') {
                $('.settings-dropdown').css('display', 'none'); // Hide all other dropdowns
                $dropdown.css('display', 'block');
            } else {
                $dropdown.css('display', 'none');
            }
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.settings-container').length) {
                $('.settings-dropdown').css('display', 'none');
            }
        });

        // Add hover effect for dropdown items
        $(document).on('mouseenter', '.dropdown-item', function() {
            $(this).css('background-color', '#f1f1f1');
        }).on('mouseleave', '.dropdown-item', function() {
            $(this).css('background-color', '');
        });

        // Delete comment
        $(document).on('click', '.delete-comment', function(e) {
            e.preventDefault();
            var comment_id = $(this).attr('data-comment-id');

            $.ajax({
                url: "{{ route('frontend.post.comments.delete') }}" ,
                type: 'POST',
                dataType: 'json',
                data:{
                    'comment_id' : comment_id , 
                    '_method' : 'DELETE' ,  
                } , 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 200 && response.message == 'Comment Deleted Successfully !'){
                        $('#display_comment_' + comment_id).hide() ; 
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                    alert('An error occurred while deleting the comment');
                }
            });
        });

        // Hide comment
        $(document).on('click', '.hide-comment', function(e) {
            e.preventDefault();
            var comment_id = $(this).attr('data-comment-id') ; 

            $.ajax({
                url: "{{ route('frontend.post.comments.hide') }}",
                type: 'POST',
                dataType: 'json',
                data:{
                    'comment_id' : comment_id , 
                } , 
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status == 200 && response.data.status == 0){
                         $('#display_comment_' + comment_id).hide() ; 
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr);
                    alert('An error occurred while hiding the comment');
                }
            });
        });
        
       // Initialize variables with default values
        let authId = null;
        let postAuthorId = null;

        // Safely get the authenticated user's ID
        @if(Auth::check() && Auth::user())
            authId = {{ Auth::user()->id ?? 'null' }};
            postAuthorId = $('#get_post_id').attr('value');
        @endif

        // Show more comments
        $(document).on('click', '#showMoreComments', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.post.comments', $post->slug) }}",
                type: "GET",
                success: function(response) {
                    if (response.status == 200) {
                        $('.comments').empty();
                        $.each(response.data.comments, function(key, comment) {
                            let commentHtml = `
                                <div class="comment" id="display_comment_${comment.id}" style="position: relative; padding-right: 30px;">
                                    <img src="${imageUrl}${comment.user.image.replace(/^\/+/, '')}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${comment.user.name}</span>
                                        <p class="comment-text">${comment.comment}</p>
                                    </div>`;

                            // Check if user is authenticated AND is the post author
                            if (authId !== null && authId === postAuthorId) {
                                commentHtml += `
                                    <div class="settings-container" style="position: absolute; top: 5px; right: 5px;">
                                        <button class="settings-btn" style="background: none; border: none; font-size: 18px; cursor: pointer; padding: 0; width: 20px; height: 20px;">⚙️</button>
                                        <div class="settings-dropdown" style="display: none; position: absolute; background-color: white; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 4px; right: 25px; top: 0;">
                                            <button class="dropdown-item delete-comment" data-comment-id="${comment.id}" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Delete Comment</button>
                                            <button class="dropdown-item hide-comment" data-comment-id="${comment.id}" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Hide Comment</button>
                                        </div>
                                    </div>`;
                            }

                            commentHtml += `</div>`;
                            $('.comments').append(commentHtml);
                        });
                        $('#showMoreComments').hide();
                    }
                },
                error: function(response) {
                    alert(response.message);
                }
            });
        });

        // Add new comment
        $(document).on('submit', '#commentFormId', function(e) {
            e.preventDefault();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: "{{ route('frontend.post.comments.store') }}",
                method: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                success: function(response) {
                    if (response.status == 201) {
                        $('#errorMessage').hide();
                        $('.comments').prepend(`
                            <div class="comment" data-comment-id="${response.data.id}" style="position: relative; padding-right: 30px;">
                                <img src="${imageUrl}${response.data.user.image.replace(/^\/+/, '')}" alt="User Image" class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">${response.data.user.name}</span>
                                    <p class="comment-text">${response.data.comment}</p>
                                </div>
                                <div class="settings-container" style="position: absolute; top: 5px; right: 5px;">
                                    <button class="settings-btn" style="background: none; border: none; font-size: 18px; cursor: pointer; padding: 0; width: 20px; height: 20px;">⚙️</button>
                                    <div class="settings-dropdown" style="display: none; position: absolute; background-color: white; min-width: 120px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1; border-radius: 4px; right: 25px; top: 0;">
                                        <button class="dropdown-item delete-comment" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Delete Comment</button>
                                        <button class="dropdown-item hide-comment" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Hide Comment</button>
                                        <button class="dropdown-item block-user" data-user-id="${response.data.user.id}" style="display: block; width: 100%; padding: 8px 12px; text-align: left; border: none; background: none; cursor: pointer;">Block User</button>
                                    </div>
                                </div>
                            </div>
                        `);
                        $('#comment_id').val('');
                    }
                },
                error: function(response) {
                    if (response.responseJSON.errors.user_id) {
                        window.location.href = '/login';
                    } else if (response.responseJSON.errors.comment) {
                        var errorMessage = response.responseJSON.errors.comment[0];
                        $('#errorMessage').text(errorMessage).show();
                    } else if (response.responseJSON.status == 401) {
                        window.location.href = '/login';
                    } else if (response.responseJSON.status == 403) {
                        var message = response.responseJSON.message;
                        $('#errorMessage').text(message).show();
                    }
                }
            });
        });
    });

    </script>
@endpush