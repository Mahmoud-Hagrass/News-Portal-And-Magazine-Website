<?php

namespace App\Livewire\Backend\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class DashboardStatistic extends Component
{
    public function render()
    {
        $posts_count = Post::active()->count() ; 
        $categories_count = Category::active()->count() ; 
        $comments_count = Comment::active()->count() ; 
        $users_count = User::active()->count() ; 
        return view('livewire.backend.admin.dashboard-statistic')->with(get_defined_vars());
    }
}
