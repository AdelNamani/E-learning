@extends('layouts.admin')

@section('content')
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>Chapter lessons</h2>
        </div>        
                <div class="row">
                    <div class="col-md-12">
                        <table id="pricing-list-container" style="width:100%;">
                                <tr class="pricing-list-item">
                                    <td>
                                        @foreach ($lessons as $lesson)
                                        <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input value="{{$lesson->name}}" type="text" class="form-control" placeholder="Lesson title">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <input value="{{$lesson->viedo}}"  type="text" class="form-control"  placeholder="Video URL">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                        </table>
                        <a href="#0" class="btn_1 gray add-pricing-list-item"><i class="fa fa-fw fa-plus-circle"></i>Add Lesson</a>
                        </div>
                </div>
    </div>
    <button type="submit" class="btn_1 medium">Save</button>
    @endsection
