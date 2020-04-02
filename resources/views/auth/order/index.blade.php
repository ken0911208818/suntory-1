@extends('layouts/app')
@csrf

@section('content')
<order-component data-all="{{$data}}"></order-component>
@endsection
