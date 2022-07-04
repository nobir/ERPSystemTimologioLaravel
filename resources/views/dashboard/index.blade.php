@php
    $page_title = "Dashboard";
@endphp

@extends('layouts.dashboard')

@section('contents')

<p>Welcome {{ Session::get('name') }}</p>

@endsection
