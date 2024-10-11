<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;


class PostList extends Component
{
    public $posts;

    public $id;

    public function mount()
    {
        $this->posts = Post::all();
    }

    public function render()
    {

        $this->id = Post::select('id')->get();
        return view('livewire.post-list');
    }


    public function deletePost($id)
    {
        try {
            Post::find($id)->delete();
            session()->flash('success', 'Post deleted successfully');
        } catch (\Exception $ex) {
            session()->flash('error', 'Failed to delete post');

        }

        return $this->redirect('/posts', navigate: true);
    }

}


