@php
    $page_title = "Dashboard";
@endphp

@extends('layouts.main')

@section('contents')

<h1>Welcome {{ Session::get('user')->name }}</h1>

@endsection
