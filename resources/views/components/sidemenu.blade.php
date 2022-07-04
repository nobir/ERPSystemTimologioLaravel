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
    @if (Session::has('type') && Session::get('type') == 'admin')
        @foreach ($admin_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @elseif (Session::has('type') && Session::get('type') == 'manager')
        @foreach ($manager_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @elseif (Session::has('type') && Session::get('type') == 'employee')
        @foreach ($employee_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @elseif (Session::has('type') && Session::get('type') == 'receptionist')
        @foreach ($receptionist_menus as $menu)
            <a href="{{ $menu['path'] }}" class="list-group-item list-group-item-action">{{ $menu['title'] }}</a>
        @endforeach
    @endif
</div>
