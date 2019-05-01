@extends('layouts.app')

@section('content')
    <p>{{$lesson->name}}</p>
    <p>{{$lesson->description}}</p>
    @if(!$lesson->users->contains(Auth::user()))
        <a href="{{route('lesson.complete' , ['id'=>$lesson->id])}}">I've completed this lesson</a>
    @else
        You've already completed that lesson
    @endif
    <a href="#">Previous Lesson</a><<<>>><a href="#">Next Lesson</a>
@endsection