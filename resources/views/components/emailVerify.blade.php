<main>
    <h1 class="text-center">Email Verify</h1>
    <hr>

    <div>
        <div>
            <h3>Verify Your Email Address</h3>

            <div>
                <a href="{{ route('home.emailVerify', ['user_id' => $e_user_id, 'code' => $e_code]) }}">Verify Your Email</a>
            </div>
        </div>
    </div>
</main>

<footer>
    <p>
        <span>
            {{ date('Y') }} &copy; Copyright by <strong><a href="{{ route('home.index') }}">Timologio</a> Develop by <strong><a href="{{ route('home.about') }}">Group 08</a></strong>
        </span>
    </p>
</footer>
