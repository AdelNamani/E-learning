@extends('layouts.admin')

@section('content')
    <div class="box_general padding_bottom">
        <div class="header_box version_2">
            <h2><i class="fa fa-file"></i>{{$chapter->name}} lessons</h2>
        </div>
        <div id="app" class="row">
            <div class="col-md-12">
                            <div v-for="(lesson,index) in lessons" class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <p v-text="lesson.name"></p>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <a target="_blank" v-bind:href="lesson.video" v-text="lesson.video"></a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                                <a v-on:click="delete_lesson(index)" class="btn_1 gray delete" style="display : inline ;" ><i
                                                    class=" indicator fa fa-trash"></i> Delete </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input v-model="new_lesson_name" type="text" class="form-control"
                                               placeholder="Lesson title">
                                        <span class="text-danger small" role="alert">
                                            <strong v-text="name_error"></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input v-model="new_lesson_video" type="text" class="form-control"
                                               placeholder="Video URL">
                                        <span class="text-danger small" role="alert">
                                            <strong v-text="video_error"></strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                <a v-on:click="add_lesson()" class="btn_1 gray add-pricing-list-item"><i
                            class="fa fa-fw fa-plus-circle"></i>Add Lesson</a>
            </div>
        </div>
    </div>
    <a href="{{route('course.chapters',['id'=>$chapter->course->id])}}" class="btn_1 medium">Go back to chapter</a>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data: {
                new_lesson_name: '',
                new_lesson_video: '',
                name_error : '',
                video_error : '',
                lessons: [
                        @foreach($chapter->lessons as $lesson)
                    {
                        id: {{$lesson->id}},
                        name: '{{$lesson->name}}',
                        video: '{{$lesson->video}}',
                        chapter_id: {{$lesson->chapter_id}}
                    },
                    @endforeach
                ]
            },
            methods: {
                add_lesson: function () {
                    this.name_error = '';
                    this.video_error = '';
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        type: 'POST',
                        url: '{{route('lesson.store')}}',
                        data: {
                            name: this.new_lesson_name,
                            video: this.new_lesson_video,
                            chapter_id: {{$chapter->id}}
                        }

                    }).done(function (data) {
                        app.push_lesson(data);
                        app.new_lesson_name = '';
                        app.new_lesson_video = '';
                    }).fail(function (data) {
                        app.name_error = data.responseJSON.errors.name ? data.responseJSON.errors.name[0] : null ;
                        app.video_error = data.responseJSON.errors.video ? data.responseJSON.errors.video[0] : null ;
                    })
                },

                push_lesson: function (id) {
                    this.lessons.push({
                        id: id,
                        name: this.new_lesson_name,
                        video: this.new_lesson_video,
                        chapter_id: {{$chapter->id}}
                    })
                },

                delete_lesson : function(index){
                    let id = this.lessons[index].id;
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                        type : 'POST',
                        url : '{{route('lesson.destroy')}}',
                        data : {
                            id : id,
                        }
                    }).done(function (data) {
                        app.lessons.splice(index,1);
                    }).fail(function (data) {
                        console.log('error');
                    })
                }
            }
        })
    </script>

@endsection