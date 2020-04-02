@extends('layouts/app')
@csrf

@section('css')
<link href="{{ asset('css/checkout.css') }}" rel="stylesheet">
@endsection


@section('content')
<order-finish order-message='{{ $message }}' finish-order='{{ $new_order }}'></order-finish>

@endsection


@section('js')
{{-- sweetalert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


@endsection
