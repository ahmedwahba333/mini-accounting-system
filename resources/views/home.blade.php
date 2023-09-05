@extends('layouts.nav')
@section('nav')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>
                    <div class="container mb-5">
                        <h1 class="text-center">{{ __('messages.Accounting System') }}</h1>
                        <h2>{{ __('messages.Items') }}: {{ $items }}</h2>
                        <h2>{{ __('messages.Customers') }}: {{ $customers }}</h2>
                        <h2>{{ __('messages.Sales') }}: {{ $sales }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
