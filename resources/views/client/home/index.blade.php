@extends('client.layouts.master', [
    'title'       => 'Home',
    'description' => 'Description',
    'keywords'    => 'keywords',
    'body_id'     => 'pageHome'
])

@push('css')
    <link rel="stylesheet" href="{{ get_file_version('/assets/css/views/home.min.css') }}" media="all">
@endpush

@section('wrapper_content')
    @include('client.includes.master-header')
    @include('client.includes.notifications.global')
    <main id="main-content">
        <section class="homepage-hero">
            <div class="position-absolute overflow-hidden" style="z-index: 0; top: 0; right: 0; bottom: 0; left: 0;">
                <img class="homepage-hero-bg" src="{{ get_file_version('/assets/img/bg-static/homepage.png') }}" style="background: linear-gradient(0deg, rgba(243,244,248,1) 0%, rgba(255,255,255,0) 50%);">
                <picture>
                    <source srcset="{{ get_file_version('/assets/img/svg/homepage-hero-line-ultrawide.svg') }}" media="(min-width: 2180px)">
                    <source srcset="{{ get_file_version('/assets/img/svg/homepage-hero-line-desktop.svg') }}" media="(min-width: 1280px)">
                    <source srcset="{{ get_file_version('/assets/img/svg/homepage-hero-line-tablet.svg') }}" media="(min-width: 599px)">
                    <img class="homepage-hero__line" src="{{ get_file_version('/assets/img/svg/homepage-hero-line-mobile.svg') }}">
                </picture>
            </div>
            <div class="wrapper">
                <div class="text-center py-5">
                    <h1 class="heading-type-one">Guiding you through life’s financial journey</h1>
                    <p class="body-type-one text-slate text-lg m-0">Compare rates, crunch numbers and get expert guidance for life’s biggest financial moments.</p>
                </div>
                <div class="homepage-hero__container row">
                    <div class="homepage-hero__grid col-md-4">
                        <div class="row">
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                            <div class="homepage-hero__tile col-md-6">
                                <a href="" class="homepage-hub-link bg-white box-shadow-two">
                                    <span class="icon">ICON</span>
                                    <span class="heading">Lorem, ipsum dolor.</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="homepage-hero__main col-md-8">
                        <div class="homepage-signup bg-white box-shadow-two">
                            <div class="homepage-signup__head">
                                <h6>NEW: FREE FINANCIAL COACHING</h6>
                            </div>
                            <div class="homepage-signup__body">
                                <div class="text-wrapper">
                                    <h4 class="type-heading">Level up your finances</h4>
                                    <p class="text-slate">Get 1-on-1 guidance from a certified financial coach. No commitment, no prep work, no fees.</p>
                                </div>
                                <div class="button-grid">
                                    <a href="{{ route('client.auth.showForm.signin', ['tab' => 'signin']) }}" class="button-grid__item button-signin">Sign in</a>
                                    <a href="{{ route('client.auth.showForm.signin', ['tab' => 'signup']) }}" class="button-grid__item button-signup">Create new a account?</a>
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

@endpush
