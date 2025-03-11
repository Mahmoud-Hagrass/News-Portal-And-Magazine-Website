@extends('frontend.master')
@section('title' , 'edit-post')
@section('content')
    <!-- Profile Start -->
    <div class="dashboard container">
        @include('frontend.dashboard.sidebar') 
        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <br>
                @if(session()->has('errors'))
                <div>
                  @foreach (session('errors')->all() as $error)
                    {{ $error }}  
                  @endforeach
                </div>
                @endif
                <form action="{{ route('frontend.dashboard.post.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Add Post Section -->
                    <section id="add-post" class="add-post-section mb-5">
                        <h2>Edit Post</h2>
                        <div class="post-form p-3 border rounded">
                            @if($post->id)
                                <input type='hidden' name="post_id" value="{{ $post->id }}" />
                            @endif
                            <!-- Post Title -->
                            <input type="text" name="title"  id="postTitle" class="form-control mb-2"
                                placeholder="Post Title" value="{{ $post->title }}"/>
                            <!-- Post Content -->
                            <textarea name="description" id="smallDescription" class="form-control mb-2" rows="6" placeholder="Enter Small Description">{!! $post->description !!}</textarea>
                            
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
                                        <option value="{{ $category->id }}" @selected($category->id == $post->category_id)>{{ $category->name }}</option>
                                    @endforeach
                            </select><br>

                            <!-- Enable Comments Checkbox -->
                            <label class="lable">
                                Enable Comments : <input name="comment_able" type="checkbox" @checked($post->comment_able == 1) class=""/>
                            </label><br>

                            <!-- Post Button -->
                            <button type="submit" class="btn btn-primary post-btn">Edit Post</button>
                        </div>
                    </section>
                </form>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection


@push('js')
    <script>
        $('#smallDescription').summernote({
            height: 150, 
        }) ;
        $('#postImage').fileinput({
            theme: 'fa5' , 
            showUpload:false , 
            maxFileCount: 5 , 
            maxFileSize: 2048 , 
            allowedFileExtensions: ['jpg', 'png', 'jpeg' , 'webp'],
            initialPreviewAsData:true , 
            initialPreviewFileType:'image' ,
            initialPreview:[
                @if($post->images->count() > 0)
                    @foreach ($post->images as $image)
                        "{{ asset('storage/uploads/' . $image->image) }}",
                    @endforeach
                @endif
            ] , 
            initialPreviewConfig:[
                 @if ($post->images->count() == 1) // if the post have only one image don't reomve it
                        {
                            "caption": "{{ $image->image }}", 
                            "width":"120px" , 
                            "key": "{{ $image->id }}", 
                            "type":'image' ,
                        },
                    @endif
                 @if ($post->images->count() >0)
                    @foreach ($post->images as $image)
                        {
                            "caption": "{{ $image->image }}", 
                            "width":"120px" , 
                            "url": "{{ route('frontend.dashboard.post.image.delete' , [$image->id , '_token' => csrf_token() , '_method' => 'DELETE' ])}}", 
                            "key": "{{ $image->id }}", 
                            "type":'image' ,
                        },
                    @endforeach
                @endif
            ], 
        }) ; 
    </script> 
@endpush