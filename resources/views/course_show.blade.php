@extends('layouts.app')

@section('content')
    <p>{{$course->name}}</p>
    <p>{{$course->teacher}}</p>
    <p>{{$course->description}}</p>
    <p>{{$course->updated_at}}</p>

@endsection