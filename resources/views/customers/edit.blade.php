@extends('layouts.nav')
@section('nav')
    <div class="container">
        <h1>{{__('messages.Edit Customer')}}</h1>
        <p>{{__('messages.Please Enter The Information Below')}}.</p>
        <form class="row g-3" action="{{ route('customers.update', $customer->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="col-md-4">
                <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $customer->name }}">
                @if ($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">{{__('messages.email')}}</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $customer->email }}">
                @if ($errors->has('email'))
                    <span class="error">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="phone_number" class="form-label">{{__('messages.phone_number')}}</label>
                <input type="number" class="form-control" name="phone_number"
                    id="phone_number"value="{{ $customer->phone_number }}">
                @if ($errors->has('phone_number'))
                    <span class="error">{{ $errors->first('phone_number') }}</span>
                @endif

            </div>
            <div class="col-md-6">
                <label for="company" class="form-label">{{__('messages.company')}}</label>
                <input type="text" class="form-control" name="company" id="company" value="{{ $customer->company }}">
                @if ($errors->has('company'))
                    <span class="error">{{ $errors->first('company') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="cPerson" class="form-label">{{__('messages.cPerson')}}</label>
                <input type="text" class="form-control" name="cPerson" id="cPerson" value="{{ $customer->cPerson }}">
                @if ($errors->has('cPerson'))
                    <span class="error">{{ $errors->first('cPerson') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="address" class="form-label">{{__('messages.address')}}</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ $customer->address }}">
                @if ($errors->has('address'))
                    <span class="error">{{ $errors->first('address') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="country" class="form-label">{{__('messages.country')}}</label>
                <input type="text" class="form-control" name="country" id="country" value="{{ $customer->country }}">
                @if ($errors->has('country'))
                    <span class="error">{{ $errors->first('country') }}</span>
                @endif
            </div>
            <div class="col-md-6">
                <label for="city" class="form-label">{{__('messages.city')}}</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ $customer->city }}">
                @if ($errors->has('city'))
                    <span class="error">{{ $errors->first('city') }}</span>
                @endif
            </div>
            <div class="col-md-4">
                <label for="state" class="form-label">{{__('messages.state')}}</label>
                <input type="text" class="form-control" name="state" id="state" value="{{ $customer->state }}">
                @if ($errors->has('state'))
                    <span class="error">{{ $errors->first('state') }}</span>
                @endif
            </div>
            <div class="col-md-2">
                <label for="posCode" class="form-label">{{__('messages.posCode')}}</label>
                <input type="text" class="form-control" name="posCode" id="posCode" value="{{ $customer->posCode }}">
                @if ($errors->has('posCode'))
                    <span class="error">{{ $errors->first('posCode') }}</span>
                @endif
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">{{__('messages.Edit Customer')}}</button>
            </div>
        </form>
        <a href="{{ route('customers.index') }}"><- {{__('messages.back to customers')}}</a>
    </div>
@endsection
