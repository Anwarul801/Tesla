@extends('layouts.app')
{{--
 @Author: Anwarul
 @Date: 2026-01-05 16:57:54
 @LastEditors: Anwarul
 @LastEditTime: 2026-01-05 17:08:28
 @Description: Innova IT
 --}}
@section('page_title')
    Course
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>{{ __('Manage Course') }}</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a type="button" href="{{ route('course.index') }}" class="btn btn-outline-info waves-effect waves-light">
                        <i class="fa fa-list"></i> {{ __('Course List') }}
                </a>
                </div>
            </div>
        </div>

        <div class="card-body form-body">
            <form action="" method="post" id="search_form">

            </form>

        </div>
    </div>

@endsection
