@extends('layouts.app')

@section('content')
    {{-- <link rel="stylesheet" href="{{ asset('css/croppie.css') }}"> --}}
    <form id="kt_ecommerce_settings_general_form" class="form" action="{{ route('setting.update', 1) }}" method="POST"
        enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-header">
                <h5>Theme Options</h5>
            </div>
            <div class="card-body form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site title</label>
                            <input type="text" class="form-control" value="{{ get_settings('site_title') }}"
                                name="site_title">
                        </div>
                        <div class="form-group">
                            <label for="">Slogan</label>
                            <input type="text" class="form-control" value="{{ get_settings('slogan') }}" name="slogan">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number 1</label>
                            <input type="text" class="form-control" value="{{ get_settings('phone_1') }}" name="phone_1">
                        </div>
                        <div class="form-group">
                            <label for="">Phone Number 2</label>
                            <input type="text" class="form-control" value="{{ get_settings('phone_2') }}" name="phone_2">
                        </div>
                        <div class="form-group">
                            <label for="">Email 1</label>
                            <input type="email" class="form-control" value="{{ get_settings('email_1') }}" name="email_1">
                        </div>
                        <div class="form-group">
                            <label for="">Email 2</label>
                            <input type="email" class="form-control" value="{{ get_settings('email_2') }}" name="email_2">
                        </div>
                        <div class="form-group">
                            <label for="">Office Address</label>
                            <input type="text" class="form-control" value="{{ get_settings('address') }}" name="address">
                        </div>
                        <div class="form-group">
                            <label for="">Bkash</label>
                            <input name="bkash" type="text" class="form-control" value="{{get_settings('bkash')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Nagad</label>
                            <input name="nagad" type="text" class="form-control" value="{{get_settings('nagad')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Rocket</label>
                            <input name="rocket" type="text" class="form-control" value="{{get_settings('rocket')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Cellfin</label>
                            <input name="cellfin" type="text" class="form-control" value="{{get_settings('cellfin')}}">
                        </div>
                        <div class="form-group">
                            <label for="">Bank</label>
                            <textarea name="bank" style="height: 100px" class="form-control" >{{ get_settings('bank') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Site Icon</label>
                            <div class="upload-container mb-2" data-width="100" data-height="70">
                                <input type="file" class="image-input" accept="image/*" />
                                <input type="hidden" class="image-hidden-input" name="icon">
                                <div class="image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Light Logo</label>
                            <div class="upload-container mb-2" data-width="300" data-height="70">
                                <input type="file" class="image-input" accept="image/*" />
                                <input type="hidden" class="image-hidden-input" name="logo_light">
                                <div class="image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Dark Logo</label>
                            <div class="upload-container mb-2" data-width="300" data-height="70">
                                <input type="file" class="image-input" accept="image/*" />
                                <input type="hidden" class="image-hidden-input" name="dark_logo">
                                <div class="image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Banner (940x788)</label>
                            <div class="upload-container mb-2" data-width="400" data-height="100">
                                <input type="file" class="image-input" accept="image/*" />
                                <input type="hidden" class="image-hidden-input" name="banner">
                                <div class="image-preview">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Banner Title 1</label>
                            <input type="text" class="form-control" value="{{ get_settings('banner_title_1') }}"
                                name="banner_title_1">
                        </div>
                        <div class="form-group">
                            <label for="">Banner Title 2</label>
                            <input type="text" class="form-control" value="{{ get_settings('banner_title_2') }}"
                                name="banner_title_2">
                        </div>
                        <div class="form-group">
                            <label for="">Banner Title 3</label>
                            <input type="text" class="form-control" value="{{ get_settings('banner_title_3') }}"
                                name="banner_title_3">
                        </div>



                        <div class="form-group">
                            <label for="">Facebook</label>
                            <input type="text" class="form-control" value="{{ get_settings('facebook') }}"
                                name="facebook">
                        </div>
                        <div class="form-group">
                            <label for="">Youtube</label>
                            <input type="text" class="form-control" value="{{ get_settings('youtube') }}"
                                name="youtube">
                        </div>
                        <div class="form-group">
                            <label for="">Linkedin</label>
                            <input type="text" class="form-control" value="{{ get_settings('linkedin') }}"
                                name="linkedin">
                        </div>
                        <div class="form-group">
                            <label for="">Instagram</label>
                            <input type="text" class="form-control" value="{{ get_settings('instagram') }}"
                                name="instagram">
                        </div>
                        <div class="form-group">
                            <label for="">Twitter</label>
                            <input type="text" class="form-control" value="{{ get_settings('twitter') }}"
                                name="twitter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="col-12">
                    <h5>Colors</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="colorPicker_wrap">
                            <label for="">Theme Color</label>
                            <div class="color_picker">
                                <input type="color" class="colorPicker" value="{{ get_settings('theme_color') }}">
                                <input type="text" class="form-control hexInput" name="theme_color"
                                    value="{{ get_settings('theme_color') }}"
                                    pattern="^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="colorPicker_wrap">
                            <label for="">Top Bar Color</label>
                            <div class="color_picker">
                                <input type="color" class="colorPicker" value="{{ get_settings('top_bar_color') }}">
                                <input type="text" class="form-control hexInput" name="top_bar_color"
                                    value="{{ get_settings('top_bar_color') }}"
                                    pattern="^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="colorPicker_wrap">
                            <label for="">Footer Top Bg Color</label>
                            <div class="color_picker">
                                <input type="color" class="colorPicker" value="{{ get_settings('footer_top_bg') }}">
                                <input type="text" class="form-control hexInput" name="footer_top_bg"
                                    value="{{ get_settings('footer_top_bg') }}"
                                    pattern="^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="colorPicker_wrap">
                            <label for="">Footer Bottom Bg Color</label>
                            <div class="color_picker">
                                <input type="color" class="colorPicker" value="{{ get_settings('secondary_color') }}">
                                <input type="text" class="form-control hexInput" name="secondary_color"
                                    value="{{ get_settings('secondary_color') }}"
                                    pattern="^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="text-center d-block mb-4">
            <input type="submit" class="btn btn-outline-info" value="Update Options">
        </div>
    </form>






    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const colorPickers = document.querySelectorAll('.colorPicker');
            const hexInputs = document.querySelectorAll('.hexInput');

            colorPickers.forEach((colorPicker, index) => {
                const hexInput = hexInputs[index];

                colorPicker.addEventListener('input', () => {
                    hexInput.value = colorPicker.value.toUpperCase();
                });

                hexInput.addEventListener('input', () => {
                    const isValidHex = /^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/.test(hexInput.value);
                    if (isValidHex) {
                        colorPicker.value = hexInput.value;
                    }
                });

                hexInput.addEventListener('blur', () => {
                    const isValidHex = /^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/.test(hexInput.value);
                    if (!isValidHex) {
                        hexInput.value = colorPicker.value.toUpperCase();
                    }
                });
            });
        });
    </script>
@endsection
