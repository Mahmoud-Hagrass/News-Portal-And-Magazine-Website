<?php

namespace App\Livewire\Backend\Admin;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostComments extends Component
{
    public function render()
    {
        $latest_posts = Post::active()
            ->with(['category:id,name'])
            ->withCount('comments')
            ->take(6)
            ->latest()
            ->get();
        
        $latest_comments = Comment::active()
            ->with(['user:id,name' , 'post:id,title'])
            ->take(6)
            ->latest()
            ->get() ; 
                    
        return view('livewire.backend.admin.post-comments')->with(get_defined_vars());
    }
}
