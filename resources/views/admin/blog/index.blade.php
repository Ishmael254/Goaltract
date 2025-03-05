@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="btn btn-success btn-lg">Add New Blog Post</a>


    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">All Posts List</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- <h5 class="card-header">Table Basic</h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title </th>
                        <th>Content</th>
                        <th>Image </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $group)
                        <tr>
                            <td><strong>{{ $group->id }}</strong></td>
                            <td><strong>{{ $group->title }}</strong></td>
                            <td>{!! Str::limit($group->content, 60) !!}</td>
                            <td><img src="{{ asset($group->image_url) }}" alt="{{ $group->title }}" class="img-fluid">
                            </td>

                            <td>{{ $group->created_at }}</td> <!-- Display a preview of the content -->

                            <td>
                                <a href="{{ route('admin.editblogpost', $group->id) }}" class="btn rounded-pill btn-outline-primary">Edit</a>
                                
                                <form action="{{ route('admin.blogpost.delete', $group->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE') <!-- Use DELETE method for the delete -->
                                    <button type="submit" class="btn rounded-pill btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?');">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <!--/ Basic Bootstrap Table -->
    </div>


    <!-- Add new group Modal -->
    <div class="modal fade" id="exLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel4">Add Blog Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title">Post Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Enter post title" required>
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                 <!-- Select Category -->
                 <div class="mb-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-select" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                 <!-- Group Description -->
            <div class="mb-3">
                <label for="groupDescription">Description</label>
                <textarea required name="content" id="content" class="form-control" rows="4"
                    placeholder="Enter group description" required></textarea>
                <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace('content', {
                        on: {
                            instanceReady: function(ev) {
                                // Adds content-table class to all tables upon paste or save
                                ev.editor.dataProcessor.htmlFilter.addRules({
                                    elements: {
                                        table: function(element) {
                                            element.addClass('content-table');
                                        }
                                    }
                                });
                            }
                        }
                    });
                </script>

                @error('description')
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

               

                <button type="submit" class="btn btn-primary">Save Post</button>
            </form>


                </div>
            </div>
        </div>
    </div>

    @endsection