@php

$admin_menus = [
    [
        'title' => 'Verify Users',
        'path' => route('admin.viewUnverifiedUsers'),
    ],
    [
        'title' => 'View Users',
        'path' => route('admin.viewUsers'),
    ],
    [
        'title' => 'Add User',
        'path' => route('admin.createUser'),
    ],
    [
        'title' => 'Send Email Verification Link',
        'path' => route('admin.sendEmailVerifyLink'),
    ],
];
$manager_menus = [];
$employee_menus = [];
$receptionist_menus = [];
@endphp

<div class="animate-100 d-md-block list-group mb-3">
    @if (Session::has('user') && Session::get('user')->type == 1)
        @foreach ($admin_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @elseif (Session::has('user') && Session::get('user')->type == 2)
        @foreach ($manager_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @elseif (Session::has('user') && Session::get('user')->type == 3)
        @foreach ($employee_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @elseif (Session::has('user') && Session::get('user')->type == 4)
        @foreach ($receptionist_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @endif
</div>
