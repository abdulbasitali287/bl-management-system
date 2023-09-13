<header id="header" class="py-3 shadow-sm sticky-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <i class="fa-solid fa-bars fs-3 ms-3" id="toggleBtn"></i>
            </div>
            <div class="col-lg-8">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h4 class="fw-bold fs-2 d-inline-block px-4">بسمہ اللہ الرحمن الرحیم</h4>
                    </div>
                    <div class="d-flex">
                        <p class="py-1 px-2">{{ Str::ucfirst(Auth::user()->name) }}</p>
                        {!! Form::open(["url" => route('logout')]) !!}
                            <input type="submit" class="btn btn-sm fw-bold" value="Logout">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
