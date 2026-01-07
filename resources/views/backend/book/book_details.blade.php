@extends('layouts.app')

@section('page_title')
    Book Details
@endsection

@section('content')
    <div class="card">
        {{-- Header --}}
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5>📘 Book Details</h5>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('book.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                    <a href="{{ route('book.edit', $book->id) }}" class="btn btn-outline-info">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div class="card-body">
            <div class="row">
                {{-- Left : Image --}}
                <div class="col-md-4 text-center">
                    @if($book->image)
                        <img src="{{ asset($book->image) }}"
                             class="img-fluid rounded shadow mb-3"
                             style="max-height: 350px;" alt="book image">
                    @else
                        <div class="border p-5 text-muted">
                            No Image Available
                        </div>
                    @endif
                        <br>
                    <span class="badge bg-{{ $book->status === 'Active' ? 'success' : 'danger' }}">
                        {{ $book->status }}
                    </span>
                </div>

                {{-- Right : Info --}}
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Book Name</th>
                            <td>{{ $book->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Author</th>
                            <td>{{ $book->author ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>{{ $book->type ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>
                                {{ $book->price ? '৳ '.$book->price : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Discount</th>
                            <td>
                                {{ $book->discount ? $book->discount.'%' : 'N/A' }}
                            </td>
                        </tr>
                        <tr>
                            <th>Order</th>
                            <td>{{ $book->order ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $book->slug ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Description --}}
            <div class="row mt-4">
                <div class="col-md-12">
                    <h6>Description</h6>
                    <div class="border rounded p-3">
                        {!! $book->description ?? '<span class="text-muted">No description found.</span>' !!}
                    </div>
                </div>
            </div>

            {{-- PDF + Video --}}
            <div class="row mt-4">
                <div class="col-md-6">
                    <h6>📄 Book Document (PDF)</h6>
                    @if($book->document)
                        <a href="{{ asset($book->document) }}"
                           target="_blank"
                           class="btn btn-outline-dark">
                            <i class="fa fa-file-pdf"></i> View PDF
                        </a>
                    @else
                        <p class="text-muted">No document uploaded.</p>
                    @endif
                </div>

                <div class="col-md-6">
                    <h6>🎥 Promo Video</h6>
                    @if($book->promo_video)
                        <a href="{{ $book->promo_video }}"
                           target="_blank"
                           class="btn btn-outline-danger">
                            <i class="fa fa-play-circle"></i> Watch Video
                        </a>
                    @else
                        <p class="text-muted">No promo video available.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
