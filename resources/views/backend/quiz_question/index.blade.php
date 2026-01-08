@extends('layouts.app')

@section('page_title')
    Question
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>All Question List</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <!-- Button trigger modal -->
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_question">
                                Add Question
                            </button> --}}
                            <a href="{{ route('quiz_question.create') }} " class="btn btn-light"><span
                                class="fa fa-plus-circle me-1"></span>Add Question</a>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#add_question2">
                                Excel Import
                            </button>
                        </div>
                    </div>
                    <!-- Modal -->

                    <div class="modal fade" style="white-space: normal" id="add_question" tabindex="-1" role="dialog"
                        aria-labelledby="new" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content text-left">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Question </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('quiz_question.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Question Title</label>
                                            <textarea name="name" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Quiz Name</label>
                                            <select class="form-control" name="lesson_id" id="lesson_id">
                                                <option selected value="" disabled>--Select Quiz--</option>
                                                @foreach ($quiz_list as $quiz)
                                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Mark</label>
                                            <input type="number" value="1" class="form-control" name="mark">
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Option
                                                    1</label>
                                            </div>
                                            <input type="text" class="form-control" name="option1"
                                                aria-label="Text input with segmented dropdown button">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" id="radio1" name="correct_answers"
                                                        value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Option
                                                    2</label>
                                            </div>
                                            <input type="text" class="form-control" name="option2"
                                                aria-label="Text input with segmented dropdown button">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" id="radio2" name="correct_answers"
                                                        value="2">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Option
                                                    3</label>
                                            </div>
                                            <input type="text" class="form-control" name="option3"
                                                aria-label="Text input with segmented dropdown button">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" id="radio3" name="correct_answers"
                                                        value="3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Option
                                                    4</label>
                                            </div>
                                            <input type="text" class="form-control" name="option4"
                                                aria-label="Text input with segmented dropdown button">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" id="radio4" name="correct_answers"
                                                        value="4">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nodes</label>

                                            <textarea name="nodes" class="form-control" id="" cols="30" rows="10"></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary mr-2"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add
                                            Question</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" style="white-space: normal" id="add_question2" tabindex="-1"
                        role="dialog" aria-labelledby="new" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content text-left">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Question </h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('import_question') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="">Quiz Name</label>
                                            <select class="form-control" name="lesson_id" id="lesson_id" required>
                                                <option selected value="" disabled>--Select Quiz--</option>
                                                @foreach ($quiz_list as $quiz)
                                                    <option value="{{ $quiz->id }}">{{ $quiz->title }}
                                                        ({{ $quiz->course->name??"" }} -{{ $quiz->module->title?? '' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group d-none">
                                            <label for="">Mark</label>
                                            <input type="hidden" value="1" class="form-control" name="mark">
                                        </div>
                                        <div class="form-group">
                                            <label for=""> Download Format : <a
                                                    href="{{ asset('Question.xlsx') }}">Excel File</a></label>
                                        </div>

                                        <div class="form-group">
                                            <label for="">Excel Import File</label>
                                            <input type="file" class="form-control" name="quiz_question"
                                                accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary mr-2"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Add
                                            Question</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('quiz_question.index') }}" method="get" id="search_form"></form>
                    <div class="row mb-2">
                        <div class="col-md-2 mb-2">
                            <input type="text" value="{{ $request->name }}" name="name" placeholder="Name"
                                    form="search_form" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <select name="lesson_id" id="" form="search_form" class="form-control">
                                <option value="">Select Qiuz</option>
                                @foreach ($quiz_list as $quiz)
                                    <option {{ $request->lesson_id == $quiz->id ? 'selected' : '' }}
                                        value="{{ $quiz->id }}">{{ $quiz->title }}
                                        ({{ $quiz->course->name??"" }} -{{ $quiz->module->title?? '' }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="text" value="{{ $request->option1 }}" name="option1"
                                    placeholder="Option 1" form="search_form" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="text" value="{{ $request->option2 }}" name="option2"
                            placeholder="Option 2" form="search_form" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="text" value="{{ $request->option3 }}" name="option3"
                            placeholder="Option 3" form="search_form" class="form-control">
                        </div>
                        <div class="col-md-2 mb-2">
                            <input type="text" value="{{ $request->option4 }}" name="option4"
                            placeholder="Option 4" form="search_form" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <button class="btn btn-outline-dark" form="search_form" type="submit">Search</button>
                            <a href="{{ route('quiz_question.index') }}" class="btn btn-outline-danger ms-1">Reset</a>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered dt-responsive nowrap text-center" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr class="main_title">
                                <th width="12%">Question</th>
                                <th width="20%">Quiz Name</th>
                                <th width="5%">Order</th>
                                <th width="10%">Option 1</th>
                                <th width="10%">Option 2</th>
                                <th width="10%">Option 3</th>
                                <th width="10%">Option 4</th>
                                <th width="3%">Answer</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        @forelse($questions as $question)
                            <tr>
                                <td>{!! stripslashes($question->name) !!}</td>
                                <td>{{ $question->lesson->title ?? '' }} @if (!empty($question->title_image))
                                        <img class="math_img" src="{{ $question->title_image }}" alt="">
                                    @endif
                                </td>
                                <td>
                                    <input style="width:50px" onkeyup="order_change({{ $question->id }})"
                                        class="order_{{ $question->id }}" type="text" name='order'
                                        value="{{ $question->order }}">
                                    <input type="hidden" class="question_id" name='question_id'
                                        value="{{ $question->id }}">
                                </td>
                                <td>{{ $question->option1 }} @if (!empty($question->o1_image))
                                        <img class="label-img" src="{{ $question->o1_image }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $question->option2 }} @if (!empty($question->o2_image))
                                        <img class="label-img" src="{{ $question->o2_image }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $question->option3 }} @if (!empty($question->o3_image))
                                        <img class="label-img" src="{{ $question->o3_image }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $question->option4 }} @if (!empty($question->o4_image))
                                        <img class="label-img" src="{{ $question->o4_image }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $question->correct_answers }}</td>
                                <td class="text-center" style="white-space: nowrap">
                                    <a href="{{ route('quiz_question.edit', $question->id) }} "
                                        class="btn btn-primary">Edit</a>
                                    <!-- delete button  -->
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $question->id }}">
                                        Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="delete{{ $question->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="new" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content text-left">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete question</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <h5>Are you sure to delete?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success mr-2"
                                                        data-bs-dismiss="modal">Cancel</button>

                                                    <form action="{{ route('quiz_question.destroy', $question->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Question Found</td>
                            </tr>
                        @endforelse
                    </table>
                    <div class="pagination-area">
                            <ul class="pagination">
                                @if ($questions)
                                    <li>{{ $questions->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                                    </li>
                                @endif
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //   $(".order").on('keyup', function() {
        //     order = $(".order").val();
        //     order_change(order);
        // });

        function order_change(id) {
            // let id = $(".question_id").val();
            let order = $(".order_" + id).val();
            var url = '<?php echo route('order_change'); ?>';
            toastr.options = {
                "closeButton": true,
                "newestOnTop": true,
                "positionClass": "toast-top-right"
            };

            $.ajax({
                type: 'POST',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    'order': order,
                    'id': id
                },
                success: function(data) {
                    console.log(data);
                    document.getElementsByClassName('order').value = data['order'];
                    toastr.success('Data Added');
                }
            });
        }
    </script>
@endsection
