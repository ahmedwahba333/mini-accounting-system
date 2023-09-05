@extends('layouts.nav')
@section('nav')
    <div class="container-fluid">
        <h1>{{ __('messages.Sales') }}</h1>

        <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">{{__('messages.Create Sale')}}</a>

        <table class="table">
            <thead>
                <tr>
                    <th>{{__('messages.Num')}}</th>
                    <th>{{__('messages.Invoice Date')}}</th>
                    <th>{{__('messages.Customer')}}</th>
                    <th>{{__('messages.Status')}}</th>
                    <th scope="col">{{__('messages.reference number#')}}</th>
                    <th>{{__('messages.Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                    @foreach ($sales as $sale)
                        <tr
                            @if ($sale->status == 'pending') class='table-warning'
                @elseif($sale->status == 'finished')
                class='table-success'
                @elseif($sale->status == 'rejected')
                class='table-danger' @endif>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->sale_date }}</td>
                            @if ($sale->customer != null)
                            <td>{{ $sale->customer->name }}</td>
                            @else
                            <td class="bg-danger">{{__('messages.Deleted Customer')}}</td>
                            @endif
                            <td>{{ $sale->status }}</td>
                            <th scope="row">{{ $sale->ref_number }}</th>
                            <td>
                                <div class="d-flex justify-content-around align-items-center">
                                    <a href="{{ route('sales.viewSale', [$sale->id, $sale->customer_id]) }}"
                                        class="btn btn-primary">{{__('messages.View')}}</a>
                                    <form action="{{ route('sales.update') }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="d-flex align-items-center justify-center">
                                            <select name="status" id="status" class="form-select me-2">
                                                <option value="" selected disabled>{{__('messages.Select Status')}}</option>
                                                <option value="pending">{{__('messages.pending')}}</option>
                                                <option value="finished">{{__('messages.finished')}}</option>
                                                <option value="rejected">{{__('messages.rejected')}}</option>
                                            </select>
                                            <input type="number" name="id" value="{{ $sale->id }}" hidden>
                                            <button type="submit" class="btn btn-warning">{{__('messages.Change')}}</button>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                
            </tbody>
        </table>
    </div>
@endsection
