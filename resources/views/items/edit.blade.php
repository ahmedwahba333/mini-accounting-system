@extends('layouts.nav')
@section('nav')
    <div class="container">
        <h1>{{ __('messages.Edit Product') }}</h1>
        <p>{{ __('messages.Please Enter The Information Below') }}.</p>
        <form action="{{ route('items.update', $item['id']) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">{{ __('messages.Name') }}</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $item['name'] }}">
                @if ($errors->has('name'))
                    <span class="error">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="details" class="form-label">{{ __('messages.Details') }}</label>
                <textarea type="text" name="details" class="form-control" id="details">{{ $item['details'] }}</textarea>
                @if ($errors->has('details'))
                    <span class="error">{{ $errors->first('details') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">{{ __('messages.Price') }}</label>
                    <input type="number" name="price" class="form-control" id="price" value="{{ $item['price'] }}"
                        min="0">
                    @if ($errors->has('price'))
                        <span class="error">{{ $errors->first('price') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-6">
                    <label for="currency" class="form-label">{{ __('messages.currency') }}</label>
                    <select name="currency" id="currency" class="form-select">
                        <option value="SAR">{{ __('messages.Saudi riyal SAR') }}</option>
                        <option value="EGP">{{ __('messages.Egyptian pound EGP') }}</option>
                        <option value="USD">{{ __('messages.United States dollar USD') }}</option>
                        <option value="GBP">{{ __('messages.British pound sterling GBP') }}</option>
                        <option value="RUB">{{ __('messages.Russian rouble RUB') }}</option>
                        <option value="CNY">{{ __('messages.Chinese Yuan CNY') }}</option>
                    </select>
                    @if ($errors->has('currency'))
                        <span class="error">{{ $errors->first('currency') }}</span>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{ __('messages.Edit Product') }}</button>
        </form>
        <a href="{{ route('items.index') }}"><- {{ __('messages.back to Items') }}</a>
    </div>
@endsection
