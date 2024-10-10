<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostForm extends Component
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

    public function savePost()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}