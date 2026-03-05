<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LeadService;

class LeadController extends Controller
{
    protected LeadService $service;

    public function __construct(LeadService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $leads = $this->service->list(['paginate' => true, 'perPage' => 25]);
        return view('leads.index', compact('leads'));
    }

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'user_id' => 'nullable|integer|exists:users,id',
            'source_id' => 'nullable|integer|exists:sources,id',
            'project_id' => 'nullable|integer|exists:projects,id',
            'status' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'lead_date' => 'nullable|date',
        ]);

        $lead = $this->service->create($data);
        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    public function show($id)
    {
        $lead = $this->service->get($id);
        if (!$lead) {
            abort(404);
        }
        return view('leads.show', compact('lead'));
    }

    public function edit($id)
    {
        $lead = $this->service->get($id);
        if (!$lead) {
            abort(404);
        }
        return view('leads.edit', compact('lead'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'contact_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'state' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'user_id' => 'nullable|integer|exists:users,id',
            'source_id' => 'nullable|integer|exists:sources,id',
            'project_id' => 'nullable|integer|exists:projects,id',
            'status' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'lead_date' => 'nullable|date',
        ]);

        $this->service->update($id, $data);
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);
        return redirect()->route('leads.index')->with('success', 'Lead deleted.');
    }
}
