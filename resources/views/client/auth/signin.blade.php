@extends('client.layouts.master', [
    'title'       => 'Signin',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageSignin'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/auth.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    @include('client.includes.breadcrumb-auth', ['name' => 'Đăng nhập'])
    <main id="main-content">
        <section>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="auth-form">
                            <div class="heading">
                                <div class="title">Xin Chào</div>
                                <div class="desc">Đăng nhập hoặc đăng ký một tài khoản của riêng bạn</div>
                            </div>
                            <div class="signin-with-social d-flex flex-column justify-content-center">
                                <button type="button" class="btn btn-primary shadow-none signin-google">
                                    {!! svg_icon('google', 25, 25) !!}
                                    <span>Đăng nhập với Google</span>
                                </button>
                                <button type="button" class="btn btn-primary shadow-none signin-facebook">
                                    {!! svg_icon('facebook', 25, 25) !!}
                                    <span>Đăng nhập với Facebook</span>
                                </button>
                            </div>
                            <div class="tabs-container">
                                <ul class="nav nav-tabs" id="authTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ \Request::get('tab') !== 'signup' ? 'active' : '' }}" id="signin-form-tab" data-toggle="tab" href="#signin-form" role="tab" aria-controls="signin-form" aria-selected="true">
                                            <span>Đăng nhập</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link {{ \Request::get('tab') === 'signup' ? 'active' : '' }}" id="signup-form-tab" data-toggle="tab" href="#signup-form" role="tab" aria-controls="signup-form" aria-selected="false">
                                            <span>Đăng ký</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="authTab">
                                    <div class="tab-pane {{ \Request::get('tab') !== 'signup' ? 'active' : '' }}" id="signin-form" role="tabpanel" aria-labelledby="signin-form-tab">
                                        @include('client.includes.form.form-signin')
                                    </div>
                                    <div class="tab-pane {{ \Request::get('tab') === 'signup' ? 'active' : '' }}" id="signup-form" role="tabpanel" aria-labelledby="signup-form-tab">
                                        @include('client.includes.form.form-signup')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')
<script src="{{ get_file_version('/assets/js/views/auth.min.js') }}"></script>
@endpush
