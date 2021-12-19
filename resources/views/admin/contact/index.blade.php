@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">

            <div class="w-100">
                <h4 class="float-left">Contact Page</h4>
                <a class="float-right mb-3" href="{{ route('add.contact') }}">
                    <button class="btn btn-info">Add Contact</button>
                </a>
            </div>

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">All Contact</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL NO</th>
                                    <th scope="col" width="10%">Contact Address</th>
                                    <th scope="col" width="20%">Contact Email</th>
                                    <th scope="col" width="20%">Contact Phone</th>
                                    <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($contacts as $contact)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $contact->address }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->phone }}</td>
                                    <td>
                                        <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-info">Edit</a>
                                        <!-- <a href="{{ url('delete/contact/'.$contact->id) }}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</a> -->
                                        <button class=" btn btn-danger" data-target="#deleteModal" data-toggle="modal" onclick="handleDelete({{ $contact->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Start Pagination -->
                        <div class="float-right mb-3 mr-3">
                            {{ $contacts->links() }}
                        </div>
                        <!-- End Pagination -->

                    </div> <!-- End Table Responsive -->
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Contact</h5>
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
        a.href = '/delete/contact/' + id
        $('#deleteModal').modal('show')
    }
</script>
@endsection