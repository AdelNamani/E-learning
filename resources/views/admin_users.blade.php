@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection

@section('content')
<div class="box_general padding_bottom">
    <div class="header_box version_2">
        <h2><i class="fa fa-user"></i> Users </h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="Users" class=" table table-striped table-bordered" width="100%">
                <thead class="thead-light">
                <tr>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">E-mail</th>
                    <th scope="col"> is Admin </th>
                    <th scope="col"> is Teacher </th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr id="{{$user->id}}">
                        <td>{{$user->first_name }}</td>
                        <td>{{$user->last_name }}</td>
                        <td>{{$user->email }}</td>

                        <td>
                            <div class="form-check">
                                <input type="checkbox" @if ($user->is_admin)
                                    checked                                    
                                @endif class="form-check-input" onclick="check({{$user->id}} , 'admin' , this)">
                            </div>
                        </td>
                        <td>
                                <div class="form-check">
                                        <input type="checkbox" @if ($user->is_teacher )
                                            checked                                    
                                        @endif class="form-check-input" onclick="check({{$user->id}} ,'teacher' , this)">
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
 $('#Users').DataTable(
    {
        responsive: true,
    }
)
</script>

<script>
const token = '{{csrf_token()}}';
const route = "{{route('admin.check')}}" ;
var set ;
function check(id , type , element) {
            element.checked ? set = 1 : set = 0 ;
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                url: route,
                dataType: 'json',
                data: JSON.stringify({id : id,type : type ,set : set  }),
                beforeSend: function () {
                    $(document.body).css({'cursor': 'wait'});
                },
                success: function () {
                    $(document.body).css({'cursor': 'default'});
                },
                error: function () {
                    alert("Something went wrong!");
                    $(document.body).css({'cursor': 'default'});
                }
            })
        }
</script>
@endsection