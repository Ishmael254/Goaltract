@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="btn btn-success btn-lg">Add New Category</a>


    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">All Blog Categories </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- <h5 class="card-header">Table Basic</h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $group)
                        <tr>
                            <td><strong>{{ $group->id }}</strong></td>
                            <td><strong>{{ $group->name }}</strong></td>

                            <td>{{ $group->created_at }}</td> <!-- Display a preview of the content -->

                            <td>
                                
                                <a href="{{ route('admin.postcategories.delete', $group->id) }}"
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
                    <h5 class="modal-title" id="exampleModalLabel4">Add Blog Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.postcategories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="groupname">Category Name</label><br><br>
                            <input type="text" name="name" id="groupname" class="form-control"
                                placeholder="Enter category name" required>
                            @error('groupname')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </form>


                </div>
            </div>
        </div>
    </div>

    @endsection