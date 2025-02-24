<div class="row">
    <!-- First Table: Latest Posts -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Posts</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latest_posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td style="text-align:center">{{ $post->comments_count }}</td>
                            <td style="text-align:center">{{ $post->status == 1 ? 'Active' : 'Not Active'}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-info text-center">No Posts Found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Second Table: Latest Comments -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Latest Comments</h6>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Comment</th>
                            <th scope="col">Post</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($latest_comments as $comment)
                        <tr>
                            <td>{{ Str::limit($comment->comment, 30) }}</td>
                            <td>{{ Str::limit($comment->post->title , 10) }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td style="text-align:center">{{ $comment->status == 1 ? 'Active' : 'Not Active'}}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-info text-center">No Comments Found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>