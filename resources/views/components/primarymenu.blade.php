@php

$login_primary_menus = [
    [
        'title' => 'Dashboard',
        'path' => route('dashboard.index'),
    ],
    [
        'title' => 'View Profile',
        'path' => route('dashboard.profile'),
    ],
    [
        'title' => 'Edit Profile',
        'path' => route('dashboard.profileEdit'),
    ],
    [
        'title' => 'Profile Picture',
        'path' => route('dashboard.profilePicture'),
    ],
    [
        'title' => 'Change Password',
        'path' => '',
    ],
    [
        'title' => 'Logout',
        'path' => route('home.logout'),
    ],
];

$non_login_primary_menus = [
    [
        'title' => 'Home',
        'path' => route('home.index'),
    ],
    [
        'title' => 'About',
        'path' => route('home.about'),
    ],
    [
        'title' => 'Login',
        'path' => route('home.login'),
    ],
];

@endphp

<ul class="nav d-flex flex-column w-100 h-100 {{ Session::has('loggedin') ? 'flex-lg-row justify-content-lg-end align-items-lg-center' : 'flex-md-row justify-content-md-end align-items-md-center' }}">
    @if (Session::has('loggedin'))
        @foreach ($login_primary_menus as $menu)
            <li class="list-group m-1">
                <a class="nav-link list-group-item text-dark rounded" href="{{ $menu['path'] }}">{{ $menu['title'] }}</a>
            </li>
        @endforeach
    @else
        @foreach ($non_login_primary_menus as $menu)
            <li class="list-group m-1">
                <a class="nav-link list-group-item text-dark rounded" href="{{ $menu['path'] }}">{{ $menu['title'] }}</a>
            </li>
        @endforeach
    @endif
</ul>
