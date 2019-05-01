@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Courses</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @foreach($courses as $course )
                        <div>
                            <a href="{{route('course.show',['id'=>$course->id])}}">{{$course->name}}</a> <small>by <strong> {{$course->teacher}} </strong></small>
                            <p>{{$course->description}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
