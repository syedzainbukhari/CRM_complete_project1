<x-admin-master>

    @section('content')

        <h1>Edit Post</h1>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form method="post" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text"
                       name="title"
                       class="form-control"
                       id="title"
                       aria-describedby=""
                       placeholder="Enter title"
                       value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
                <label for="post_image">File</label>
                <input type="file"
                       name="post_image"
                       class="form-control-file"
                       id="post_image">
            </div>


            <div class="form-group">
                         <textarea
                                 name="body"
                                 class="form-control"
                                 id="body"
                                 cols="30"
                                 rows="10">value="{{$post->body}}"</textarea>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>
