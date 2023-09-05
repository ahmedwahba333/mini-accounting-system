@extends('layouts.nav')
@section('nav')
    <div class="container-fluid">
        <h1>{{__('messages.Customers Archive')}}</h1>
        <a href="{{ route('customers.index') }}" class="btn btn-primary"><- {{__('messages.back to customers')}}</a>
                <form action="deletedFilter" method="get" class="text-end" onchange="submit()">
                    <select class="form-select w-25 d-inline" name="deletedFilter" id="deletedFilter">
                        <option value="0" selected disabled>{{__('messages.Filter')}}</option>
                        <option value="deleted">{{__('messages.Archived')}}</option>
                        <option value="notDeleted">{{__('messages.Not Archived')}}</option>
                    </select>
                </form>
                @if (Request::is('en/customers/deletedFilter') || Request::is('ar/customers/deletedFilter'))
                    <a href="{{ route('customers.deletedCustomers') }}" class="btn btn-info">{{__('messages.Display All')}}</a>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('messages.Name') }}</th>
                                <th scope="col">{{ __('messages.email') }}</th>
                                <th scope="col">{{ __('messages.phone_number') }}</th>
                                <th scope="col">{{ __('messages.address') }}</th>
                                <th scope="col">{{ __('messages.city') }}</th>
                                <th scope="col">{{ __('messages.state') }}</th>
                                <th scope="col">{{ __('messages.country') }}</th>
                                <th scope="col">{{ __('messages.posCode') }}</th>
                                <th scope="col">{{ __('messages.company') }}</th>
                                <th scope="col">{{ __('messages.cPerson') }}</th>
                                <th scope="col">{{ __('messages.Created_At') }}</th>
                                <th scope="col">{{ __('messages.Deleted_at') }}</th>
                                <th scope="col">{{ __('messages.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCustomers as $key => $customer)
                                @if ($customer['deleted_at'] != null)
                                    <tr class="table-danger">
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
                                        <td scope="col">{{ $customer['deleted_at']->format('Y-m-d H:i:s') }}</td>
                                        <td scope="col">{{ $customer['created_at']->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('customers.deleteForce', $customer['id']) }}"
                                                    class="me-2 btn btn-danger" data-confirm-delete="true">{{__('messages.Delete')}}</a>
                                                <a href="{{ route('customers.restore', $customer['id']) }}"
                                                    class="btn btn-warning">{{__('messages.Restore')}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    <tr class="table-success">
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
                                        <td scope="col">{{ $customer['created_at']->format('Y-m-d H:i:s') }}</td>
                                        <td scope="col">{{__('messages.Not Archived')}}</td>
                                        <td>
                                            <a href="{{ route('customers.deleteForce', $customer['id']) }}"
                                                class="btn btn-danger" data-confirm-delete="true">{{__('messages.Delete')}}</a>
                                        </td>
                                @endif


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
    </div>
@endsection
