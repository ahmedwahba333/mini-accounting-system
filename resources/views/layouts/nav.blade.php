@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="{{ __('messages.lang') }}" dir="{{ __('messages.dir') }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href={{ asset('./css/bootstrap.min.css') }}>
        <title>Document</title>
        <style>
            .error {
                color: red;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="navbar-brand d-flex align-items-center">
                    <h2>{{ __('messages.Accounting System') }}</h2>
                    <img src="{{ url('/imgs/logo.png') }}" alt="logo" width="50px">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="{{ route('items.index') }}">{{ __('messages.Items') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"
                                href="{{ route('customers.index') }}">{{ __('messages.Customers') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sales.index') }}">{{ __('messages.Sales') }}</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{__('messages.language')}}
                        </button>
                        <ul class="dropdown-menu">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="nav-item dropdown-item">
                                    <a rel="alternate" hreflang="{{ $localeCode }}" class="nav-link"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        </nav>


        @yield('nav')
        @include('sweetalert::alert')
    </body>

    </html>
@endsection
