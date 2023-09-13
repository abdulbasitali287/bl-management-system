@extends('backend.layout.main')
@section('content-area')
    <div class="conatiner-fluid">
        @if (session('notAdded'))
        <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
            <strong>Failed!</strong> {{ session('notAdded') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


                {{-- {!! Form::open([
                    "url" => "route('bill-of-lading.store')",
                    "method" => "post"
                ]) !!} --}}
                <form action="{{route('bill-of-lading.store')}}" method="post">
                    @csrf
        <div class="row">
            <div class="col-md-4">

                <div class="form-group">
                    {!! Form::label("", "bl no", ["class" => "py-2"]) !!}
                    {!! Form::text("bl_no", null  , ["class" => "form-control"]) !!}
                    @error('bl_no')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label("", "Shipper", ["class" => "py-2"]) !!}
                    <select name="shipper" class="form-control">
                        <option>Select Shipper...</option>
                        @foreach ($shippers as $shippers)
                        <option value="{{$shippers->shipper_id}}" class="py2">{{ $shippers->name }}</option>
                        @endforeach
                        @error('shipper')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </select>
                </div>
                <div class="form-group">
                    {!! Form::label("", "loading port", ["class" => "py-2"]) !!}
                    {!! Form::text("port_of_loading", null  , ["class" => "form-control"]) !!}
                    @error('port_of_loading')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label("", "discharge port", ["class" => "py-2"]) !!}
                    {!! Form::text("port_of_discharge", null  , ["class" => "form-control"]) !!}
                    @error('port_of_discharge')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label("", "freight", ["class" => "py-2"]) !!}
                    {!! Form::number("freight", null  , ["class" => "form-control"]) !!}
                    @error('freight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check form-switch my-3">
                    {!! Form::checkbox("status", true , null , ["class" => "form-check-input", "role" => "switch"  ]) !!}
                    {!! Form::label("", "Status", ["class" => "form-check-label"]) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label("", "arrival date", ["class" => "py-2"]) !!}
                    {!! Form::date("arrival_date", "" , ["class" => "form-control"]) !!}
                    @error('arrival_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label("", "gross weight", ["class" => "py-2"]) !!}
                    {!! Form::number("gross_weight", null  , ["class" => "form-control"]) !!}
                    @error('gross_weight')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label("", "pkg count", ["class" => "py-2"]) !!}
                    {!! Form::number("pkg_count", null  , ["class" => "form-control"]) !!}
                    @error('pkg_count')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group my-3">
                    {!! Form::submit("Add", ["class" => "btn btn-sm btn-primary px-5 py-2"]) !!}
                    <a href="{{ route('bill-of-lading.index') }}" class="btn btn-sm btn-danger px-5 py-2">Back</a>
                </div>
            </div>
        </div>
                </form>
        {{-- {!! Form::close() !!} --}}
    </div>
@endsection
