<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\ItemType;


class ItemController extends Controller
{
    public function index()
    {
        $items = Item::orderBy('id','desc')->paginate(10);
        return view('pages.items.index', compact('items'));
    }

    public function create()
    {
        $itemTypes = \App\Models\ItemType::all();

        return view('pages.items.create', [
            'mode' => 'create',
            'item' => new Item(),
            'itemTypes' => $itemTypes,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Item::create($data);
        return redirect()->route('items.index')->with('success', 'Successfully created!');
    }

    public function show(Item $item)
    {
        return view('pages.items.view', compact('item'));
    }

    public function edit(Item $item)
    {
        $itemTypes = \App\Models\ItemType::all();

        return view('pages.items.edit', [
            'mode' => 'edit',
            'item' => $item,
            'itemTypes' => $itemTypes,

        ]);
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $item->update($data);
        return redirect()->route('items.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Successfully deleted!');
    }
}