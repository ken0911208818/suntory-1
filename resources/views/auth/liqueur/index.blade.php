@extends('layouts/app')
@csrf

@section('content')
<liqueur-main data-all='{!! json_encode($data) !!}'></liqueur-main>
@endsection
