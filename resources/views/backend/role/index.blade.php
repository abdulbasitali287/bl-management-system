<div id="viewContainer">


@extends('backend.layout.main')
@section('content-area')
    <div class="container-fluid py-4">
        @if (session('added'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                <strong>Success!</strong> {{ session('added') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('updated'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                <strong>Success!</strong> {{ session('updated') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                <strong>Success!</strong> {{ session('deleted') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-end py-3">
            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-dark px-3 me-2">Create</a>
            <a href="{{ route('roles.trashed') }}" class="btn btn-sm btn-danger px-3">Trashed</a>
            <button class="btn btn-sm btn-danger ms-2" id="delete-records-btn">Bulk Delete</button>
        </div>
        <table class="table table-hover" id="myTable">
            <thead>
                <tr>
                    <th>{{ Str::ucfirst('sno') }}</th>
                    <th>{{ Str::ucfirst('name') }}</th>
                    <th>{{ Str::ucfirst('guard name') }}</th>
                    <th>{{ Str::ucfirst('status') }}</th>
                    <th>{{ Str::ucfirst('user') }}</th>
                    <th>{{ Str::ucfirst('Actions') }}</th>
                    {{-- <th>Bulk Delete</th> --}}
                </tr>
            </thead>
            <tbody>
                @if (count($data) > 0)
                    @php
                        $sno = 1;
                    @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td data-sid="{{ $sno }}">{{ $sno++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->guard_name }}</td>
                            <td>{{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>{{ $item->users->name }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('roles.edit', $item->rid) }}"class="text-success mx-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <i class="fa-solid fa-trash mx-2 pt-1 delete-record" data-record-id="{{ $item->rid }}"></i>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input record-checkbox" type="checkbox"
                                            value="{{ $item->rid }}">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        @if (count($data) < 1)
            <h4 class="display-4 fw-bold text-center p-2">Records are not found...!</h4>
        @endif





        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // function loadView() {
                //     $.ajax({
                //         type: "get",
                //         url: "{{ route('roles.index') }}",
                //         success: function (response) {
                //             console.log(response.roleView.name);
                //             $('#viewContainer').html(response.roleView);
                //         }
                //     });
                // }
                // loadView();

                // delete single record
                $('.delete-record').click(function() {
                    // e.preventDefault();
                    if (confirm("do you really want to delete this record?")) {
                        let rowId = $(this);
                        let del_id = $(this).data('record-id');
                        $.ajax({
                            type: "get",
                            url: "{{ url('roles/trash') }}/" + del_id,
                            success: function(response) {
                                $(rowId).closest('tr').fadeOut('slow');
                            },
                            error: function(error) {
                                if (error.responseJSON && error.responseJSON.errors) {
                                    console.log(error.responseJSON.errors)
                                }
                            }
                        });
                    }
                });

                // delete in bulk
                $('#delete-records-btn').on('click', function() {
                    var selectedIds = [];
                    $('.record-checkbox:checked').each(function() {
                        selectedIds.push($(this).val());
                    });
                    if (selectedIds.length > 0) {
                        if (confirm("do you really want to delete...!")) {
                            deleteRecords(selectedIds);
                        }
                    } else {
                        alert('Please select records to delete.');
                    }
                });

                function deleteRecords(ids) {
                    $.ajax({
                        url: "{{ route('roles.bulkDelete') }}",
                        method: 'DELETE',
                        data: {
                            ids: ids
                        },
                        success: function(response) {
                            alert(response.message);
                            // window.location.reload();
                        },
                        error: function(error) {
                            alert('An error occurred.');
                        }
                    });
                }

            });
        </script>
    </div>
@endsection
</div>
