<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRules;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    public function index()
    {

        $sales = Sale::all();
        $title = 'add to archive!';
        $text = "Are you sure you want to archive this Sale?";
        confirmDelete($title, $text);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $items = Item::all();
        return view('sales.create', compact('customers', 'items'));
    }

    private function sum($discount, $tax, $priceInQuan, $shipping_price)
    {
        $feesSum = 1 - ($discount / 100);
        $taxesSum = 1 + ($tax / 100);
        $total_price =  $feesSum * $taxesSum * $priceInQuan;
        $result = $total_price - $shipping_price;
        return $result;
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, ValidationRules::rulesSale());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // start sum of total price of invoice
        $quantities = $request->input('quantity');
        $filteredQuantities = array_values(array_filter($quantities, function ($quantity) {
            return $quantity !== null;
        }));

        $items = $request->input('item_id');
        $arr_price_quan = [];
        
        foreach ($items as $key => $item) {
            $total_price_sale_item = $filteredQuantities[$key] * Item::find($item)->price;
            array_push($arr_price_quan, $total_price_sale_item);
        }
        $arr_price_quan_res = array_sum($arr_price_quan);
        $total_price =  $this->sum($request->input('discount'), $request->input('tax'), $arr_price_quan_res, $request->input('shipping_price'));
        // end sum of total price of invoice


        $sale = Sale::create([
            'customer_id' => $request->input('customer_id'),
            'sale_date' => $request->input('sale_date'),
            'status' => $request->input('status'),
            'note' => $request->input('note'),
            'discount' => $request->input('discount'),
            'tax' => $request->input('tax'),
            'ref_number' => rand(1, 99999999) . Str::random(4),
            'quantity_items' => count($items),
            'shipping_address' => $request->input('shipping_address'),
            'shipping_price' => $request->input('shipping_price'),
            'total_amount' => $total_price,
        ]);


        foreach ($items as $key => $item) {
            SaleItem::create([
                'customer_id' => $request->input('customer_id'),
                'sales_id' => $sale->id,
                'items_id' => $item,
                'quantity' => $filteredQuantities[$key],
                'unit_price' => Item::find($item)->price,
                'total_price' => $filteredQuantities[$key] * Item::find($item)->price,
            ]);
        }
        Alert::success('invoice', 'has been created');
        return redirect('/sales');
    }



    public function viewSale($sale_id, $customer_id)
    {
        // getting sales_table data
        $sales_items_array = [];
        foreach (SaleItem::all() as $SaleItemValue) {
            if ($SaleItemValue->sales_id == $sale_id) {
                array_push($sales_items_array, $SaleItemValue);
            }
        }
        $sales = Sale::find($sale_id);

        // getting sales_items_table data
        $sales_items = $sales_items_array;

        // getting customers_table data
        $customer = Customer::find($customer_id);

        // getting items_table data
        $items_array = [];
        foreach (SaleItem::all() as $SaleItemValue) {
            if ($SaleItemValue->sales_id == $sale_id) {
                if (Item::all()->find($SaleItemValue->items_id) != null) {
                    array_push($items_array, Item::all()->find($SaleItemValue->items_id));
                }
            }
        }
        $items = $items_array;
        return view('sales.viewSale', compact('sales', 'sales_items', 'customer', 'items'));
    }

    public function update(Request $request)
    {
        $sales = Sale::find($request->input('id'));
        Alert::success($sales["name"], 'has been updated');
        $sales->status = $request['status'];
        $sales->update();
        return redirect('/sales');
    }

    public function generatePdfviewSale($sale_id, $customer_id)
    {
        // getting sales_table data
        $sales_items_array = [];
        foreach (SaleItem::all() as $SaleItemValue) {
            if ($SaleItemValue->sales_id == $sale_id) {
                array_push($sales_items_array, $SaleItemValue);
            }
        }
        $sales = Sale::find($sale_id);

        // getting sales_items_table data
        $sales_items = $sales_items_array;

        // getting customers_table data
        $customer = Customer::find($customer_id);

        // getting items_table data
        $items_array = [];
        foreach (SaleItem::all() as $SaleItemValue) {
            if ($SaleItemValue->sales_id == $sale_id) {
                if (Item::all()->find($SaleItemValue->items_id) != null) {
                    array_push($items_array, Item::all()->find($SaleItemValue->items_id));
                }
            }
        }
        $items = $items_array;



        $data = [
            'sales' => $sales,
            'items' => $items,
            'customer' => $customer,
            'sales_items' => $sales_items,
        ];
        $html = View::file(resource_path('views/sales/viewSalePDF.blade.php'), $data)->render();
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = 'invoiceSale.pdf';
        $dompdf->stream($filename);
    }
}
