@extends('layouts.nav')
@section('nav')
    <div class="container-fluid">
        <h1>{{ __('messages.Items') }}</h1>
            <a href="{{ route('items.create') }}" class="btn btn-success">{{__('messages.Add New Item')}}</a>
            <a href="{{ route('items.deletedItems') }}" class="btn btn-primary float-end">{{__('messages.go to archive')}} -></a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('messages.Name') }}</th>
                    <th scope="col">{{ __('messages.Details') }}</th>
                    <th scope="col">{{ __('messages.Price') }}</th>
                    <th scope="col">{{__('messages.Created_At')}}</th>
                    <th scope="col">{{(__('messages.Actions'))}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <td scope="col">{{ $key + 1 }}</td>
                        <td scope="col">{{ $item['name'] }}</td>
                        <td scope="col">{{ $item['details'] }}</td>
                        <td scope="col">{{ $item['price'] . ' ' . $item['currency'] }}</td>
                        <td scope="col">{{ $item['created_at']->format('Y-m-d H:i') }}</td>
                        <td>
                            <a href="{{ route('items.delete', $item['id']) }}" class="btn btn-danger"
                                data-confirm-delete="true">{{__('messages.archive')}}</a>
                            <a href="{{ route('items.edit', $item['id']) }}" class="btn btn-warning">{{__('messages.Edit')}}</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
