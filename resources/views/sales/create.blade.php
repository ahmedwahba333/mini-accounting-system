@extends('layouts.nav')
@section('nav')
    <div class="container">
        <h1>{{__('messages.New invoice')}}</h1>
        <p>{{__('messages.Please Enter The Information Below')}}.</p>
        <form action="{{ route('sales.store') }}" method="POST" id="itemForm">
            @csrf
            <div class="row">
                <div class="col-md-2">
                    <select name="customer_id" id="customers" class="form-select my-4">
                        <option value="" selected disabled>{{__('messages.Select Customer')}}</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">
                              {{__('messages.Name')}}  {{ ': ' . $customer['name'] . ' '}} {{__('messages.company')}}: {{  $customer['company'] . ' '}}  {{__('messages.phone')}}: {{  $customer['phone_number'] }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('customer_id'))
                        <span class="error">{{ $errors->first('customer_id') }}</span>
                    @endif
                </div>
                <div class="col-md-10 overflow-scroll" style="height: 7rem">
                    <div class="d-flex flex-wrap justify-between align-items-center gap-3 p-2">
                        @foreach ($items as $item)
                            <div class="form-check d-flex align-items-center">
                                <input class="form-check-input me-1" type="checkbox" value="{{ $item['id'] }}"
                                    id="{{ 'item' . $item['id'] }}" name="item_id[]">
                                <label class="form-check-label" for="{{ 'item' . $item['id'] }}">
                                    {{ $item['name'] . ' : ' . $item['price'] . ' ' . $item['currency'] }}
                                </label>
                                <div class="align-items-center d-flex ms-1" style="width: 4rem;">
                                    <div>
                                        <input class="form-control" type="number" name="quantity[]"
                                            min="1">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-3">
                    <label for="shipping_price" class="form-label">{{__('messages.shipping_price')}}</label>
                    <input type="number" class="form-control" id="shipping_price" name="shipping_price"
                        value="{{ old('shipping_price') }}" min="0">
                    @if ($errors->has('shipping_price'))
                        <span class="error">{{ $errors->first('shipping_price') }}</span>
                    @endif
                </div>
                <div class="mb-3 col-md-9">
                    <label for="shipping_address" class="form-label">{{__('messages.shipping_address')}}</label>
                    <input type="text" class="form-control" id="shipping_address" name="shipping_address"
                        value="{{ old('shipping_address') }}">
                    @if ($errors->has('shipping_address'))
                        <span class="error">{{ $errors->first('shipping_address') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="tax" class="form-label">{{__('messages.tax')}}</label>
                    <input type="number" class="form-control" id="tax" name="tax" placeholder="{{__('messages.tax')}} %"
                        value="{{ old('tax') }}" min="0">
                    @if ($errors->has('tax'))
                        <span class="error">{{ $errors->first('tax') }}</span>
                    @endif
                </div>
                <div class="col-md-4">
                    <label for="discount" class="form-label">{{__('messages.discount')}}</label>
                    <input type="number" class="form-control" id="discount" name="discount" placeholder="{{__('messages.discount')}} %"
                        value="{{ old('discount') }}" min="0">
                    @if ($errors->has('discount'))
                        <span class="error">{{ $errors->first('discount') }}</span>
                    @endif
                </div>
                <div class="form-group col-md-4">
                    <label for="sale_date">{{__('messages.Invoice Date')}}</label>
                    <input type="date" name="sale_date" id="sale_date" class="form-control">
                    @if ($errors->has('sale_date'))
                        <span class="error">{{ $errors->first('sale_date') }}</span>
                    @endif
                </div>
            </div>
            <div class="row my-4">
                <div class="col-md-2">
                    <label class="form-label">{{__('messages.Status')}}</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="finished" name="status" id="finished"
                            checked>
                        <label class="form-check-label" for="finished">{{__('messages.finished')}}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="pending" name="status" id="pending">
                        <label class="form-check-label" for="pending">{{__('messages.pending')}}</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="rejected" name="status" id="rejected">
                        <label class="form-check-label" for="rejected">{{__('messages.rejected')}}</label>
                    </div>
                    @if ($errors->has('status'))
                        <span class="error">{{ $errors->first('status') }}</span>
                    @endif
                </div>

                <div class="mb-3 col-md-10">
                    <label for="note" class="form-label">{{__('messages.note')}}</label>
                    <textarea class="form-control" id="note" name="note"></textarea>
                </div>
            </div>

            <button type="submit" class="mb-5 btn btn-primary">{{__('messages.Create Sale')}}</button>
        </form>
    </div>
    <script>
        const form = document.getElementById('itemForm');

        form.addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[name="item_id[]"]');
            const quantities = document.querySelectorAll('input[name="quantity[]"]');

            let atLeastOneSelected = false;
            for (let i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    atLeastOneSelected = true;
                    break;
                }
            }

            if (!atLeastOneSelected) {
                event.preventDefault(); // Prevent form submission
                alert('Please select at least one item.'); // Display an error message
                return; // Exit the function
            }

            for (let i = 0; i < checkboxes.length; i++) {
                const checkbox = checkboxes[i];
                const quantity = quantities[i];
                if (checkbox.checked && (!quantity.value || quantity.value === '0')) {
                    event.preventDefault(); // Prevent form submission
                    alert('Please enter a quantity for the selected item(s).'); // Display an error message
                    return; // Exit the function
                }
            }
        });
    </script>
@endsection
