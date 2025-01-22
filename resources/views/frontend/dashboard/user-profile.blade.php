@extends('frontend.master')
@section('title' , 'user-dashboard')
@section('user-dashboard-status' , 'active')
@section('content')
<br>
    <!-- Profile Start -->
    <div class="dashboard container">
        <!-- Sidebar -->

        <!-- Sidebar -->
   <aside class="col-md-3 nav-sticky dashboard-sidebar">
        <!-- User Info Section -->
        <div class="user-info text-center p-3">
            <img src="{{ asset('img.jpg')}}" alt="User Image" class="rounded-circle mb-2"
                style="width: 80px; height: 80px; object-fit: cover" />
            <h5 class="mb-0" style="color: #ff6f61"></h5>
        </div>

        <br><br>
        <!-- Sidebar Menu -->
        <div class="list-group profile-sidebar-menu">
            <a href=""
                class="list-group-item list-group-item-action menu-item active">
                <i class="fas fa-user"></i> Profile
            </a>
            <a href="" class="list-group-item list-group-item-action menu-item" data-section="notifications">
                <i class="fas fa-bell"></i> Notification
            </a>
            <a href="" class="list-group-item list-group-item-action menu-item" data-section="settings">
                <i class="fas fa-cog"></i> Settings
            </a>
            <a href="" class="list-group-item list-group-item-action menu-item" data-section="settings">
                <i class="fa fa-question" aria-hidden="true"></i> Support
            </a>
            <a href="javascript:void(0)" class="list-group-item list-group-item-action menu-item" data-section="settings">
                <i class="fa fa-power-off" aria-hidden="true"></i> Logout
            </a>

            <form action="" method="">
            
            </form>

        </div>
    </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ asset('img.jpg')}}" alt="User Image"
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
                            <div class="post-item mb-4 p-3 border rounded">
                                <div class="post-header d-flex align-items-center mb-2">
                                    <img src="{{ asset('img.jpg')}}" alt="User Image" class="rounded-circle"
                                        style="width: 50px; height: 50px;" />
                                    <div class="ms-3">
                                        <h5 class="mb-0"> </h5>
                                    </div>
                                </div>
                                <h4 class="post-title"></h4>
                                <p class="post-content"></p>

                                <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                        <li data-target="#newsCarousel" data-slide-to="1"></li>
                                        <li data-target="#newsCarousel" data-slide-to="2"></li>
                                    </ol>
                                    <div class="carousel-inner">

                                            <div class="carousel-item active">
                                                <img src="{{ asset('img.jpg')}}" class="d-block w-100"
                                                    alt="First Slide">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5></h5>

                                                </div>
                                            </div>

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
                                    </div>

                                    <div>
                                        <a href=""
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>

                                        <button id="" class="getComments" 
                                            class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-comment"></i> Comments
                                        </button>

                                        <button id="" class="hideComments" post-id=""
                                            class="btn btn-sm btn-outline-secondary" style="display: none">
                                            <i class="fas fa-comment"></i> Hide Comments
                                        </button>

                                        <form id=""
                                            action="" method="">
                                        
                                        
                                            <input name="" value="" hidden>
                                        </form>
                                    </div>
                                </div>

                                <!-- Display Comments -->
                                <div id="" class="comments" style="display: none">

                                    <!-- Add more comments here for demonstration -->
                                </div>
                            </div>

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
             }) ;

             $('#smallDescription').summernote({
                height: 150, // Set the height of the editor
                placeholder: 'Enter small description...',
             }) ; 
        });  
    </script>
@endpush
