@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-file"></i> Courses </h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="Courses" class=" table table-striped table-bordered" width="100%">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Course Name</th>
                    <th scope="col">Description</th>
                    <th scope="col"> Author </th>
                    <th scope="col">  State </th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr id="{{$course->id}}">
                        <td>{{$course->name }}</td>
                        <td>{{$course->description }}</td>
                        <td>{{$course->user->first_name . ' ' . $course->user->last_name }}</td>
                        {{-- <td>{{$course->state }}</td> --}}
                        <td class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Change state 
                                </button>
                                <div class="dropdown-menu">
                                        <a class="dropdown-item @if ($course->state == 'waiting for approval')
                                            active
                                        @endif" href="#"> Waiting</a>
                                        <a class="dropdown-item @if ($course->state == 'approved')
                                                active
                                            @endif" href="#"> Approved</a>
                                        <a class="dropdown-item @if ($course->state == 'in creation')
                                                active
                                            @endif" href="#"> In creation</a>
                                        <a class="dropdown-item @if ($course->state == 'rejected')
                                                active
                                            @endif" href="#"> Rejected</a>
                                </div>
                            </td>
                    </tr>

                @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
 <!-- DataTable Semantic UI -->
 <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js "></script>
 <script>
 $('#Courses').DataTable(
    {
        responsive: true,
    }
)
</script>

@endsection