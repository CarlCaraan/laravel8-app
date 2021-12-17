@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">

            <div class="w-100">
                <h4 class="float-left">Home About</h4>
                <a class="float-right mb-3" href="{{ route('add.about') }}">
                    <button class="btn btn-info">Add About</button>
                </a>
            </div>

            <div class="col-md-12">
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

                    <div class="card-header">All About</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL NO</th>
                                    <th scope="col" width="10%">About Title</th>
                                    <th scope="col" width="30%">Short Description</th>
                                    <th scope="col" width="10%">Long Description</th>
                                    <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($abouts as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $about->title }}</td>
                                    <td>{{ $about->short_desc }}</td>
                                    <td>{{ $about->long_desc }}</td>
                                    <td>
                                        <a href="{{ url('about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('delete/about/'.$about->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Start Pagination -->
                        <div class="float-right mb-3 mr-3">
                            {{ $abouts->links() }}
                        </div>
                        <!-- End Pagination -->

                    </div> <!-- End Table Responsive -->
                </div> <!-- End Card -->
            </div> <!-- End Col -->



        </div> <!-- End Row -->
    </div> <!-- End Container -->
</div>
@endsection