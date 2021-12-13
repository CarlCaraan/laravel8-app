<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Category <b></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">

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

                        <div class="card-header">All Category</div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL NO</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user_id }}</td>
                                        <td>
                                            @if($category->created_at == NULL)
                                            <span class="text-danger">No Date Set</span>
                                            @else
                                            {{ $category->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- End Table Responsive -->
                    </div> <!-- End Card -->
                </div> <!-- End Col -->

                <div class="col-md-4">

                    <div class="card card-default">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category Name</label>
                                    <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div> <!-- End Card -->
                </div> <!-- End Col -->


            </div> <!-- End Row -->
        </div>
    </div>
</x-app-layout>