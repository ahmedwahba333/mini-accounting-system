@extends('layouts.nav')
@section('nav')
    <div class="container-fluid">
        <h1>{{__('messages.Items Archive')}}</h1>
        <a href="{{ route('items.index') }}" class="btn btn-primary"><- {{__('messages.back to Items')}}</a>
        <form action="deletedFilter" method="get" class="text-end" onchange="submit()">
            <select class="form-select w-25 d-inline" name="deletedFilter" id="deletedFilter">
                <option value="0" selected disabled>{{__('messages.Filter')}}</option>
                <option value="deleted">{{__('messages.Archived')}}</option>
                <option value="notDeleted">{{__('messages.Not Archived')}}</option>
            </select>
        </form>
        @if (Request::is('en/items/deletedFilter') || Request::is('ar/items/deletedFilter'))
            <a href="{{ route('items.deletedItems') }}" class="btn btn-info">{{__('messages.Display All')}}</a>
        @endif
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.Details') }}</th>
                        <th scope="col">{{ __('messages.Price') }}</th>
                        <th scope="col">{{__('messages.Created_At')}}</th>
                        <th scope="col">{{__('messages.Deleted_at')}}</th>
                        <th scope="col">{{__('messages.Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allItems as $key => $item)
                        @if ($item['deleted_at'] != null)
                            <tr class="table-danger">
                                <td scope="col">{{ $key + 1 }}</td>
                                <td scope="col">{{ $item['name'] }}</td>
                                <td scope="col">{{ $item['details'] }}</td>
                                <td scope="col">{{ $item['price'] . ' ' . $item['currency'] }}</td>
                                <td scope="col">{{ $item['created_at']->format('Y-m-d H:i:s') }}</td>
                                <td scope="col">{{ $item['deleted_at']->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <a href="{{ route('items.deleteForce', $item['id']) }}" class="btn btn-danger"
                                        data-confirm-delete="true">{{__('messages.Delete')}}</a>
                                    <a href="{{ route('items.restore', $item['id']) }}" class="btn btn-warning">{{__('messages.Restore')}}</a>
                                </td>
                            @else
                            <tr class="table-success">
                                <td scope="col">{{ $key + 1 }}</td>
                                <td scope="col">{{ $item['name'] }}</td>
                                <td scope="col">{{ $item['details'] }}</td>
                                <td scope="col">{{ $item['price'] . ' ' . $item['currency'] }}</td>
                                <td scope="col">{{ $item['created_at']->format('Y-m-d H:i:s') }}</td>
                                <td scope="col">{{__('messages.Not Archived')}}</td>
                                <td>
                                    <a href="{{ route('items.deleteForce', $item['id']) }}" class="btn btn-danger"
                                        data-confirm-delete="true">{{__('messages.Delete')}}</a>
                                </td>
                        @endif


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>
@endsection
