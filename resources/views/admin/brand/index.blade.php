@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">All Brand</div>
                    <div class="table-responsive">
                        <table id="admin_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SL NO</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- @php($i = 1) -->
                                @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" width="70px" height="40px" alt=""></td>
                                    <td>
                                        @if($brand->created_at == NULL)
                                        <span class="text-danger">No Date Set</span>
                                        @else
                                        {{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                        <!-- <a href="{{ url('delete/brand/'.$brand->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a> -->
                                        <button class=" btn btn-danger" data-target="#deleteModal" data-toggle="modal" onclick="handleDelete({{ $brand->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Start Pagination -->
                        <div class="float-right mb-3 mr-3"> 
                            {{ $brands->links() }}
                        </div>
                        <!-- End Pagination -->

                    </div> <!-- End Table Responsive -->

                </div> <!-- End Card -->
            </div> <!-- End Col -->

            <div class="col-md-4">

                <div class="card">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                        <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label>Brand Name</label>
                                <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"></label>Brand Image</label>
                                <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                        </form>
                    </div>
                </div> <!-- End Card -->
            </div> <!-- End Col -->

        </div> <!-- End Row -->
    </div> <!-- End Container -->
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Brand</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this row?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="" id="delete_id" class=" btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div> <!-- End Modal -->

<script>
    //Delete function modal
    function handleDelete(id) {
        var a = document.getElementById('delete_id')
        a.href = '/delete/brand/' + id
        $('#deleteModal').modal('show')
    }
</script>
@endsection