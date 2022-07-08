<main>
    <h1>Email Verify</h1>
    <hr>

    <div>
        <div>
            <h3>Verify Your Email Address</h3>

            <div>
                <a href="{{ route('home.emailVerify', ['user_id' => $e_user_id, 'code' => $e_code]) }}">Verify Your
                    Email</a>
            </div>
            <p>
                Your Password is: <strong>{{ $e_code }}</strong><br>
                <strong>Note: </strong>Please make sure to change your password after login.
            </p>
        </div>
    </div>
</main>
<footer>
    <p>
        <span>
            {{ date('Y') }} &copy; Copyright by <strong><a href="{{ route('home.index') }}">Timologio</a>
                Develop by <strong><a href="{{ route('home.about') }}">Group 08</a></strong>
        </span>
    </p>
</footer>
