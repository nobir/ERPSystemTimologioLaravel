@php
$page_title = 'About';
$teams = [
    [
        'name' => 'Nobir Hossain Samuel',
        'id' => '19-41135-2',
    ],
    [
        'name' => 'Nahian Sajjad',
        'id' => '19-41154-2',
    ],
    [
        'name' => 'Jannatul Nayeem Kabir',
        'id' => '18-37796-2',
    ],
    [
        'name' => 'Md. Tarequl Islam',
        'id' => '18-37816-2',
    ],
];
@endphp

@extends('layouts.main')

@section('contents')
    <div class="table-responsive w-100">
        <table class="table table-success table-striped min-width-400px">
            <thead class="table-dark">
                <tr>
                    <th>Name (AIUB style)</th>
                    <th>ID (AIUB)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teams as $team)
                    <tr>
                        <td>{{ $team['name'] }}</td>
                        <td>{{ $team['id'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
