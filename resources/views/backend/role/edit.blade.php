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
                    'id' => 'updateForm'
                ]) !!}
                <div class="form-group my-3">
                    {!! Form::label("", "Role Name", ["class" => "py-2"]) !!}
                    {!! Form::text("role_name", old('role_name',$update->name), ["class" => "form-control"]) !!}
                        <span class="text-danger" id="role_name"></span>
                </div>
                <div class="form-group my-3">
                    {!! Form::label("", "Guard Name", ["class" => "py-2"]) !!}
                    {!! Form::text("guard_name", old('guard_name',$update->guard_name), ["class" => "form-control"]) !!}
                        <span class="text-danger" id="guard_name"></span>
                </div>
                <div class="form-check form-switch my-3">
                    {!! Form::checkbox("status", true , $update->status , ["class" => "form-check-input", "role" => "switch"  ]) !!}
                    {!! Form::label("", "Status", ["class" => "form-check-label"]) !!}
                </div>
                <div class="form-group my-2">
                    {!! Form::submit("Update", ["class" => "btn btn-success px-2"]) !!}
                    <a href="{{ route('roles.index') }}" class="text-decoration-none btn btn-sm btn-primary mx-2 px-2">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#updateForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "put",
                    url: "{{ route('roles.update', Js::from($update->rid)) }}",
                    data: $('#updateForm').serialize(),
                    success: function (response) {
                        alert(response.message);
                        $('#updateForm').trigger('reset');
                        $('#role_name').text('');
                    },
                    error : function(error){
                        if (error.responseJSON && error.responseJSON.errors) {
                            var errors = error.responseJSON.errors;
                            $.each(errors, function(key, value) {
                                $('#' + key).text(value[0]);
                            });
                        }
                    }
                });
            });
        });
    </script>
</div>
@endsection
