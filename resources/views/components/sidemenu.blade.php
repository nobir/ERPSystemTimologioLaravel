@php

$admin_menus = [
    [
        'title' => 'Verify Doctor',
        'path' => 'users/admin/verify-doctor.php',
    ],
    [
        'title' => 'View Users',
        'path' => 'users/admin/view-users.php',
    ],
    [
        'title' => 'Add User',
        'path' => 'users/admin/add-user.php',
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
