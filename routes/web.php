<?php

use App\Livewire\PostForm;
use App\Livewire\PostList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('posts', PostList::class)->name('posts');
Route::get('posts/create', PostForm::class)->name('posts.create');
Route::post('posts/delete{$id}', PostForm::class)->name('posts.delete');

