@extends('admin.admin_master')

@section('admin')
<div class="col-lg-8">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create About</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.about') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">About Title</label>
                    <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="About Title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Short Description</label>
                    <textarea class="form-control" name="short_desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                    @error('short_desc')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Long Description</label>
                    <input id="long_desc" type="hidden" name="long_desc">
                    <trix-editor input="long_desc"></trix-editor>
                    @error('long_desc')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection