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
        <a href="{{ route('bill-of-lading.create') }}" class="btn btn-sm btn-dark px-3 me-2">Create</a>
        <a href="{{ route('bill-of-lading.trashed') }}" class="btn btn-sm btn-danger px-3">Trashed</a>
    </div>
    {{-- <div class="overflow-scroll shadow-lg p-2"> --}}
    <table class="table table-hover" id="myTable">
        <thead>
            {{--
bid
aesl_no
bl_no
shipper_id
consignee
vessel_id
voyage_number
port_of_loading
port_of_discharge
place_of_receipt
place_of_delivery
freight_chr
shipment_date
delivery_date
container_no
gross_weight
pkg_count
user_id
--}}
            <tr>
                <th>{{ Str::ucfirst("aesl no") }}</th>
                <th>{{ Str::ucfirst("idbn no") }}</th>
                <th>{{ Str::ucfirst("bl no") }}</th>
                <th>{{ Str::ucfirst("shipper") }}</th>
                <th>{{ Str::ucfirst("description") }}</th>
                <th>{{ Str::ucfirst("code") }}</th>
                {{-- <th>{{ Str::ucfirst("vessel") }}</th> --}}
                {{-- <th>{{ Str::ucfirst("voyage no") }}</th>
                <th>{{ Str::ucfirst("port of loading") }}</th>
                <th>{{ Str::ucfirst("port of discharge") }}</th>
                <th>{{ Str::ucfirst("place of receipt") }}</th>
                <th>{{ Str::ucfirst("place of delivery") }}</th> --}}
                {{-- <th>{{ Str::ucfirst("freight") }}</th> --}}
                {{-- <th>{{ Str::ucfirst("shipment date") }}</th>
                <th>{{ Str::ucfirst("delivery date") }}</th> --}}
                {{-- <th>{{ Str::ucfirst("container no") }}</th>
                <th>{{ Str::ucfirst("gross weight") }}</th> --}}
                {{-- <th>{{ Str::ucfirst("pkg count") }}</th> --}}
                <th>{{ Str::ucfirst("user") }}</th>
                <th>{{ Str::ucfirst("status") }}</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (count($data) > 0)
                    {{-- @php
                        $sno = 1;
                    @endphp --}}
                    @foreach ($data as $item)
                    <tr>
                        {{-- <td>{{ $sno++ }}</td> --}}
                        <td>{{ $item->aesl_no }}</td>
                        <td>{{ $item->idbn_no }}</td>
                        <td>{{ $item->bl_no }}</td>
                        <td>{{ $item->shipper->name }}</td>
                        <td>{{ $item->shipper->description }}</td>
                        <td>{{ $item->shipper->code }}</td>
                        {{-- <td>{{ $item->consignee }}</td> --}}
                        {{-- <td>{{ $item->shipping_line->name }}</td> --}}
                        {{-- <td>{{ $item->voyage_number }}</td>
                        <td>{{ $item->port_of_loading }}</td>
                        <td>{{ $item->port_of_discharge }}</td>
                        <td>{{ $item->place_of_receipt }}</td>
                        <td>{{ $item->place_of_delivery }}</td> --}}
                        {{-- <td>{{ $item->freight_chr}}</td> --}}
                        {{-- <td>{{ $item->shipment_date}}</td>
                        <td>{{ $item->delivery_date}}</td> --}}
                        {{-- <td>{{ $item->container_no}}</td> --}}
                        {{-- <td>{{ $item->gross_weight}}</td> --}}
                        {{-- <td>{{ $item->pkg_count}}</td> --}}
                        <td>{{ $item->user->name }}</td>
                        <td>{!! $item->status == 1 ? "<span class='btn btn-sm btn-success'>Active</span>" : "<span class='btn btn-sm btn-danger'>Inctive</span>" !!}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('bank.edit', $item->bid) }}" class="btn btn-sm btn-success mx-1">Edit</a>
                                {!! Form::open(['url' => route('bank.trash',$item->bid),'method' => 'delete']) !!}
                                    <input type="submit" value="delete" class="btn btn-sm btn-danger mx-1">
                                {!! Form::close() !!}
                                </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
    </table>
{{-- </div> --}}
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
