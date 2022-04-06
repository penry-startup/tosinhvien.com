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
                                <div class="title">Đừng lo lắng</div>
                                <div class="desc">Hãy nhập địa chỉ email mà trước đây bạn đã dùng để đăng ký tài khoản của bạn, chúng tôi sẽ gửi cho bạn một email chứa mã xác nhận</div>
                            </div>
                            <div class="tabs-container">
                                <form action="" class="form-wrapper">
                                    <div class="form-group">
                                        <label for="email">E-mail xác nhận</label>
                                        <input type="email" class="form-control shadow-none" id="email" aria-describedby="email" placeholder="Nhập địa chỉ email của bạn">
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block shadow-none btn-submit">Gửi mã xác nhận</button>
                                    <a href="{{ route('client.auth.showForm.signin') }}" class="mt-3 d-inline-block">Quay về đăng nhập</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('js')

@endpush
