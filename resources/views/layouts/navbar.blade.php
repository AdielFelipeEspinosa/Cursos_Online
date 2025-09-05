<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">

    </div>
</div>

{{-- Mensajes de éxito o error simples --}}
@if(session('success') || session('error'))
    <div class="toast-container position-fixed" style="top: 20%; left: 50%; transform: translateX(-50%); z-index: 1055;">
        <div class="toast align-items-center {{ session('success') ? 'bg-success' : 'bg-danger' }} text-white border-0"
             role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') ?? session('error') }}
                </div>
                <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif

{{-- Errores de validación o withErrors --}}
@if($errors->any())
    <div class="toast-container position-fixed" style="top: 30%; left: 50%; transform: translateX(-50%); z-index: 1055;">
        @foreach($errors->all() as $error)
            <div class="toast align-items-center bg-danger text-white border-0 mb-2"
                 role="alert" aria-live="assertive" aria-atomic="true" data-delay="8000">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ $error }}
                    </div>
                    <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
@endif

<!-- Navbar End -->