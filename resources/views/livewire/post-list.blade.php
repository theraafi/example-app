<div class="container my-4">

    <div class="row">
        <div class="col-xl-10">
            <h4 class="text-center fw-bold">
                Laravel 11 CRUD using Livewire
            </h4>
        </div>


        <div class="col-xl-2">
            <a wire:navigate href="{{ route('posts.create') }}" class="btn btn-success btn-sm">Add Post</a>
        </div>

    </div>

    {{-- Alert Component --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session('error') }}
        </div>
    @endif


    {{-- Table Post Listing --}}
    <div class="table-responsive mt-3">
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Featured Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
                <th>Action</th>
            </thead>

            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ Storage::url($post->featured_image) }}" class="img-fluid" width="100px"
                               height="100px" alt="">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->Content }}</td>
                        <td>
                            <p><small><strong>Posted: </strong>
                                    {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </small></p>

                            <p><small><strong>Updated at: </strong>
                                    {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }} </small></p>
                        </td>
                        <td>
                            <a href="" class="btn btn-success btn-sm"> Edit </a>

                            <button wire:click='deletePost({{ $post->id }})' type="button" class="btn btn-danger btn-sm"> Delete </button>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>

        </table>
    </div>

</div>
