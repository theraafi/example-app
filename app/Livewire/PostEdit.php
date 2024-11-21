<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
class PostEdit extends Component
{
    use WithFileUploads;

    #[Validate('required' , message: 'Post title is required')]
    #[Validate('min:3' , message: 'Post title must be at least 3 characters')]
    #[Validate('max:100' , message: 'Post title cannot exceed 100 characters')]
    public $title;

    #[Validate('required' , message: 'Content is required')]
    #[Validate('min:3' , message: 'Content must be at least 3 characters')]
    #[Validate('max:150' , message: 'Post title cannot exceed 150 characters')]
    public $content;

    #[Validate('required' , message: 'Featured Image is required')]
    #[Validate('image', message: 'Featured Image is must be a valid image')]
    #[Validate('mimes:jpg,jpeg,png,webp,gif' , message: 'Featured Image is must be a valid image')]
    #[Validate('max:2048', message: 'Image can not be larger than 2MB')]
    public $featuredImage;

    public $id;

    public $posts;

    public function mount(Post $post)
    {
        $this->id = Post::select('id')->get();
        $this->posts = Post::all();
        $this->title = $post->title;
        $this->content = $post->content;
        $this->featuredImage = $post->featured_image;
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->title = $post->title;
        $this->content = $post->content;
        $this->featuredImage = $post->featured_image;

    }

    public function updatePost()
    {
        $this->validate();

        
    }

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.post-edit');
    }
}
