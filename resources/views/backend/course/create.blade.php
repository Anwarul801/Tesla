@extends('layouts.app')
{{--
 @Author: Anwarul
 @Date: 2026-01-05 16:57:54
 @LastEditors: Anwarul
 @LastEditTime: 2026-01-07 14:15:30
 @Description: Innova IT
--}}

@section('page_title')
    Course
@endsection

@section('content')
@php
    $course = $course ?? null;
@endphp

<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h5>{{ __('Manage Course') }}</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('course.index') }}"
                   class="btn btn-outline-info waves-effect waves-light">
                    <i class="fa fa-list"></i> {{ __('Course List') }}
                </a>
            </div>
        </div>
    </div>

    <div class="card-body form-body">
        <form action="{{ $page_type == 'create'
                ? route('course.store')
                : route('course.update', $course->id) }}"
              method="POST" enctype="multipart/form-data">

            @csrf
            @if($page_type != 'create')
                @method('PUT')
            @endif

            {{-- Course Name --}}
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label mb-0">Course Name <span class="text-danger">*</span></label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $course->name ?? '') }}" required>
                </div>
            </div>

            {{-- Book --}}
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label mb-0">Book</label>
                </div>
                <div class="col-md-9">
                    <select name="book_id" class="form-select">
                        <option value="">-- Select Book --</option>
                        @foreach($books as $book)
                            <option value="{{ $book->id }}"
                                {{ old('book_id', $course->book_id ?? '') == $book->id ? 'selected' : '' }}>
                                {{ $book->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Price / Discount / Order --}}
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label mb-0">Price / Discount / Order</label>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="number" name="price" class="form-control"
                                   placeholder="Price"
                                   value="{{ old('price', $course->price ?? 0) }}">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="discount" class="form-control"
                                   placeholder="Discount"
                                   value="{{ old('discount', $course->discount ?? 0) }}">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="order" class="form-control"
                                   placeholder="Order"
                                   value="{{ old('order', $course->order ?? 0) }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label mb-0">Status</label>
                </div>
                <div class="col-md-9">
                    <select name="status" class="form-select">
                        <option value="Active"
                            {{ old('status', $course->status ?? 'Active') == 'Active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="Inactive"
                            {{ old('status', $course->status ?? '') == 'Inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>
            </div>

            {{-- Media --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label mb-0">Media</label>
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="file" name="thumbnail" class="form-control mb-1">
                            <small class="text-muted">Thumbnail</small>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="banner" class="form-control mb-1">
                            <small class="text-muted">Banner</small>
                        </div>
                        <div class="col-md-4">
                            <input type="file" name="document" class="form-control mb-1">
                            <small class="text-muted">Document</small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Promo Video --}}
            <div class="row mb-3 align-items-center">
                <div class="col-md-3">
                    <label class="form-label mb-0">Promo Video</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="promo_video" class="form-control"
                           value="{{ old('promo_video', $course->promo_video ?? '') }}">
                </div>
            </div>

            {{-- Short Description --}}
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label mb-0">Short Description</label>
                </div>
                <div class="col-md-9">
                    <textarea name="short_description" rows="3" class="form-control" id="elm1">{!! old('short_description', $course->short_description ?? '') !!}</textarea>
                </div>
            </div>

            {{-- Description --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <label class="form-label mb-0">Description</label>
                </div>
                <div class="col-md-9">
                    <textarea name="description" rows="5" class="form-control" id="elm1">{{ old('description', $course->description ?? '') }}</textarea>
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    {{ $page_type == 'create' ? 'Create Course' : 'Update Course' }}
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@push('scripts')

@endpush
