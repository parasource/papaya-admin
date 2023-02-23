<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alert;
use Illuminate\Http\Request;

class AlertsController extends Controller
{

    public function index()
    {
        $alerts = Alert::all();
        return view('admin.alerts.index', compact('alerts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [

        ]);

        Alert::create([
            'type' => $request['type'],
            'title' => $request['title'],
            'text' => $request['text']
        ]);

        return redirect()->route('admin.alerts.index');
    }

    public function create()
    {
        $types = Alert::typesList();
        return view('admin.alerts.create', compact('types'));
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();

        return redirect()->route('admin.alerts.index');
    }
}
