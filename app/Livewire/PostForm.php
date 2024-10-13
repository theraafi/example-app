<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class PostForm extends Component
{
    use WithFileUploads;

    public $post = null;
    public $isView = false;

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

    public function mount(Post $post)
    {
        $this->isView = request()->routeIs('posts.view');

        if ($post->id) {
            $this->post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
        }

    }

    public function savePost()
    {
        $this->validate();

        $imagePath = null;

        if ($this->featuredImage ) {
            $imageName = $this->title . time() . '.' . $this->featuredImage->extension();
            $imagePath = $this->featuredImage->storeAs('public/uploads', $imageName);
            $url = Storage::url($imagePath);
        }

        $postSubmit = Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'featured_image' => $imagePath,
        ]);

        if ($postSubmit) {
            session()->flash('success', 'Post was successfully submitted');
        } else {
            session()->flash('error', 'Post was not submitted');
        }

        return $this->redirect('/posts', navigate: true);

    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
