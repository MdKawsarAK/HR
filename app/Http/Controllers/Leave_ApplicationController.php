<?php

namespace App\Http\Controllers;

use App\Models\Leave_Application;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Reason;
use App\Models\Status;
use App\Models\Category;


class Leave_ApplicationController extends Controller
{
    public function index()
    {
        $leave_Applications = Leave_Application::latest()->paginate(10);
        return view('pages.leave__Applications.index', compact('leave_Applications'));
    }

    public function create()
    {
        $people = \App\Models\Person::all();
        $reasons = \App\Models\Reason::all();
        $statuses = \App\Models\Status::all();
        $categories = \App\Models\Category::all();

        return view('pages.leave_Applications.create', [
            'mode' => 'create',
            'leave_Application' => new Leave_Application(),
            'people' => $people,
            'reasons' => $reasons,
            'statuses' => $statuses,
            'categories' => $categories,

        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        Leave_Application::create($data);
        return redirect()->route('leave_Applications.index')->with('success', 'Successfully created!');
    }

    public function show(Leave_Application $leave_Application)
    {
        return view('pages.leave_Applications.view', compact('leave_Application'));
    }

    public function edit(Leave_Application $leave_Application)
    {
        $people = \App\Models\Person::all();
        $reasons = \App\Models\Reason::all();
        $statuses = \App\Models\Status::all();
        $categories = \App\Models\Category::all();

        return view('pages.leave_Applications.edit', [
            'mode' => 'edit',
            'leave_Application' => $leave_Application,
            'people' => $people,
            'reasons' => $reasons,
            'statuses' => $statuses,
            'categories' => $categories,

        ]);
    }

    public function update(Request $request, Leave_Application $leave_Application)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads', 'public');
        }
        $leave_Application->update($data);
        return redirect()->route('leave_Applications.index')->with('success', 'Successfully updated!');
    }

    public function destroy(Leave_Application $leave_Application)
    {
        $leave_Application->delete();
        return redirect()->route('leave_Applications.index')->with('success', 'Successfully deleted!');
    }
}