@extends('layouts.nav')
@section('nav')
    <div class="container-fluid table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">{{__('messages.reference number#')}}</th>
                    <th scope="col">{{__('messages.customer name')}}</th>
                    <th scope="col">{{__('messages.company')}}</th>
                    <th scope="col">{{__('messages.phone')}}</th>
                    <th scope="col">{{__('messages.email')}}</th>
                    <th scope="col">{{__('messages.Status')}}</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">{{ $sales->ref_number }}</th>
                    @if ($customer != null)
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->company }}</td>
                        <td>{{ $customer->phone_number }}</td>
                        <td>{{ $customer->email }}</td>
                    @else
                        <td>{{__('messages.Customer Deleted')}}</td>
                        <td>{{__('messages.Customer Deleted')}}</td>
                        <td>{{__('messages.Customer Deleted')}}</td>
                        <td>{{__('messages.Customer Deleted')}}</td>
                    @endif

                    <td>{{ $sales->status }}</td>

                </tr>
            </tbody>
        </table>
        <table class="table table-hover">
            <thead>
                <tr>

                    <th scope="col">{{__('messages.sale_date')}}</th>
                    <th scope="col">{{__('messages.shipping_address')}}</th>
                    <th scope="col">{{__('messages.shipping_price')}}</th>
                    <th scope="col">{{__('messages.item name')}}</th>
                    <th scope="col">{{__('messages.quantity')}}</th>
                    <th scope="col">{{ __('messages.Details') }}</th>
                    <th scope="col">{{__('messages.unit price')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sales->sale_date }}</td>
                    <td>{{ $sales->shipping_address }}</td>
                    @if ($items != null)
                        <td>{{ $sales->shipping_price . ' ' . $items[0]->currency }}</td>
                    @else
                        <td>{{__('messages.Item Deleted')}}</td>
                    @endif
                    <td>
                        @foreach ($items as $item)
                            {{ $item->name }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($sales_items as $sale_item)
                            {{ $sale_item->quantity }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($items as $item)
                            {{ $item->details }}<br>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($items as $item)
                            {{ $item->price . ' ' . $item->currency }}<br>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">{{__('messages.tax')}}</th>
                    <th scope="col">{{__('messages.discount')}}</th>
                    <th scope="col">{{__('messages.total_price')}}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sales->tax }}</td>
                    <td>{{ $sales->discount }}</td>
                    @if ($items != null)
                        <td>{{ $sales->total_amount . ' ' . $items[0]->currency }}</td>
                    @else
                        <td>{{__('messages.Item Deleted')}}</td>
                    @endif
                </tr>
            </tbody>
        </table>
        <th scope="row">{{ $sales->ref_number }}</th>
        @if ($customer != null)
            <br>
            <a class="btn btn-primary mt-3" href="{{ route('viewSalePDF', [$sales->id, $customer->id]) }}">
                {{__('messages.Download')}}
            </a>
        @else
            <br>
            <button class="btn btn-danger mt-3">{{__('messages.cant print')}}</button>
        @endif

    </div>
@endsection
