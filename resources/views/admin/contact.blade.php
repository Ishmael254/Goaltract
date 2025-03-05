@extends('layouts.admin')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-1"><span class="text-muted fw-light">All Messages</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <!-- <h5 class="card-header">Table Basic</h5> -->
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>name </th>
                        <th>email</th>
                        <th>message</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($msgs as $group)
                        <tr>
                            <td><strong>{{ $group->id }}</strong></td>
                            <td><strong>{{ $group->name }}</strong></td>
                            <td><strong>{{ $group->email }}</strong></td>
                            <td><strong>{{ $group->message }}</strong></td>

                            <td>{{ $group->created_at }}</td> <!-- Display a preview of the content -->

                           
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
        <!--/ Basic Bootstrap Table -->
    </div>


    

    @endsection