<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRules;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        $title = 'add to archive!';
        $text = "Are you sure you want to archive it?";
        confirmDelete($title, $text);
        return view('items.index', compact('items'));
    }
    public function create()
    {
        return view('items.create');
    }
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, ValidationRules::rulesItem());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        $item = Item::create([
            'name' => $request->input('name'),
            'details' => $request->input('details'),
            'price' => $request->input('price'),
            'currency' => $request->input('currency'),
        ]);
        Alert::success($item["name"], 'has been added');
        return redirect('/items');
    }
    public function delete($id)
    {
        $items = Item::find($id);
        $items->delete();
        return redirect('/items');
    }

    public function deletedItems()
    {
        $allItems = Item::withTrashed()->get();
        $title = 'Delete Item!';
        $text = "Are you sure you want to delete it?";
        confirmDelete($title, $text);
        return view('items.deletedItems', compact('allItems'));
    }

    public function deleteForce($id)
    {
        $items = Item::withTrashed()->find($id);
        $items->forceDelete();
        return redirect('items/deletedItems');
    }
    public function deletedFilter(Request $request)
    {
        if ($request->input('deletedFilter') == 'deleted') {
            $allItems = Item::onlyTrashed()->get();
            return view('items.deletedItems', compact('allItems'));
        } else if ($request->input('deletedFilter') == 'notDeleted') {
            $allItems = Item::withoutTrashed()->get();
            return view('items.deletedItems', compact('allItems'));
        }
    }


    public function edit($id)
    {
        $item = Item::withTrashed()->find($id);
        return view('items.edit', compact('item'));
    }
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, ValidationRules::rulesItem());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $item = Item::withTrashed()->find($id);
        Alert::success($item["name"], 'has been updated');
        $item->name = $request['name'];
        $item->details = $request['details'];
        $item->price = $request['price'];
        $item->currency = $request['currency'];
        $item->update();
        return redirect('/items');
    }
    public function restore($id)
    {
        $item = Item::withTrashed()->find($id);
        $item->restore();
        Alert::success($item["name"], 'has been Restored');
        return redirect('/items');
    }
}
