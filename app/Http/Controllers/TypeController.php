<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;


class TypeController extends Controller
{
    public function index()
    {
        $types = Type::orderBy('id','desc')->paginate(10);
        return view('pages.types.index', compact('types'));
    }

    public function create()
    {

        return view('pages.types.create', [
            'mode' => 'create',
            'type' => new Type(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Type::create($data);
        return redirect()->route('types.index')->with('success', 'Successfully created!');
    }

    public function show(Type $type)
    {
        return view('pages.types.view', compact('type'));
    }

    public function edit(Type $type)
    {

        return view('pages.types.edit', [
            'mode' => 'edit',
            'type' => $type,

        ]);
    }

    public function update(Request $request, Type $type)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $type->update($data);
        return redirect()->route('types.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Type $type)
    {
        $type->delete();
        return redirect()->route('types.index')->with('success', 'Successfully deleted!');
    }
}