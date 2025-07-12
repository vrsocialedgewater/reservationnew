<div>
    @if(@$success)
        <h2 class="text-success">Congratulation!</h2>
        <br/>
        <h3>A password reset link has been sent to your email.</h3>

    @else
        <form class="theme-form needs-validation custom-input" wire:submit="forgot">
            <h3>Forgot Password</h3>
            <p>Enter your email and recover your account</p>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <div wire:ignore>
                    <input class="form-control" wire:model="email" type="email" required="" placeholder="Enter your email">
                </div>
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group mb-0">
                <div class="text-end mt-3">
                    <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled">Submit</button>
                </div>
            </div>
        </form>
    @endif
        <br/>
        Back to <a class="link text-info" href="/admin/login">Login</a>
</div>
