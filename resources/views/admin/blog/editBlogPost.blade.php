@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h5 class="modal-title">Edit Blog Post</h5>
    <form action="{{ route('admin.posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST') <!-- Use POST method for the update -->
        <div class="mb-3">
            <label for="title">Post Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <!-- Select Category -->
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <!-- Display the current category name as the selected option -->
                @if($post->category)
                    <option value="{{ $post->category->id }}" selected>{{ $post->category->name }}</option>
                @else
                    <option value="" disabled>Select a category</option>
                @endif

                <!-- Loop through all categories to show them as options -->
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="4" required>{{ $post->content }}</textarea>
            <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('content');
            </script>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
