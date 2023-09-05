<h1>{{ __('messages.Accounting System') }}</h1>
<h3>Invoice</h3>
<div class="container-fluid table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">reference number#</th>
                <th scope="col">customer name</th>
                <th scope="col">company</th>
                <th scope="col">phone</th>
                <th scope="col">email</th>
                <th scope="col">status</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{ $sales->ref_number }}</th>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->company }}</td>
                <td>{{ $customer->phone_number }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $sales->status }}</td>

            </tr>
        </tbody>
    </table>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">item name</th>
                <th scope="col">quantity</th>
                <th scope="col">{{ __('messages.Details') }}</th>
                <th scope="col">unit price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
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
                <th scope="col">sale_date</th>
                <th scope="col">shipping_address</th>
                <th scope="col">shipping_price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sales->sale_date }}</td>
                <td>{{ $sales->shipping_address }}</td>
                @if ($items != null)
                    <td>{{ $sales->shipping_price . ' ' . $items[0]->currency }}</td>
                @else
                    <td>Item Deleted</td>
                @endif
            </tr>
        </tbody>
    </table>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">tax</th>
                <th scope="col">discount</th>
                <th scope="col">total_price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $sales->tax }}</td>
                <td>{{ $sales->discount }}</td>
                @if ($items != null)
                    <td>{{ $sales->total_amount . ' ' . $items[0]->currency }}</td>
                    @else
                    <td>Item Deleted</td>
                @endif
            </tr>
        </tbody>
    </table>
</div>
