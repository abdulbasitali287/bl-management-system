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
        <a href="{{ route('shipping-line.create') }}" class="btn btn-sm btn-dark px-3 me-2">Create</a>
        <a href="{{ route('shipping-line.trashed') }}" class="btn btn-sm btn-danger px-3">Trashed</a>
    </div>
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th>{{ Str::ucfirst("sno") }}</th>
                <th>{{ Str::ucfirst("name") }}</th>
                <th>{{ Str::ucfirst("status") }}</th>
                <th>{{ Str::ucfirst("user") }}</th>
                <th>{{ Str::ucfirst("Actions") }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) > 0)
                    @php
                        $sno = 1;
                    @endphp
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $sno++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->status == 1 ? "Active" : "Inactive" }}</td>
                        <td>{{ $item->users->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('shipping-line.edit', $item->ship_id) }}" class="btn btn-sm btn-success mx-1">Edit</a>
                                {!! Form::open(['url' => route('shipping-line.trash',$item->ship_id),'method' => 'delete']) !!}
                                    <input type="submit" value="delete" class="btn btn-sm btn-danger mx-1">
                                {!! Form::close() !!}
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
        $(document).ready(function () {
            let table = new DataTable('#myTable');
        });
    </script>
</div>
@endsection
