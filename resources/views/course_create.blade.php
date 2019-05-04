@extends('layouts.admin')

@section('content')

    {{--
        <button  >Submit</button>
     --}}

    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Course info</h2>
        </div>
        <form enctype="multipart/form-data" action='{{route("course.store")}}' method="POST">
            @csrf
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Course title</label>
                        <input type="text" name="name" class="form-control" placeholder="Course title">
                        @error('name')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Course description</label>
                        <textarea name="description" rows="5" class="form-control" style="height:100px;"
                                  placeholder="Description"></textarea>
                        @error('description')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <label>Course Picture</label>
                        <br>
                        <input type="file" name="photo">
                        @error('photo')
                        <span class="text-danger small" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- /row-->
    </div>
    <!-- /box_general-->
    <p>
        <button type="submit" class="btn_1 medium">Save</button>
    </p>
    </form>
@endsection
