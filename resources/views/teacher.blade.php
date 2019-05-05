
@extends('layouts.admin')

@section('content')
<div class="box_general">
        <div class="header_box">
            <h2 class="d-inline-block">Your Courses</h2>
            {{-- <div class="filter">
                <select name="orderby" class="selectbox">
                    <option value="Any status">Any status</option>
                    <option value="Approved">Started</option>
                    <option value="Pending">Pending</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
            </div> --}}
        </div>
        <div class="list_general">
            <ul>
                @foreach ($courses as $course)        
                <li>
                    {{-- <figure><img src="img/course_1.jpg" alt=""></figure> --}}
                    <h4> {{$course->name }} 
                        {{-- <i class="pending">Pending</i> --}}
                    </h4>
                    {{-- <ul class="course_list">
                        <li><strong>Start date</strong> 11 November 2017</li>
                        <li><strong>Expire date</strong> 11 April 2018</li>
                        <li><strong>Category</strong> Science, Economy</li>
                        <li><strong>Teacher</strong> Mark Twain</li>
                    </ul> --}}
                    <h6>Course description</h6> 
                <p> {{ $course->description }}</p>
                    <ul class="buttons">
                    <li><a href="{{route('course.edit' , ['id' => $course->id ] )}}" class="btn_1 gray approve"><i class="fa fa-edit"></i> Edit</a></li>
                    <li><a href="{{route('course.delete' , ['id' => $course->id ] )}}" class="btn_1 gray delete"><i class="fa fa-trash"></i> Delete</a></li>
                        {{-- <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li> --}}
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- /box_general-->
    {{-- <nav aria-label="...">
        <ul class="pagination pagination-sm add_bottom_30">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav> --}}
@endsection
