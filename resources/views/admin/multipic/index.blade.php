@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card-group">
                    @foreach ($images as $image)
                    <div class="col-md-4 mt-5">
                        <div class="card">
                            <img src="{{ asset($image->image) }}" alt="">
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-3">
                    {{ $images->links() }}
                </div>

            </div> <!-- End Col -->

            <div class="col-md-4">

                <div class="card card-default">
                    <div class="card-header">Multi Image</div>
                    <div class="card-body">
                        <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label>Insert Multi Picture</label>
                                <input type="file" class="form-control" name="image[]" id="exampleInputEmail1" aria-describedby="emailHelp" multiple="">
                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Image</button>
                        </form>
                    </div>
                </div> <!-- End Card -->
            </div> <!-- End Col -->

        </div> <!-- End Row -->
    </div> <!-- End Container -->
</div>
@endsection