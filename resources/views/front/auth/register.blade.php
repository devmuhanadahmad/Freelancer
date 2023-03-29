<x-front>



    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
                        </div>
                        <form class="row" method="post" action="{{ route('auth.register') }}">
                            @csrf
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">Name</label>
                                    <x-form.input id="reg-fn" name="name" required />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">E-mail Address</label>
                                    <x-form.input type="email" id="reg-email" name="email" required />
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Password</label>
                                    <x-form.input type="password" id="reg-pass" name="password" required />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <x-form.input type="password" id="reg-pass-confirm" name="password_confirmation" required />
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Register</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="{{ route('auth.login.form') }}">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->
</x-front>
