@extends('layouts.admin')

@section('content')
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Course Details</h2>
        </div>
        @foreach ($chapters as $chapter)
        <h6>Chapter Name :</h6>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-10">
                                    <input class="form-control" type="text" value="{{$chapter->name}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <h6>Chapter Lessons :</h6>
                <div class="row">
                    <div class="col-md-12">
                        <table id="pricing-list-container" style="width:100%;">
                                <tr class="pricing-list-item">
                                    <td>
                                        @foreach ($chapter->lessons as $lesson)
                                        <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input value="{{$lesson->name}}" type="text" class="form-control" placeholder="Video title">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="{{$lesson->viedo}}"  type="text" class="form-control"  placeholder="Video URL">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Video title">
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control"  placeholder="Video URL">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        </table>
                        <a href="#0" class="btn_1 gray add-pricing-list-item"><i class="fa fa-fw fa-plus-circle"></i>Add Lesson</a>
                        </div>
                </div>
                <hr>
       @endforeach
    </div>
    <button type="submit" class="btn_1 medium">Save</button>
    @endsection
