<?php

namespace App\Http\Controllers;

use App\Models\Psychologist;

use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    public function index()
    {
        $psychologists = Psychologist::all();
        return view('psychologists.index', compact('psychologists'));
    }

    public function show($id)
    {
        $psychologist = Psychologist::findOrFail($id);
        return view('psychologists.show', compact('psychologist'));
    }

    public function search(Request $request)
    {
        $query = Psychologist::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('specialty')) {
            $query->where('specialty', 'like', '%' . $request->specialty . '%');
        }

        $psychologists = $query->get();

        return view('psychologists.index', compact('psychologists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_url' => 'nullable|url|max:255',
            'specialty' => 'nullable|string|max:255',
            'approach' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'languages' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'studies' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        // Allow adding psychologist without login, assign default user_id if not logged in
        $defaultUserId = 1; // Set this to a valid user ID in your system to act as default
        $validated['user_id'] = auth()->id() ?? $defaultUserId;

        // Set default values for NOT NULL columns if missing
        if (empty($validated['specialty'])) {
            $validated['specialty'] = '';
        }
        if (empty($validated['approach'])) {
            $validated['approach'] = '';
        }
        if (!isset($validated['experience']) || $validated['experience'] === null) {
            $validated['experience'] = 0;
        }
        if (empty($validated['languages'])) {
            $validated['languages'] = '';
        }
        if (!isset($validated['age']) || $validated['age'] === null) {
            $validated['age'] = 0;
        }
        if (empty($validated['studies'])) {
            $validated['studies'] = '';
        }
        if (empty($validated['bio'])) {
            $validated['bio'] = '';
        }
        

        Psychologist::create($validated);

        return redirect()->route('psychologists.index')->with('success', 'Psychologist added successfully.');
    }

    // Removed or fixed favorite method as it had errors

    public function edit($id)
    {
        $psychologist = Psychologist::findOrFail($id);
        return view('psychologists.edit', compact('psychologist'));
    }

    public function update(Request $request, $id)
    {
        $psychologist = Psychologist::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'photo_url' => 'nullable|url|max:255',
            'specialty' => 'nullable|string|max:255',
            'approach' => 'nullable|string|max:255',
            'experience' => 'nullable|integer|min:0',
            'languages' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'studies' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
        ]);

        // Set default values for NOT NULL columns if missing
        if (empty($validated['specialty'])) {
            $validated['specialty'] = '';
        }
        if (empty($validated['approach'])) {
            $validated['approach'] = '';
        }
        if (!isset($validated['experience']) || $validated['experience'] === null) {
            $validated['experience'] = 0;
        }
        if (empty($validated['languages'])) {
            $validated['languages'] = '';
        }
        if (!isset($validated['age']) || $validated['age'] === null) {
            $validated['age'] = 0;
        }
        if (empty($validated['studies'])) {
            $validated['studies'] = '';
        }
        if (empty($validated['bio'])) {
            $validated['bio'] = '';
        }

        $psychologist->update($validated);

        return redirect()->route('psychologists.index')->with('success', 'Psychologist updated successfully.');
    }
}
