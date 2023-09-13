@extends('backend.layout.main')
@section('content-area')
<div class="container-fluid">
    @if (session('notAdded'))
        <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
            <strong>Failed!</strong> {{ session('notAdded') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('notUpdated'))
        <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
            <strong>Failed!</strong> {{ session('notUpdated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6">
                {!! Form::open([
                    'url' => route('shipper.update',$update->shipper_id),
                    'method' => 'put'
                ]) !!}
                <div class="form-group my-3">
                    {!! Form::label("", "Shipper Name", ["class" => "py-2"]) !!}
                    {!! Form::text("name", old('name',$update->name), ["class" => "form-control"]) !!}
                    @error("name")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    {!! Form::label("", "Description", ["class" => "py-2"]) !!}
                    {!! Form::text("description", old('description',$update->description) , ["class" => "form-control"]) !!}
                    @error("description")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group my-3">
                    {!! Form::label("", "Code", ["class" => "py-2"]) !!}
                    {!! Form::text("code", old('code',$update->code) , ["class" => "form-control"]) !!}
                    @error("code")
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-check form-switch my-3">
                    {!! Form::checkbox("status", true , $update->status , ["class" => "form-check-input", "role" => "switch"  ]) !!}
                    {!! Form::label("", "Status", ["class" => "form-check-label"]) !!}
                </div>
                <div class="form-group my-2">
                    {!! Form::submit("Update", ["class" => "btn btn-success px-2"]) !!}
                    <a href="{{ route('shipper.index') }}" class="text-decoration-none btn btn-sm btn-primary mx-2 px-2">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
