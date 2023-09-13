@extends('backend.layout.main')
@section('content-area')

    <div class="d-flex justify-content-end py-3">
        <a href="{{ route('bank.index') }}" class="btn btn-sm btn-dark px-3">Show Records</a>
    </div>
    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th>{{ Str::ucfirst("sno") }}</th>
                <th>{{ Str::ucfirst("name") }}</th>
                <th>{{ Str::ucfirst("branch") }}</th>
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
                        <td>{{ $item->branch }}</td>
                        <td>{{ $item->status == 1 ? "Active" : "Inactive" }}</td>
                        <td>{{ $item->users->name }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('bank.restoreTrashed', $item->bid) }}" class="btn btn-sm btn-success mx-1">Restore</a>
                                <a href="{{ route('bank.forceDeleted', $item->bid) }}" class="btn btn-sm btn-danger mx-1">Permenant Delete</a>
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
    
</div>
@endsection
