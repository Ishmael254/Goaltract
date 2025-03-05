@extends('layouts.admin')


@section('content')
<div class="container">
    <h1>Edit Welcome Page Content</h1>


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

    <form action="{{ route('admin.content.update') }}" method="POST" enctype="multipart/form-data">
        @csrf        
        <br>          

           
            <!-- Group Description -->
            <div class="mb-3">
                <label for="groupDescription">Description</label>
                <textarea required name="content" id="content" class="form-control" rows="4"
                    placeholder="Enter group description" required>{!! $content->content ?? 'No content available' !!}</textarea>
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
            <br>

        <button type="submit" class="btn btn-primary">Update Content</button>
    </form>
    


   
</div>
@endsection


