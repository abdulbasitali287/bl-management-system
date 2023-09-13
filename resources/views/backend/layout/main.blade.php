@include('backend.layout.header')
@include('backend.layout.sidebar')
        <div id="main-content">
            @include('backend.layout.navbar')
            <main class="px-3">
                @yield('content-area')
            </main>
            <footer class="bg-light shadow-lg py-2 w-100">
                <p class="pt-2 text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo, recusandae!</p>
            </footer>
        </div>
@include('backend.layout.footer')
