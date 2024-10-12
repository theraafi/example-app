<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use Livewire\WithPagination;
use PHPUnit\Framework\ComparisonMethodDoesNotDeclareExactlyOneParameterException;
use Livewire\WithoutUrlPagination;

class PostList extends Component
{
    use WithPagination , WithoutUrlPagination;



    public $id;



    public function render()
    {

        $posts = Post::paginate(3);
        return view('livewire.post-list', compact('posts'));

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


