@extends('layouts.app')

@section('content')
    <p>First name : {{$user->first_name}}</p>
    <p>Last name : {{$user->last_name}}</p>
    <p>Email : {{$user->email}}</p>

@endsection