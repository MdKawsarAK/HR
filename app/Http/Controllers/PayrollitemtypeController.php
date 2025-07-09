<?php

namespace App\Http\Controllers;

use App\Models\Payrollitemtype;
use Illuminate\Http\Request;


class PayrollitemtypeController extends Controller
{
    public function index()
    {
        $payrollitemtypes = Payrollitemtype::orderBy('id','desc')->paginate(10);
        return view('pages.payrollitemtypes.index', compact('payrollitemtypes'));
    }

    public function create()
    {

        return view('pages.payrollitemtypes.create', [
            'mode' => 'create',
            'payrollitemtype' => new Payrollitemtype(),

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Payrollitemtype::create($data);
        return redirect()->route('payrollitemtypes.index')->with('success', 'Successfully created!');
    }

    public function show(Payrollitemtype $payrollitemtype)
    {
        return view('pages.payrollitemtypes.view', compact('payrollitemtype'));
    }

    public function edit(Payrollitemtype $payrollitemtype)
    {

        return view('pages.payrollitemtypes.edit', [
            'mode' => 'edit',
            'payrollitemtype' => $payrollitemtype,

        ]);
    }

    public function update(Request $request, Payrollitemtype $payrollitemtype)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $payrollitemtype->update($data);
        return redirect()->route('payrollitemtypes.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Payrollitemtype $payrollitemtype)
    {
        $payrollitemtype->delete();
        return redirect()->route('payrollitemtypes.index')->with('success', 'Successfully deleted!');
    }
}