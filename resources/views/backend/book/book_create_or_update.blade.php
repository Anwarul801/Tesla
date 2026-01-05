@extends('layouts.app')
@section('page_title')
   {{$page_type}} Book
@endsection
@section('content')
    <style>
        #datatable-buttons_info,
        #datatable-buttons_paginate,
        #datatable-buttons_filter {
            display: none;
        }
    </style>

    <div class="card">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>{{$page_type}} Book</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{route('book.index')}}" class="btn btn-outline-info waves-effect waves-light"
                            >
                        <i class="fa fa-arrow-left"></i> {{ __('Back To List') }}
                    </a>
                </div>
            </div>
        </div>

        <div class="card-body form-body">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $book->name ?? '') }}" placeholder="Enter Book Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Price') }} <span class="text-danger">*</span></label>
                                <input type="text" name="price" class="form-control number" value="{{ old('price', $book->price ?? '') }}" placeholder="Enter Book Price">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                    </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Discount Price') }}</label>
                                <input type="text" name="discount" class="form-control number" value="{{ old('discount', $book->duscount ?? '') }}" placeholder="Enter Discount Price">
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label ">{{ __('Image') }}</label>
                                <input type="file" name="image" class="form-control">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Promo Video Link') }}</label>
                                <input type="text" name="promo_video" class="form-control" value="{{ old('promo_video', $book->promo_video ?? '') }}" placeholder="Enter Promo Video Link">
                                @error('promo_video')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Document/PDF') }}</label><br>
                                <input type="file" accept="application/pdf" name="document" class="form-control">
                                @error('document')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        @if($page_type=='Edit')
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control">
                                        <option value="Active" {{ (old('status', $book->status ?? '') == 'Active') ? 'selected' : '' }}>Active</option>
                                        <option value="In-Active" {{ (old('status', $book->status ?? '') == 'In-Active') ? 'selected' : '' }}>In-Active</option>
                                    </select>
                                    @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Order') }} <span class="text-danger">*</span></label>
                                    <input type="number" name="order" class="form-control" value="{{ old('order', $book->order ?? '') }}" placeholder="Enter Book Order">
                                    @error('order')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">{{ __('Description') }}</label>
                                <textarea name="description" id="elm1" class="form-control" rows="4" placeholder="Enter Book Description">{{ old('description', $book->description ?? '') }}</textarea>
                        </div>
                </div>
            </div>
        </div>
    </div>



@endsection
