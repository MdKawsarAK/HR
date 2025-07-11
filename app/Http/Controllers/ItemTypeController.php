<?php

namespace App\Http\Controllers;

use App\Models\ItemType;
use Illuminate\Http\Request;


class ItemTypeController extends Controller
{
    public function index()
    {
        $itemTypes = ItemType::orderBy('id','desc')->paginate(10);
        return view('pages.item_Types.index', compact('item_Types'));
    }

    public function create()
    {

        return view('pages.item_Types.create', [
            'mode' => 'create',
            'itemType' => new ItemType(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        ItemType::create($data);
        return redirect()->route('item_Types.index')->with('success', 'Successfully created!');
    }

    public function show(ItemType $itemType)
    {
        return view('pages.item_Types.view', compact('itemType'));
    }

    public function edit(ItemType $itemType)
    {

        return view('pages.item_Types.edit', [
            'mode' => 'edit',
            'itemType' => $itemType,

        ]);
    }

    public function update(Request $request, ItemType $itemType)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $itemType->update($data);
        return redirect()->route('item_Types.index')->with('success', 'Successfully updated!');
    }

    public function destroy(ItemType $itemType)
    {
        $itemType->delete();
        return redirect()->route('item_Types.index')->with('success', 'Successfully deleted!');
    }
}