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

                    <div class="card-header">Edit Slider</div>
                    <div class="card-body">
                        <form action="{{ url('slider/update/'.$sliders->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $sliders->image }}">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Slider Name</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value={{ $sliders->title }}>
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Slider Description</label>
                                <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="10">{{ $sliders->description }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Update Slider Image</label>
                                <input type="file" class="form-control" name="image" id="exampleInputEmail1" aria-describedby="emailHelp" value={{ $sliders->image }}>
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($sliders->image) }}" width="400px" height="200px" alt="">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Slider</button>
                        </form>
                    </div>
                </div> <!-- End Card -->
            </div> <!-- End Col -->
        </div> <!-- End Row -->
    </div>
</div>
@endsection