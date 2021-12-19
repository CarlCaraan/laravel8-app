@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Edit Contact</div>
                    <div class="card-body">
                        <form action="{{ url('contact/update/'.$contacts->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Address</label>
                                <textarea name="address" class="form-control" id="exampleFormControlInput1" rows="3">{{ $contacts->address }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Email</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="Email" value="{{ $contacts->email }}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Contact Phone</label>
                                <input type="tel" name="phone" class="form-control" id="exampleFormControlInput1" placeholder="Phone" value="{{ $contacts->phone }}">
                                @error('phone')
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