@extends('components.layouts.new-layout')

@section('content')
    <!-- Video Section -->
    <div class="w-full flex justify-center items-center py-6">
        <video
            class="w-full h-[500px] object-cover pointer-events-none select-none"
            autoplay
            muted
            loop
            playsinline>
            <source src="{{ asset('videos/home-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Carousel Section -->

    <div class="py-8">
        @livewire('carousel-for-homepage')
    </div>

@endsection
