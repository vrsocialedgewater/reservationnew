<div>
    @if(@$success)
        <h2 class="text-success">Congratulation!</h2>
        <br/>
        <h3>Your password has been reset!</h3>
        <br/>
        Back to <a class="link text-info" href="/admin/login">Login</a>
    @else
        <form class="theme-form needs-validation custom-input" wire:submit="resetPassword">
            <h3>Reset your password</h3>

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
                <div wire:ignore>
                    <input type="hidden" name="token" wire:model="token" />
                </div>
                <div class="text-danger" id="password-error">@error('token') {{ $message }} @enderror</div>
            </div>
            <div class="form-group">
                <label class="col-form-label">Email Address</label>
                <div wire:ignore>
                    <input class="form-control" wire:model="email" type="email" required="" disabled="" name="email" placeholder="Enter your email">
                </div>
            </div>
            <div class="form-group" >
                <label class="col-form-label">Password</label>
                <div class="form-input position-relative">
                    <div wire:ignore>
                        <input class="form-control" wire:model="password" type="password" name="password" id="password" required="" placeholder="Enter password" oninput="checkPassword(this)">
                    </div>
                    <div class="text-danger" id="password-error">@error('password') {{ $message }} @enderror</div>
                </div>
            </div>
            <div class="form-group" >
                <label class="col-form-label">Password Confirmation</label>
                <div class="form-input position-relative">
                    <div wire:ignore>
                        <input class="form-control" wire:model="password_confirmation" type="password" name="password_confirmation" id="password_confirmation" required="" placeholder="Password confirmation" oninput="checkConfirmPassword(this)">
                    </div>
                    <div class="text-danger" id="password_confirmation-error">@error('password_confirmation') {{ $message }} @enderror</div>
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="text-end mt-3">
                    <button class="btn btn-primary btn-block w-100" type="submit" wire:loading.attr="disabled" id="submit">Submit</button>
                </div>
            </div>
        </form>
        <br/>
        Back to <a class="link text-info" href="/admin/login">Login</a>
    @endif
</div>

<script>

    function checkPassword(t) {
        var passwordError = document.getElementById('password-error');
        var confirmPassword = document.getElementById('password_confirmation');


        let isValid = true;

        // Password validation
        if (t.value.length < 6) {
            passwordError.innerText = 'Password must be at least 6 characters long';
            isValid = false;
        } else if (t.value.length > 64) {
            passwordError.innerText = 'The password field must not be greater than 64 characters.';
            isValid = false;
        } else if (t.value !== confirmPassword.value) {
            passwordError.innerText = '';
            isValid = false;
        } else {
            isValid = true;
            passwordError.innerText = '';
        }

        document.getElementById('submit').disabled = !isValid;

        return isValid;
    }
    function checkConfirmPassword(t) {

        var passwordError = document.getElementById('password_confirmation-error');
        var password = document.getElementById('password');


        let isValid = true;

        // Password validation
         if (t.value !== password.value) {
            passwordError.innerText = 'The password field confirmation does not match.';
            isValid = false;
        } else if (t.value.length < 6 && t.value.length > 64) {
            isValid = false;
            passwordError.innerText = ''
        } else {
             isValid = true;
             passwordError.innerText = '';
        }
         console.log(isValid);

        document.getElementById('submit').disabled = !isValid;


        return isValid;
    }
</script>
