@extends('admin.admin_master')

@section('admin')
<div class="container">

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

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>User Profile</h2>
        </div>
        <div class="card-body">
            <form class="form-pill" action="{{ route('user.update.profile') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="password">User Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    @error('name')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">User Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                    @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                    @enderror
                </div>
                <button type="" submit class="btn btn-primary btn-default">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection