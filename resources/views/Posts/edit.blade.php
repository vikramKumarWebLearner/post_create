@extends('layouts.app')

@section('content')
       <div class="container">
            <div class="row">
                <div class="col-md-10 mt-5 m-auto">
                        <div class="card">
                                <div class="card-body">
                                    <h4 class="m-2 text-center">Post Edit</h4>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                @endif
                                <form action="{{ route('posts.update') }}" method="post" enctype="multipart/form-data">
                                    <input type="text" name="post_id" id="post_id" value="{{$post->id}}" hidden>
                                    @csrf
                                    @method('PUT')
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="{{$post->title}}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="content" class="form-label">Content</label>
                                            <input type="text" class="form-control" id="content" name="content" value="{{$post->content}}">
                                            @error('content')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{$post->start_date}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{$post->end_date}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class=" form-label">Image</label>
                                                <input onChange="imagePreview(event)" class="form-control" id="image" name="image" type="file">
                                                <!-- @error('image')
                                                <span class="text-danger">{{ $message }}</span>
                                             @enderror -->
                                         </div>

                                        <div class="mb-3">
                                        <div class="col-md-12 mb-5 text-center">
                                            <img id="preview-image-before-upload" src="{{ '/storage/'.$post->image}}"
                                                alt="profile-pic" class="img-thumbnail h-25 w-25">
                                        </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nubmer_of_guests" class="form-label">Number Of Guests</label>
                                            <input type="nubmer" class="form-control" id="nubmer_of_guests" name="nubmer_of_guests" value="{{$post->guest_numbers}}">
                                        </div>
                                        <div class="mb-3">
                                                 <label for="category" class="form-label">Ceategory</label>
                                                <select class="form-select" id="ceategory" name="category_id">
                                                <option selected>Select Ceategory</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                </div>
                        </div>
                </div>
            </div>
       </div>
@endsection

<script>
  function  imagePreview(event) {
            console.log(event)
            const file = event.target.files[0];
            let url = URL.createObjectURL(file);
            document.getElementById("preview-image-before-upload").src = url;
        }

</script>