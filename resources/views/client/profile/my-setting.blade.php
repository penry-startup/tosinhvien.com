@extends('client.layouts.master', [
    'title'       => 'Profile Setting',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageProfile'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/settings-profile.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    <main id="main-content">
        <div class="profile-setting">
            <div class="container profile-setting__wrapper">
                <div class="row">
                    <div class="col-8">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-accout" role="tabpanel" aria-labelledby="v-pills-accout-tab">
                                        <h4 class="title">Hồ sơ của bạn</h4>
                                        <div class="content-wrapper">
                                            @include('client.includes.form.form-profile-setting-account')
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                                        <h4 class="title">Cập nhật mật khẩu</h4>
                                        <div class="content-wrapper">
                                            @include('client.includes.form.form-profile-setting-password')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn app-bg-color text-white shadow-none profile-preview__edit-btn">
                                    <span class="edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"/>
                                        </svg>
                                    </span>
                                    <span>Lưu thay đổi</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-accout-tab" data-toggle="pill" href="#v-pills-accout" role="tab" aria-controls="v-pills-accout" aria-selected="true">Tài khoản</a>
                            <a class="nav-link" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">Mật khẩu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@push('js')

@endpush
