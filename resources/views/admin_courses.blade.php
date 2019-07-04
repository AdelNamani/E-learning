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
                    <th scope="col"> State </th>
                    <th scope="col"> Change state </th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr id="{{$course->id}}">
                        <td>{{$course->name }}</td>
                        <td>{{$course->description }}</td>
                        <td>{{$course->user->first_name . ' ' . $course->user->last_name }}</td>
                        <td>{{$course->state }}</td>
                        {{-- <td>{{$course->state }}</td> --}}
                        <td class="dropdown">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Change state
                                </button>
                                <div class="dropdown-menu">
                                        <button class="dropdown-item {{ 'selected' . $course->id }} @if ($course->state == 'waiting for approval')
                                            active
                                        @endif" onclick="change_state({{$course->id}},'waiting for approval' , this)"> Waiting</button>
                                        <button class="dropdown-item {{ 'selected' . $course->id }} @if ($course->state == 'approved')
                                                active
                                            @endif" onclick="change_state({{$course->id}},'approved' , this)"> Approved</button>
                                        <button class="dropdown-item {{ 'selected' . $course->id }} @if ($course->state == 'in creation')
                                                active
                                            @endif" onclick="change_state({{$course->id}},'in creation' , this)"> In creation</button>
                                        <button class="dropdown-item {{ 'selected' . $course->id }} @if ($course->state == 'rejected')
                                                active
                                            @endif" onclick="change_state({{$course->id}},'rejected' , this)"> Rejected</button>
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
);

 function change_state(id,new_state , element) {
     $.ajax({
         headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
         url : "{{route('admin.updateState')}}",
         type : 'POST',
         dataType: 'json',
         data : JSON.stringify({
             id  : id,
             state : new_state
         }),
         beforeSend: function () {
             $(document.body).css({'cursor': 'wait'});
         },
         success: function () {
             $(document.body).css({'cursor': 'default'});
             var items = document.querySelectorAll('.selected' + id) ;
             items.forEach(item => {
                 item.classList.remove('active') ;
             });
             element.classList.add('active');
         },
         error: function () {
             alert("Something went wrong!");
             $(document.body).css({'cursor': 'default'});
         }

     })
 }
</script>

@endsection