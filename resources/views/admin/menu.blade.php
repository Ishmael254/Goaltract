@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <a href="" data-bs-toggle="modal" data-bs-target="#exLargeModal" class="btn btn-success btn-lg">Add New Menu Item</a>


    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">All Menu Item List</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- <h5 class="card-header">Table Basic</h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Menu Title </th>
                        <th>Menu URL</th>
                        <th>Menu order</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $group)
                        <tr>
                            <td><strong>{{ $group->id }}</strong></td>
                            <td><strong>{{ $group->title }}</strong></td>
                            <td><strong>{{ $group->url }}</strong></td>
                            <td><strong>{{ $group->order }}</strong></td>

                            <td>{{ $group->created_at }}</td> <!-- Display a preview of the content -->

                            <td>
                                <a href="{{ route('admin.editgroup', $group->id) }}"
                                    class="btn rounded-pill btn-outline-primary">Edit</a>
                                <a href="{{ route('admin.categories.delete', $group->id) }}"
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
                    <h5 class="modal-title" id="exampleModalLabel4">Add Menu Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title">Menu Title</label><br><br>
                            <input type="text" name="title" id="title" class="form-control"
                                placeholder="Enter menu title" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="url">URL</label><br><br>
                            <input type="text" name="url" id="url" class="form-control"
                                placeholder="Enter menu url" required>
                            @error('url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="order">Order</label><br><br>
                            <input type="number" name="order" id="order" class="form-control"
                                placeholder="Enter category name" required>
                            @error('order')
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