@extends('layouts.app')

@section('content')
    <p>{{$course->name}}</p>
    <p>{{$course->teacher}}</p>
    <p>{{$course->description}}</p>
    <p>{{$course->updated_at}}</p>

    <ul>
        @foreach($course->chapters as $chapter)
            <li> {{$chapter->name}} </li>
            <ul>
                @foreach($chapter->lessons as $lesson)
                        <li><a href="{{ route('lesson.show',['id' => $lesson->id]) }}">{{$lesson->name}}</a></li>
                @endforeach
            </ul>
        @endforeach
    </ul>

    <a href="{{route('lesson.show', ['id' => $course->chapters[0]->lessons[0]])}}">Start the course</a>

@endsection