@extends('layouts.app')

@section('content')
    <div class="py-5 hero container-fluid">
        <div class="text-center">
            <img src="{{ asset('assets/logo/logo-dark.png') }}" width="300px" alt="{{ __(env('APP_NAME')) }}">
        </div>
        <div class="text-center py-2">
            <h4 class="fw-bolder">{{ __(':downloader Video downloader', ['downloader' => $downloader_name]) }}</h4>
            <span class="text-muted">{{ __('Download :downloader Video online', ['downloader' => $downloader_name]) }}</h4>
        </div>

        <div class="downloader-wrapper">
            <div class="input-wrapper">
                <input type="text" id="download-url"
                    placeholder="{{ __('Enter :downloader video link here...', ['downloader' => $downloader_name]) }}">
                <button id="download-btn"><i class="bi bi-download me-2"></i>
                    {{ __('Download') }}</button>
            </div>
            <div id="download-result">

            </div>
        </div>

    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 updates-wrapper">
                <div class="card">
                    <div class="card-header"><i class="bi bi-bell-fill"></i>{{ __('Updates') }}</div>
                    <div class="card-body">
                        @foreach ($updates as $update)
                            <div class="bg-{{ $loop->even ? 'blue' : 'green' }} update-card">
                                <strong>{{ $update['title'] }}</strong>{{ $update['description'] }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 faq-wrapper">
                <div class="card">
                    <div class="card-header"><i class="bi bi-patch-question-fill"></i>
                        {{ __('Frequently Asked Questions') }}
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            @foreach ($faqs as $faq)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $loop->iteration }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $loop->iteration }}" aria-expanded="false"
                                            aria-controls="collapse{{ $loop->iteration }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $loop->iteration }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $loop->iteration }}" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            {{ $faq['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(["resources/js/".strtolower($downloader_name)."-downloader.js"])
@endpush
