@extends('layouts.app')


@section('content')


    <div class="row">
        <div class="col-md-12 m-auto">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            @if ($page_type == 'create')
                                <h5 class="">Add Question</h5>
                            @else
                            <h5 class="">Edit Question</h5>
                            @endif
                        </div>
                        <div class="col-md-6 text-end">
                            <a class="btn btn-light" href="{{ route('quiz_question.index') }}"><span class="fa fa-list"></span> All Question</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            @if ($page_type == 'create')
                                <form action="{{ route('quiz_question.store') }}" method="post" enctype="multipart/form-data">
                                @else
                                    <form action="{{ route('quiz_question.update', $question->id) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        <input type="hidden" name="id" value="{{ $question->id }}">
                            @endif
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="title">Title <sup class="text-danger">*</sup></label>
                                {{-- <input type="text" name="title" class="form-control" value="{{ $page_type == 'create' ? old('title') : $question->title }}" id="title"> --}}
                                <textarea name="name" class="form-control" id="elm1" cols="30" rows="10">{{ $page_type == 'edit' ? $question->name : '' }}</textarea>

                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group py-2">
                                <label for="">Quiz</label>
                                <select name="lesson_id" id="lesson_id" class="form-control select2" required>
                                     <option value="">Select Quiz</option>
                                    @foreach ($quiz_list as $model_test)
                                        <option value="{{ $model_test->id }}"  {{ $page_type == 'edit' ? ($model_test->id == $question->lesson_id ? 'selected' : '') : ($request->lesson_id == $model_test->id ? 'selected' : '') }}>{{ $model_test->title }}
                                            ({{ $model_test->course->name??"" }} -{{ $model_test->module->title??"" }}) </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Option
                                        1</label>
                                </div>
                                <input type="text" class="form-control" name="option1"
                                    value="{{ $page_type == 'edit' ? $question->option1 : '' }}"
                                    aria-label="Text input with segmented dropdown button">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" id="radio1" name="correct_answers" value="1" {{ $page_type == 'edit' ?  ($question->correct_answers=="1" ? "checked" : ""):'' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Option
                                        2</label>
                                </div>
                                <input type="text" class="form-control" name="option2"
                                    value="{{ $page_type == 'edit' ? $question->option2 : '' }}"
                                    aria-label="Text input with segmented dropdown button">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" id="radio2" name="correct_answers" value="2" {{ $page_type == 'edit' ?  ($question->correct_answers=="2" ? "checked" : ""):'' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Option
                                        3</label>
                                </div>
                                <input type="text" class="form-control" name="option3"
                                    value="{{ $page_type == 'edit' ? $question->option3 : '' }}"
                                    aria-label="Text input with segmented dropdown button">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" id="radio3" name="correct_answers" value="3" {{ $page_type == 'edit' ?  ($question->correct_answers=="3" ? "checked" : ""):'' }}>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Option
                                        4</label>
                                </div>
                                <input type="text" class="form-control" name="option4"
                                    value="{{ $page_type == 'edit' ? $question->option4 : '' }}"
                                    aria-label="Text input with segmented dropdown button">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="radio" id="radio4" name="correct_answers" value="4" {{ $page_type == 'edit' ?  ($question->correct_answers=="4" ? "checked" : ""):'' }}>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="">Notes</label>
                                <textarea name="notes" id="elm12" class="form-control">{!! $page_type == 'create' ? old('notes') : $question->notes !!}</textarea>
                                @error('notes')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="form-group mt-3 d-block text-center">
                                    <input type="submit" name="submit" value="Save" class="submit-button btn btn-success">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                            {{-- <div class="input-group mb-3">
                                <label for="">Title Image</label> <br>
                                <input type="file" name="title_image" class="form-control" style="opacity: 100">
                                <input type="hidden" id="title_image_old" name="title_image_old"
                                    value="{{ $page_type == 'edit' ? $question->title_image : '' }}">
                                @if (!empty($question->title_image))
                                    <button id="removeButton1" type="button" class="btn btn-danger fa fa-trash"
                                        onclick="remvebtton1()">({{ $page_type == 'edit' ? 1 : '' }}) DeletePrevius
                                        file</button>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <label for="">Option1 Image</label> <br>
                                <input type="file" name="o1_image" class="form-control" style="opacity: 100">
                                <input type="hidden" id="o1_image_old" name="o1_image_old"
                                    value="{{ $page_type == 'edit' ? $question->o1_image : '' }}">
                                @if (!empty($question->o1_image))
                                    <button id="removeButton2" type="button" class="btn btn-danger fa fa-trash"
                                        onclick="remvebtton2()">({{ $page_type == 'edit' ? 1 : '' }}) DeletePrevius
                                        file</button>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <label for="">Option2 Image</label> <br>
                                <input type="file" name="o2_image" class="form-control" style="opacity: 100">
                                <input type="hidden" id="o2_image_old" name="o2_image_old"
                                    value="{{ $page_type == 'edit' ? $question->o2_image : '' }}">
                                @if (!empty($question->o2_image))
                                    <button id="removeButton3" type="button" class="btn btn-danger fa fa-trash"
                                        onclick="remvebtton3()">({{ $page_type == 'edit' ? 1 : '' }}) DeletePrevius
                                        file</button>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <label for="">Option3 Image</label> <br>
                                <input type="file" name="o3_image" class="form-control" style="opacity: 100">
                                <input type="hidden" id="o3_image_old" name="o3_image_old"
                                    value="{{ $page_type == 'edit' ? $question->o3_image : '' }}">
                                @if (!empty($question->o3_image))
                                    <button id="removeButton4" type="button" class="btn btn-danger fa fa-trash"
                                        onclick="remvebtton4()">({{ $page_type == 'edit' ? 1 : '' }}) DeletePrevius
                                        file</button>
                                @endif
                            </div>
                            <div class="input-group mb-3">
                                <label for="">Option4 Image</label> <br>
                                <input type="file" name="o4_image" class="form-control" style="opacity: 100">
                                <input type="hidden" id="o4_image_old" name="o4_image_old"
                                    value="{{ $page_type == 'edit' ? $question->o4_image : '' }}">
                                @if (!empty($question->o4_image))
                                    <button id="removeButton5" type="button" class="btn btn-danger fa fa-trash"
                                        onclick="remvebtton5()">({{ $page_type == 'edit' ? 1 : '' }}) DeletePrevius
                                        file</button>
                                @endif
                            </div> --}}





                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('script')


    <script>
        function remvebtton1() {
            var x = document.getElementById("removeButton1");
            document.getElementById('removeButton1').value = '';
            x.style.display = "none";
        }
        function remvebtton2() {
            var x = document.getElementById("removeButton2");
            document.getElementById('o1_image_old').value = '';
            x.style.display = "none";
        }
        function remvebtton3() {
            var x = document.getElementById("removeButton3");
            document.getElementById('o2_image_old').value = '';
            x.style.display = "none";
        }
        function remvebtton4() {
            var x = document.getElementById("removeButton4");
            document.getElementById('o3_image_old').value = '';
            x.style.display = "none";
        }
        function remvebtton5() {
            var x = document.getElementById("removeButton5");
            document.getElementById('o4_image_old').value = '';
            x.style.display = "none";
        }
    </script>
@endpush
