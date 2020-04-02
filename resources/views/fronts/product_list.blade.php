@extends('layouts/nav')
@csrf

@section('css')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')
<checkout-area></checkout-area>
@endsection


@section('js')
<script src="{{ asset('js/app.js') }}"></script>
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endsection
