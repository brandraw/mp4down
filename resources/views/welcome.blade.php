@extends('layouts.app')

@section('content')
    <div class="py-5 hero container-fluid">
        <div class="text-center">
            <img src="{{ asset('assets/logo/logo-dark.png') }}" width="300px" alt="{{ __(env('APP_NAME')) }}">
        </div>
        <div class="text-center py-2">
            <h4 class="fw-bolder">{{ __(':downloader Video download Fast', ['downloader' => $downloader_name]) }}</h4>
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

    <div class="container py-5" id="custom-cards">

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-4">
      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('https://images.unsplash.com/photo-1501290301209-7a0323622985?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1" style="background-color: rgba(0,0,0,0.4);">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Quick Download</h3>
            
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('https://images.unsplash.com/photo-1484807352052-23338990c6c6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1" style="background-color: rgba(0,0,0,0.4);">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Ultimate convenience</h3>
            
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg" style="background-image: url('https://images.unsplash.com/photo-1578346693440-3dcedf4b7b81?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80');">
          <div class="d-flex flex-column h-100 p-5 pb-3 text-shadow-1" style="background-color: rgba(0,0,0,0.4);">
            <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">Easy to download</h3>
            
          </div>
        </div>
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
