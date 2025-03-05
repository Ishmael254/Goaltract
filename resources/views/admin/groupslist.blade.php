@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="btn btn-success btn-lg">Add New Group</a>


    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">All Whatsapp Group List</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- <h5 class="card-header">Table Basic</h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Group Name</th>
                        <th>Content</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td><strong>{{ $group->id }}</strong></td>
                            <td><strong>{{ $group->page_name }}</strong></td>

                            <td>{!! Str::limit($group->content, 100) !!}</td> <!-- Display a preview of the content -->

                            <td>
                                <a href="{{ route('admin.editgroup', $group->id) }}"
                                    class="btn rounded-pill btn-outline-primary">Edit</a>
                                <a href="{{ route('admin.group.delete', $group->id) }}"
                                    class="btn rounded-pill btn-outline-danger">Delete</a>
                                    

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
                    <h5 class="modal-title" id="exampleModalLabel4">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="groupname">Group Name</label>
                            <input type="text" name="groupname" id="groupname" class="form-control"
                                placeholder="Enter group name" required>
                            @error('groupname')
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


                        <button type="submit" class="btn btn-primary">Save Group</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @endsection