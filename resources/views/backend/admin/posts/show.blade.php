@extends('backend.admin.master')
@section('title', "Show Post")
@section('content')
    <!-- Show Posts -->
    <section id="posts" class="posts-section">
        <h2 style="text-align: center">Show Post</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10"> <!-- Adjust column width for 90% -->
                <!-- Post Item -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                        <p class="card-text">{!! $post->description !!}</p>

                        <!-- Carousel for Images -->
                        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($post->images as $image)
                                    <li data-target="#newsCarousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                                @endforeach
                            </ol>
                            <div class="carousel-inner">
                                @foreach ($post->images as $image)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img src="{{ asset('storage/uploads/' . $image->image) }}" class="d-block w-100 img-fluid" style="max-height: 300px; object-fit: cover;" alt="Post Image">
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

                        <!-- Post Actions -->
                        <div class="post-actions d-flex justify-content-between mt-3">
                            <div class="post-stats">
                                <!-- View Count -->
                                <span class="me-3">
                                    <i class="fas fa-eye"></i> 
                                    {{ $post->number_of_views }}
                                </span>
                            </div>

                            <div>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal_{{ $post->id }}">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                                <x-delete-modal title="Delete Post" message="Are You Sure You Want To Delete This Post?" id="{{ $post->id }}" formId="formDelete_"></x-delete-modal>
                                <button id="comment_btn_{{ $post->id }}" class="btn btn-sm btn-outline-secondary getComments" post-slug="{{ $post->slug }}" post-id="{{ $post->id }}">
                                    <i class="fas fa-comment"></i> Comments
                                </button>
                                <button id="hide_comment_btn_{{ $post->id }}" class="btn btn-sm btn-outline-secondary hideComments" post-slug="{{ $post->slug }}" post-id="{{ $post->id }}" style="display:none;">
                                    <i class="fas fa-comment"></i> Hide Comments
                                </button>

                                <form id="formDelete_{{ $post->id }}" action="{{ route('admin.posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>

                        <!-- Display Comments -->
                        <div id="displayComments_{{ $post->slug }}" class="comments mt-3" style="display:none">
                            <!-- Comments will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
<script>
    $(document).on('click' , '.getComments' , function(e){
        e.preventDefault() ;
        var post_slug = $(this).attr('post-slug') ;
        var post_id = $(this).attr('post-id') ;
        $.ajax({
            url:'{{ route("admin.posts.comments" , ":post_slug") }}'.replace(":post_slug" , post_slug) ,
            type:"GET",
            dataType:"json" ,
            success:function(response){
                if(response.status == 200){
                    $('#displayComments_' + post_slug).empty() ;
                    if(response.data.comments.length == 0){
                        $("#displayComments_" + post_slug).append(`<div class="alert alert-danger">No Comments Founded!</div>`).show();
                    }
                    $.each(response.data.comments, function (key, comment) {
                        // format date string 
                        const createdAt = new Date(comment.created_at);
                        const formattedDate = createdAt.toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        });
                        const imageUrl = 'http://news-portal.net/storage/uploads/'  + comment.user.image ; 
                        $("#displayComments_" + post_slug).append(`
                            <div class="comment" style="display: flex; align-items: flex-start; margin-bottom: 15px;">
                                <img src="${imageUrl}" alt="User Image" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 10px;" />
                                <div class="comment-content" style="flex: 1;">
                                    <span class="username" style="font-weight: bold; display: block; margin-bottom: 5px;">${comment.user.name}(${formattedDate})</span>
                                    <p class="comment-text" style="margin: 0;">${comment.comment}</p>
                                </div>
                            </div>
                        `).show();
                    });
                    $("#comment_btn_" + post_id).hide() ; 
                    $("#hide_comment_btn_" + post_id).show() ; 
               }
            }
        }) ; 


    }) ; 


// hide the "button : Hide Comments" 
    $(document).on('click' , '.hideComments' , function(e){
        var post_slug = $(this).attr('post-slug') ;
        var post_id = $(this).attr('post-id') ;
        e.preventDefault() ;
        $('#displayComments_' + post_slug).hide() ; 
        $("#comment_btn_" + post_id).show() ;
        $('#hide_comment_btn_' + post_id).hide() ;
    }) ;

</script>
@endpush