@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit Page Content</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <!-- Displaying All Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.group.update', $group->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="page_name">Group Name</label>
            <input type="text" name="page_name" class="form-control" value="{{ $group->page_name }}" required>
        </div>

        <!-- Select Category -->
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <!-- Display the current category name as the selected option -->
                @if($group->category)
                    <option value="{{ $group->category->id }}" selected>{{ $group->category->name }}</option>
                @else
                    <option value="" disabled>Select a category</option>

                @endif
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
                placeholder="Enter group description"
                required>{!! $group->content ?? 'No content available' !!}</textarea>
            <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.replace('content', {
                    on: {
                        instanceReady: function (ev) {
                            // Adds content-table class to all tables upon paste or save
                            ev.editor.dataProcessor.htmlFilter.addRules({
                                elements: {
                                    table: function (element) {
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
        <br>

        <button type="submit" class="btn btn-primary">Update Group</button>
    </form>






</div>

@endsection