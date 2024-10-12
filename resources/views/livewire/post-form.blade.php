<div class="container py-4">

    <div class="row">
        <div class="col-8 m-auto">

            <form wire:submit='savePost' action="">
                @csrf
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-xl-6">
                                <h5 class="fw-bold">
                                    {{ $isView ? 'View' : 'Create' }} post
                                </h5>
                            </div>
                            <div class="col-xl-6 text-end">
                                <a wire:navigate href="{{ route('posts') }}" class="btn btn-success btn-sm">Back to
                                    Post</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        {{-- Post Title --}}
                        <div class="form-group mb-2">
                            <label for="title">Title <span class="text-danger"> *</span> </label>

                            <input type="text" {{ $isView ? 'disabled' : ' ' }} wire:model="title"
                                class="form-control" id="title" placeholder="Post title">

                            @error('title')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>

                        {{-- Post Content --}}
                        <div class="form-group mb-2">
                            <label for="content">Content <span class="text-danger"> *</span> </label>

                            <textarea type="text" {{ $isView ? 'disabled' : ' ' }} wire:model="content" class="form-control" id="content"
                                placeholder="Post title"> </textarea>

                            @error('content')
                                <p class="text-danger"> {{ $message }} </p>
                            @enderror
                        </div>

                        {{-- View Featured Image --}}
                        @if ($post)
                            <label for=""> Uploaded Image </label>
                            <div class="my-2">
                                <img src="{{ Storage::url($post->featured_image) }}" class="img-fluid" width="100px"
                                    alt="">
                            </div>
                        @endif


                        {{-- Post Featured Image --}}
                        @if (!isView)
                            <div class="form-group mb-2">
                                <label for="featuredImage">Image <span class="text-danger"> *</span> </label>

                                <input type="file" wire:model="featuredImage" class="form-control"
                                    id="featuredImage">

                                {{-- Preview --}}
                                @if ($featuredImage)
                                    <img src="{{ $featuredImage->temporaryUrl() }}" class="img-fluid mt-1"
                                        width="200px" height="300px" alt="">
                                @endif


                                @error('featuredImage')
                                    <p class="text-danger"> {{ $message }} </p>
                                @enderror
                            </div>
                        @endif

                    </div>

                    @if (!isView)
                        <div class="card-footer">
                            <div class="form-group mb-2">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    @endif

                </div>

            </form>

        </div>

    </div>


</div>
