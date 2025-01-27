@extends('frontend.master')
@section('title' , 'user-dashboard')
@section('profile-status' , 'active')
@section('content')
<br>
    <!-- Profile Start -->
    <div class="dashboard container">
        @include('frontend.dashboard.sidebar') 
        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ asset('storage/uploads/' . Auth::guard('web')->user()->image) ?? asset('img.jpg')}}" alt="User Image"
                        class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
                    <span class="username">{{ Auth::guard('web')->user()->name }}</span>
                </div>
                <br>

                @if(session()->has('errors'))
                   @foreach(session('errors')->all() as $error)
                       <div class="alert alert-danger">
                        {{ $error }}
                       </div>
                   @endforeach
                @endif
                <form action="{{ route('frontend.dashboard.post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Post Section -->
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Add Post</h2>
                        <div class="post-form p-3 border rounded">
                            <!-- Post Title -->
                            <input type="text" name="title"  id="postTitle" class="form-control mb-2"
                                placeholder="Post Title" />

                            <!-- Post Content -->
                            <textarea name="description" id="smallDescription" class="form-control mb-2" rows="6" placeholder="Enter Small Description"></textarea>
                            
                            <!-- Image Upload -->
                            <input name="images[]" type="file" id="postImage" class="form-control mb-2" accept="image/*"
                                multiple/>
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>

                            <!-- Category Dropdown -->
                            <select name="category_id" id="postCategory">
                                <option value="" selected>Select Category</option>
                                    @foreach($allCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                            </select><br>

                            <!-- Enable Comments Checkbox -->
                            <label class="lable">
                                Enable Comments : <input name="comment_able" type="checkbox" class=""/>
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Post</button>
                        </div>
                    </section>
                </form>

                <!-- Show Posts-->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                           @forelse ($posts as $post)
                                <div class="post-item mb-4 p-3 border rounded">
                                    <div class="post-header d-flex align-items-center mb-2">
                                        <img src="{{ asset('img.jpg')}}" alt="User Image" class="rounded-circle"
                                            style="width: 50px; height: 50px;" />
                                        <div class="ms-3">
                                            <h5 class="mb-0">{{ Auth::guard('web')->user()->name}}</h5>
                                        </div>
                                    </div>
                                    <h4 class="post-title">{{ $post->title }}</h4>
                                    <p class="post-content">{!! $post->description !!}</p>

                                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                                        </ol>
                                        <div class="carousel-inner">
                                            @foreach($post->images as $image)
                                                <div class="carousel-item @if($loop->index == 0) active @endif" >
                                                    <img src="{{ asset('storage/uploads/' . $image->image) }}" class="d-block w-100"
                                                        alt="First Slide">
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
                                        <a class="carousel-control-next" href="#newsCarousel" role="button"
                                            data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>

                                    <div class="post-actions d-flex justify-content-between">
                                        <div class="post-stats">
                                            <!-- View Count -->
                                            <span class="me-3">
                                                <i class="fas fa-eye"></i> 
                                            </span>
                                            {{ $post->number_of_views }}
                                        </div>

                                        <div>
                                            <a href="{{ route('frontend.dashboard.post.edit' , $post->slug) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="btn btn-sm btn-outline-primary" onclick="deletePost({{ $post->id }})">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                
                                            <button id="comment_btn_{{ $post->id }}" class="getComments" 
                                                class="btn btn-sm btn-outline-secondary" post-slug="{{ $post->slug }}"  post-id="{{ $post->id }}">
                                                <i class="fas fa-comment"></i> Comments
                                            </button>
                                            
                                            <button id="hide_comment_btn_{{ $post->id }}" class="hideComments" 
                                                class="btn btn-sm btn-outline-secondary" post-slug="{{ $post->slug }}" post-id="{{ $post->id }}" style="display:none;">
                                                <i class="fas fa-comment"></i> Hide Comments
                                            </button>

                                            <form id="formDelete_{{ $post->id }}" action="{{ route('frontend.dashboard.post.delete') }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="post_delete" value="{{ $post->id }}">
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Display Comments -->
                                    <div id="displayComments_{{ $post->slug }}" class="comments" style="display:none">

                                        <!-- Add more comments here for demonstration -->
                                    </div>
                                </div>
                           @empty
                                </div class="alert alert-info">
                                     No Posts Founded
                                </div>
                           @endforelse

                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection

@push('js')
    <script>
        $(function(){
             $('#postImage').fileinput({
                theme: 'fa5',
                showUpload:false, 
                allowedFileExtensions: ['jpg', 'png', 'jpeg' , 'webp'],
                maxFileCount: 5,
                maxFileSize: 2048,
             }) ;

             $('#smallDescription').summernote({
                height: 150, // Set the height of the editor
                placeholder: 'Enter small description...',
             }) ; 
        });  


        // method to delete posts after confirm 
        function deletePost(id)
        {
            if(confirm('Are You Sure That You Want To Delete ? ')){
                document.getElementById('formDelete_' + id).submit() ;
            }
        }
        // display commment for each posts when click on "button : Comments"
        $(document).on('click' , '.getComments' , function(e){
            e.preventDefault() ;
            var post_slug = $(this).attr('post-slug') ;
            var post_id = $(this).attr('post-id') ;
            $.ajax({
                url:'{{ route("frontend.dashboard.post.comments" , ":post_slug") }}'.replace(":post_slug" , post_slug) ,
                type:"GET",
                dataType:"json" ,
                success:function(response){
                    if(response.status == 200){
                        $('#displayComments_' + post_slug).empty() ;
                        $.each(response.comments , function(key , comment){
                            $("#displayComments_" + post_slug).append(`<div class="comment">
                                        <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                        <div class="comment-content">
                                            <span class="username">${comment.user.name}</span>
                                            <p class="comment-text">${comment.comment}</p>
                                        </div>
                                    </div>`).show() ; 
                            }) ;
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
