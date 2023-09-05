@extends('layouts.nav')
@section('nav')
    <div class="container-fluid">
        <h1>{{ __('messages.Customers') }}</h1>
        <a href="{{ route('customers.create') }}" class="btn btn-success">{{__('messages.Add New Customer')}}</a>
        <a href="{{ route('customers.deletedCustomers') }}" class="btn btn-primary float-end">{{__('messages.go to archive')}} -></a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('messages.Name') }}</th>
                    <th scope="col">{{__('messages.email')}}</th>
                    <th scope="col">{{__('messages.phone_number')}}</th>
                    <th scope="col">{{__('messages.address')}}</th>
                    <th scope="col">{{__('messages.city')}}</th>
                    <th scope="col">{{__('messages.state')}}</th>
                    <th scope="col">{{__('messages.country')}}</th>
                    <th scope="col">{{__('messages.posCode')}}</th>
                    <th scope="col">{{__('messages.company')}}</th>
                    <th scope="col">{{__('messages.cPerson')}}</th>
                    <th scope="col">{{__('messages.Created_At')}}</th>
                    <th scope="col">{{__('messages.Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $key => $customer)
                    <tr>
                        <td scope="col">{{ $key + 1 }}</td>
                        <td scope="col">{{ $customer['name'] }}</td>
                        <td scope="col">{{ $customer['email'] }}</td>
                        <td scope="col">{{ $customer['phone_number'] }}</td>
                        <td scope="col">{{ $customer['address'] }}</td>
                        <td scope="col">{{ $customer['city'] }}</td>
                        <td scope="col">{{ $customer['state'] }}</td>
                        <td scope="col">{{ $customer['country'] }}</td>
                        <td scope="col">{{ $customer['posCode'] }}</td>
                        <td scope="col">{{ $customer['company'] }}</td>
                        <td scope="col">{{ $customer['cPerson'] }}</td>
                        <td scope="col">{{ $customer['created_at']->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('customers.delete', $customer['id']) }}" class="btn btn-danger"
                                data-confirm-delete="true">{{__('messages.archive')}}</a>
                            <a href="{{ route('customers.edit', $customer['id']) }}" class="btn btn-warning">{{__('messages.Edit')}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
