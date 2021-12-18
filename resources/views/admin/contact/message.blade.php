@extends('admin.admin_master')

@section('admin')
<div class="py-12">
    <div class="container">
        <div class="row">

            <div class="w-100">
                <h4 class="float-left">Contact Message Page</h4>
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

                    <div class="card-header">All Contact Message</div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">SL NO</th>
                                    <th scope="col" width="10%">Name</th>
                                    <th scope="col" width="10%">Email</th>
                                    <th scope="col" width="10%">Subject</th>
                                    <th scope="col" width="10%">Message</th>
                                    <th scope="col" width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 1)
                                @foreach($contact_forms as $contact_form)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $contact_form->name }}</td>
                                    <td>{{ $contact_form->email }}</td>
                                    <td>{{ $contact_form->subject }}</td>
                                    <td>{{ $contact_form->message }}</td>
                                    <td>
                                        <button class=" btn btn-danger" data-target="#deleteModal" data-toggle="modal" onclick="handleDelete({{ $contact_form->id }})">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Start Pagination -->
                        <div class="float-right mb-3 mr-3">
                            {{ $contact_forms->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Delete Contact Form</h5>
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
        a.href = '/delete/contactform/' + id
        $('#deleteModal').modal('show')
    }
</script>
@endsection