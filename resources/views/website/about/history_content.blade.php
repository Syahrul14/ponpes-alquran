@extends('website.layout')

@section('title', 'Sejarah')

@section('content')
@php
    $banner = $data['history_banner'] ?? null;
    $profile = $data['history_profile'] ?? null;
@endphp

<section id="hero-page" class="hero-page d-flex align-items-center position-relative text-white" 
         style="background: url('{{ !empty($banner?->image) ? asset('storage/' . $banner->image) : asset('assets/images/home/home_banner_3.jpg') }}') no-repeat center center / cover; 
                padding-top: 120px; 
                min-height: 40vh;">
    
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.6); z-index: 1;"></div>

    <div class="container position-relative py-5" style="z-index: 2;" data-aos="fade-up">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                
                <h1 class="fw-bold display-4 mb-3 text-uppercase tracking-wide" style="letter-spacing: 1px;">{{ !empty($banner?->title) ? $banner->title : 'Sejarah' }}</h1>
                
                <p class="lead text-white-50 mb-0 mx-auto" style="max-width: 600px;">{{ !empty($banner?->sub_title) ? $banner->sub_title : 'Napak tilas perjuangan, visi, dan nilai-nilai luhur berdirinya Ponpes Al-Qur\'an Rizky Amalia.' }}</p>
            </div>
        </div>
    </div>
</section>

<section id="sejarah-detail" class="py-5 bg-white">
    <div class="container py-4">
        <div class="row g-5 align-items-center">
            
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative ps-4 pb-4">
                    <div class="position-absolute bottom-0 start-0 bg-success-subtle rounded-3" style="width: 85%; height: 85%; z-index: 1;"></div>
                    
                    <img src="{{ !empty($profile?->image) ? asset('storage/' . $profile->image) : asset('assets/images/home/home_banner_1.jpg') }}" 
                         alt="{{ !empty($profile?->title) ? $profile->title : 'Gedung Ponpes Al-Quran Rizky Amalia' }}" 
                         class="img-fluid rounded-3 shadow-lg position-relative" 
                         style="z-index: 2; object-fit: cover; width: 100%; max-height: 400px;">
                </div>
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <div class="align-self-center">
                    <span class="text-success fw-bold text-uppercase tracking-wider small d-block mb-2">{{ $profile->title }}</span>

                    <div class="sejarah-body text-secondary">
                      {!! $profile->description !!}
                    </div>

                    <div class="border-start border-4 border-success ps-3 my-4 py-1 bg-light rounded-end">
                        <p class="fst-italic text-dark mb-1 fw-medium">"{{ $profile->quotes }}"</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection