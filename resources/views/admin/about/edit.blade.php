@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    <!-- Start Success Message -->
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <!-- End Success Message -->

                    <div class="card-header">Edit About</div>
                    <div class="card-body">
                        <form action="{{ url('about/update/'.$abouts->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update About Name</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value={{ $abouts->title }}>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Short Description</label>
                                <textarea class="form-control" name="short_desc" id="exampleFormControlTextarea1" rows="3">{{ $abouts->short_desc }}</textarea>
                                @error('short_desc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Update Long Description</label>
                                <input id="long_desc" type="hidden" name="long_desc" value="{{ $abouts->long_desc }}">
                                <trix-editor input="long_desc"></trix-editor>
                                @error('long_desc')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update About</button>
                        </form>
                    </div>
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </div>
</div>
@endsection