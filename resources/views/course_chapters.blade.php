
@extends('layouts.admin')

@section('content')
<div class="box_general">
        <div class="header_box">
        <h2 class="d-inline-block">Course chapters </h2>
        </div>
        <div class="list_general">
            <ul>
                @foreach ($chapters as $chapter)        
                <li>
                    {{-- <figure><img src="img/course_1.jpg" alt=""></figure> --}}
                    <h4> {{$chapter->name }} 
                        {{-- <i class="pending">Pending</i> --}}
                    </h4>
                    <ul class="buttons">
                    <li><a href="{{route('chapter.quizCreate' , ['id' => $chapter->id ] )}}" class="btn_1 gray"><i class="fa fa-info-circle"></i> Quiz </a></li>
                    <li><a href="{{route('chapter.lessons' , ['id' => $chapter->id ] )}}" class="btn_1 gray"><i class="fa fa-info-circle"></i> Lessons </a></li>
                        {{-- <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancel</a></li> --}}
                    </ul>
                </li>
                @endforeach
            </ul>
        </div>
</div>
<form action="" method="post">
    <div class="box_general">
            <div class="header_box">
                    <h2 class="d-inline-block">Add new chapter </h2>
            </div>
                    <div class="list_general">
                                    <div class="row">
                                        <div class="col-lg-4">
                                                <div class="form-group">
                                                        <input class="form-control" type="text" name="" id="" placeholder="chapter name">
                                                </div>
                                        </div>
                                        <div class="col-lg-4">
                                                <div class="form-group">
                                                        <input type="file" name="" id="" >
                                                </div>
                                        </div>
                                    </div>
                    </div>
    </div>
    <button  class="btn_1 medium"><i class="fa fa-fw fa-plus-circle"></i>Add Chapter</button>
</form>

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