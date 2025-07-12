@if (session()->has('form-success') || session()->has('message'))
    <div class="alert txt-success border-success outline-2x alert-dismissible fade show alert-icons" role="alert">
        <i class="fa fa-check"></i>
        <p>{{ session()->has('form-success') ? session('form-success') : session()->has('message') }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session()->has('form-error') || session()->has('error'))
    <div class="alert txt-danger border-danger outline-2x alert-dismissible fade show alert-icons" role="alert">
        <i class="fa fa-exclamation-triangle"></i>
        <p>{{ session()->has('form-error') ? session('form-error') :  session('error') }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
