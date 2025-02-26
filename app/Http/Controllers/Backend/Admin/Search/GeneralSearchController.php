<?php

namespace App\Http\Controllers\Backend\Admin\Search;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralSearchController extends Controller
{
    public function search(Request $request)
    {
        $this->searchValidate($request);

        switch ($request->option) {
            case 'posts':
                return $this->searchPosts($request);
            case 'users':
                return $this->searchUsers($request);
            case 'contacts':
                return $this->searchContacts($request);
            default:
                return redirect()->route('admin.index');
        }
    }

    private function searchPosts(Request $request)
    {
        $posts = Post::query()
            ->where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
            ->with(['user:id,name'])
            ->paginate(5);

        if ($posts->isEmpty()) {
            return redirect()->route('admin.index');
        }

        return view('backend.admin.posts.index', compact('posts'));
    }

    private function searchUsers(Request $request)
    {
        $users = User::query()
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('username', 'LIKE', '%' . $request->search . '%')
            ->paginate(5);

        if ($users->isEmpty()) {
            return redirect()->route('admin.index');
        }

        return view('backend.admin.users.index', compact('users'));
    }

    private function searchContacts(Request $request)
    {
        $contacts = Contact::query()
            ->where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('subject', 'LIKE', '%' . $request->search . '%')
            ->orWhere('message', 'LIKE', '%' . $request->search . '%')
            ->paginate(5);

        if ($contacts->isEmpty()) {
            return redirect()->route('admin.index');
        }

        return view('backend.admin.contacts.index', compact('contacts'));
    }

    private function searchValidate(Request $request)
    {
        $request->validate([
            'search' => ['required', 'string', 'min:1', 'max:100'],
            'option' => ['required', 'string', 'in:users,posts,contacts'],
        ]);
    }
}