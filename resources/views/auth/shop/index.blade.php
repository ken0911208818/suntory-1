@extends('layouts/app')
@csrf

@section('content')
    <shop-component data-shop='{!! json_encode($data) !!}'></shop-component>
  {{-- data-shop='{!! json_encode($data) !!}' --}}
@endsection
