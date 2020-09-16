@extends('layouts.app')

@section('content')
    <div id="body">
        <private-room :room="{{$privateRoom}}"></private-room>
    </div>
@endsection