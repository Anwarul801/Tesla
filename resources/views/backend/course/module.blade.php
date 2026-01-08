@extends('layouts.app')

@section('page_title')
    Course Module
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="">Modules/Chapters of {{ $course_info->title }}</h5>
                        </div>
                        <div class="col-md-6 text-end">
                            <!-- Button trigger modal (Add Module) -->
                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#new">
                                <span class="fa fa-plus-circle me-1"></span> Add New
                            </button>
                            <a href="{{ route('course.index') }}" class="btn btn-success"><span
                                    class=" ri-arrow-go-back-line"></span> Back</a>

                            <!-- Modal: Add Module (unchanged) -->
                            <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="new"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content text-start">
                                        <div class="modal-header d-flex justify-content-between">
                                            <h5 class="modal-title" id="exampleModalLabel">Add a New Module (Chapter)</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('module.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{ $course_info->id }}" name="course_id">
                                            <div class="modal-body text-start">
                                                <div class="form-group">
                                                    <label for="">Module Title </label>
                                                    <input type="text" class="form-control" name="title">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary mr-2"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Module</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /Add Module -->
                        </div>
                    </div>
                </div>
            </div>

            @forelse($modules as $module)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title">{{ $module->title }} ({{ count($module->lessons) }}
                                    {{ count($module->lessons) > 1 ? 'Content' : 'Content' }})</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="javascript:void(0)" data-bs-toggle="dropdown" id="btnGroupDrop{{ $module->id }}"
                                    style="font-size: 26px; color: rgb(255, 255, 255); margin-right: 10px">
                                    <i class="fa fa-bars" aria-hidden="true"></i>
                                </a>
                                <div class="dropdown-menu" style="background-color: #9fcdff"
                                    aria-labelledby="btnGroupDrop{{ $module->id }}">
                                    <!-- Use the unified lesson modal: open with data attributes -->
                                    <a class="dropdown-item open-lesson-modal" href="#"
                                        data-bs-toggle="modal" data-bs-target="#lessonModal"
                                        data-mode="create" data-type="video"
                                        data-module-id="{{ $module->id }}"
                                        data-course-id="{{ $course_info->id }}">Add Video</a>

                                    <a class="dropdown-item open-lesson-modal" href="#"
                                        data-bs-toggle="modal" data-bs-target="#lessonModal"
                                        data-mode="create" data-type="docs"
                                        data-module-id="{{ $module->id }}"
                                        data-course-id="{{ $course_info->id }}">Add Document</a>

                                    <a class="dropdown-item open-lesson-modal" href="#"
                                        data-bs-toggle="modal" data-bs-target="#lessonModal"
                                        data-mode="create" data-type="text"
                                        data-module-id="{{ $module->id }}"
                                        data-course-id="{{ $course_info->id }}">Add Text</a>

                                    <a class="dropdown-item open-lesson-modal" href="#"
                                        data-bs-toggle="modal" data-bs-target="#lessonModal"
                                        data-mode="create" data-type="quiz"
                                        data-module-id="{{ $module->id }}"
                                        data-course-id="{{ $course_info->id }}">Add Quiz</a>

                                    <a class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#update_module{{ $module->id }}" href="#">Update Module</a>

                                    <form action="{{ route('module.destroy', $module->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="dropdown-item"
                                            onclick="return confirm('Are you sure to delete this Module?')">Delete
                                            Module</button>
                                    </form>
                                </div>

                                <!-- Modal update module (unchanged)-->
                                <div class="modal fade" id="update_module{{ $module->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="update_module{{ $module->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content text-start">
                                            <div class="modal-header d-flex justify-content-between">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Module</h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('module.update', $module->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Module Title </label>
                                                        <input type="text" value="{{ $module->title }}"
                                                            class="form-control" name="title">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary mr-2"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Module</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- /update module -->
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            @forelse($module->lessons as $single_video)
                                <tr>
                                    <td class="text-center">{{ $single_video->title }}</td>
                                          <td class="text-center">Preview: {{ $single_video->is_free==1?'Yes Free':'No' }} </td>
                                    @if ($single_video->type == 'video')
                                        <td class="text-center">Source:{{ $single_video->video_type }}
                                        </td>
                                    @elseif($single_video->type == 'docs')
                                        {{ 'Document' }}

                                        <td class="text-center">Source: {{ 'Document' }} <a href="{{ $single_video->document }}"
                                                target="_blank">DOCS</a> </td>
                                    @elseif($single_video->type == 'quiz' || $single_video->type == 4)
                                        <td class="text-center"> Source: {{ 'Quiz' }} - @php
                                            $question = App\Models\QuizQuestion::where('lesson_id', $single_video->id)->count();
                                        @endphp <span>
                                                Question({{ $question ?? '0' }})</span>
                                            <a href="{{ route('quiz_question.create') }}?lesson_id={{ $single_video->id }} "
                                                class="btn btn-primary">Add</a>
                                            <a target="_blank"
                                                {{-- href="{{ route('model_test_show', ['id' => $single_video->id]) }}" --}}
                                                class="btn btn-info">View </a>
                                        </td>
                                    @else

                                        <td class="text-center">Source: {{ 'Text' }}</td>
                                    @endif

                                    <td class="text-center" style="width: 10%; white-space: nowrap">
                                        <!-- Update: open unified lesson modal and pass lesson JSON -->
                                        <button type="button" class="btn btn-primary mr-2 open-lesson-modal"
                                            data-bs-toggle="modal"
                                            data-bs-target="#lessonModal"
                                            data-mode="edit"
                                            data-lesson='@json($single_video)'>Update</button>

                                        <form style="display: inline-block"
                                            action="{{ route('lessons.destroy', $single_video->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" value="Delete" class="btn btn-danger"
                                                onclick="return confirm('Are you sure to delete this video?')">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center">No lessons found in this module</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            @empty
                <h2 class="text-center">No module found</h2>
            @endforelse
        </div>
    </div>

    <!-- Unified Lesson Modal for Create & Update -->
    <div class="modal fade" id="lessonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-start">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="lessonModalLabel">Add / Update Lesson</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- The form uses JS to switch between create and update -->
                <form id="lessonForm" action="{{ route('lessons.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- For update we'll insert @method('PUT') dynamically -->
                    <input type="hidden" name="module_id" id="lesson_module_id" value="">
                    <input type="hidden" name="course_id" id="lesson_course_id" value="">
                    <input type="hidden" name="type" id="lesson_type" value="video">

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" class="form-control" name="title" id="lesson_title">
                        </div>

                        <!-- Video specific fields -->
                        <div id="video_fields" style="display:none;">
                            <div class="form-group">
                                <label for="">Video Link/ID</label>
                                <textarea class="form-control" name="link" id="lesson_link" cols="30" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Video Source</label>
                                <select name="video_type" id="lesson_video_type" class="form-control">
                                    <option value="Vdocipher">Vdocipher</option>
                                    <option value="YouTube">YouTube</option>
                                    <option value="Vimeo">Vimeo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Document specific fields -->
                        <div id="docs_fields" style="display:none;">
                            <div class="form-group">
                                <label for="">Upload Document</label>
                                <input type="file" name="document" id="lesson_document" class="form-control">
                                <div id="current_document" class="mt-2" style="display:none;">
                                    Current: <a href="#" target="_blank" id="current_document_link"></a>
                                    <button type="button" class="btn btn-sm btn-danger" id="remove_current_document">Remove</button>
                                </div>
                                <input type="hidden" name="old_doc" id="lesson_old_doc" value="">
                            </div>
                        </div>

                        <!-- Quiz specific fields -->
                        <div id="quiz_fields" style="display:none;">
                            <div class="form-group">
                                <label for="">Duration (00:00:00)</label>
                                <input type="text" class="form-control" placeholder="Duration(02:00:00)" name="duration" id="lesson_duration">
                            </div>
                            <div class="form-group">
                                <label for="">Total Mark</label>
                                <input type="number" class="form-control" placeholder="Total Mark" name="mark" id="lesson_mark">
                            </div>
                        </div>

                        <!-- Common description -->
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description" id="lesson_description" cols="30" rows="6"></textarea>
                        </div>

                        <div class="form-group">
                            <label><input type="checkbox" name="is_free" id="lesson_is_free"> Set as Preview</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="lesson_submit_button">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Unified Lesson Modal -->

    @push('scripts')
        <script>
            (function () {
                // URL template for update - replace :id in JS
                var updateUrlTemplate = "{{ route('lessons.update', ':id') }}";
                var createUrl = "{{ route('lessons.store') }}";

                var lessonModal = document.getElementById('lessonModal');
                lessonModal.addEventListener('show.bs.modal', function (event) {
                    var trigger = event.relatedTarget;
                    var mode = trigger.getAttribute('data-mode') || 'create';
                    var form = document.getElementById('lessonForm');

                    // reset form
                    form.reset();
                    // remove any existing _method input
                    var existingMethod = form.querySelector('input[name="_method"]');
                    if (existingMethod) existingMethod.remove();
                    // reset hidden old_doc
                    document.getElementById('lesson_old_doc').value = '';
                    document.getElementById('current_document').style.display = 'none';
                    document.getElementById('current_document_link').href = '#';
                    document.getElementById('current_document_link').textContent = '';

                    if (mode === 'create') {
                        // set form to create
                        form.action = createUrl;
                        form.querySelector('input[name="_token"]').value = "{{ csrf_token() }}";
                        // populate module_id/course_id if provided
                        var moduleId = trigger.getAttribute('data-module-id') || '';
                        var courseId = trigger.getAttribute('data-course-id') || '';
                        document.getElementById('lesson_module_id').value = moduleId;
                        document.getElementById('lesson_course_id').value = courseId;

                        // set type from trigger
                        var t = trigger.getAttribute('data-type') || 'video';
                        setType(t);

                        // modal title and button
                        document.getElementById('lessonModalLabel').textContent = 'Add New ' + ucFirst(t);
                        document.getElementById('lesson_submit_button').textContent = 'Add ' + ucFirst(t);
                    } else if (mode === 'edit') {
                        // set method PUT
                        var inputMethod = document.createElement('input');
                        inputMethod.type = 'hidden';
                        inputMethod.name = '_method';
                        inputMethod.value = 'PUT';
                        form.appendChild(inputMethod);

                        // read lesson data from data-lesson (JSON)
                        var lessonJson = trigger.getAttribute('data-lesson') || null;
                        var lesson = {};
                        try {
                            lesson = JSON.parse(lessonJson);
                        } catch (e) {
                            console.error('Failed to parse lesson JSON', e);
                        }

                        // set form action to update route
                        if (lesson.id) {
                            form.action = updateUrlTemplate.replace(':id', lesson.id);
                        }

                        // fill values
                        document.getElementById('lesson_title').value = lesson.title || '';
                        document.getElementById('lesson_module_id').value = lesson.module_id || '';
                        document.getElementById('lesson_course_id').value = lesson.course_id || '';
                        document.getElementById('lesson_description').value = lesson.description || '';
                        document.getElementById('lesson_is_free').checked = Number(lesson.is_free) === 1;

                        // set type and show relevant fields
                        var typ = lesson.type || lesson.type_text || 'video';
                        setType(typ);

                        // populate type-specific fields
                        if (typ === 'video') {
                            document.getElementById('lesson_link').value = lesson.link || '';
                            document.getElementById('lesson_video_type').value = lesson.video_type || '';
                        } else if (typ === 'docs') {
                            if (lesson.document) {
                                document.getElementById('current_document').style.display = 'block';
                                document.getElementById('current_document_link').href = lesson.document;
                                document.getElementById('current_document_link').textContent = lesson.document.split('/').pop();
                                document.getElementById('lesson_old_doc').value = lesson.document;
                            }
                        } else if (typ === 'quiz') {
                            document.getElementById('lesson_duration').value = lesson.duration || '';
                            document.getElementById('lesson_mark').value = lesson.mark || '';
                        } else {
                            // text: nothing else needed
                        }

                        document.getElementById('lessonModalLabel').textContent = 'Update ' + ucFirst(typ);
                        document.getElementById('lesson_submit_button').textContent = 'Update';
                    }
                });

                // helper to show/hide fields by type
                function setType(type) {
                    document.getElementById('lesson_type').value = type;
                    var videoFields = document.getElementById('video_fields');
                    var docsFields = document.getElementById('docs_fields');
                    var quizFields = document.getElementById('quiz_fields');

                    videoFields.style.display = (type === 'video') ? 'block' : 'none';
                    docsFields.style.display = (type === 'docs') ? 'block' : 'none';
                    quizFields.style.display = (type === 'quiz') ? 'block' : 'none';
                }

                // utility
                function ucFirst(str) {
                    if (!str) return str;
                    return str.charAt(0).toUpperCase() + str.slice(1);
                }

                // handle remove current document click
                document.addEventListener('click', function (e) {
                    if (e.target && e.target.id === 'remove_current_document') {
                        document.getElementById('lesson_old_doc').value = '';
                        document.getElementById('current_document').style.display = 'none';
                    }
                });

                // Clean modal on hide to avoid stale data
                lessonModal.addEventListener('hidden.bs.modal', function () {
                    var form = document.getElementById('lessonForm');
                    form.reset();
                    var existingMethod = form.querySelector('input[name="_method"]');
                    if (existingMethod) existingMethod.remove();
                });
            })();
        </script>
    @endpush

@endsection
