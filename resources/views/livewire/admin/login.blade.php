<div>
    <form class="theme-form needs-validation custom-input" wire:submit="login">
        <h3>Sign in to account</h3>
        <p>Enter your email & password to login</p>

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
        <div class="form-group" >
            <label class="col-form-label">Password</label>
            <div class="form-input position-relative">
                <div wire:ignore>
                    <input class="form-control" wire:model="password" type="password" name="password" required="" placeholder="Enter password" oninput="checkPassword(this)">
                </div>
                <div class="text-danger" id="password-error">@error('password') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="form-group mb-0">
            <div class="checkbox p-0">
                <input id="checkbox1" type="checkbox">
{{--                <label class="text-muted" for="checkbox1">Remember password</label>--}}
            </div><a class="link" href="/admin/forgot-password">Forgot password?</a>
            <div class="text-end mt-3">
                <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled" id="submit">Sign in</button>
            </div>
        </div>
    </form>
</div>

<script>
    function checkPassword(t) {
        var passwordError = document.getElementById('password-error');

        let isValid = true;
        // Password validation
        if (!t.value) {
            passwordError.innerText = 'Password is required';
            isValid = false;
        } else if (t.value.length < 6) {
            passwordError.innerText = 'Password must be at least 6 characters long';
            isValid = false;
        } else if (t.value.length > 64) {
            passwordError.innerText = 'The password field must not be greater than 64 characters.';
            isValid = false;
        } else {
            passwordError.innerText = '';
            isValid = true;
        }
        document.getElementById('submit').disabled = !isValid;

        return isValid;
    }
</script>
