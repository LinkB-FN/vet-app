<?php

namespace App\Http\Controllers;

use App\Models\FortniteAccount;
use App\Models\AccountOwner;
use Illuminate\Http\Request;

class FortniteAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fortniteAccounts = FortniteAccount::with('accountOwner')->latest()->paginate(10);
        return view('fortnite-accounts.index', compact('fortniteAccounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountOwners = AccountOwner::orderBy('name')->get();
        return view('fortnite-accounts.create', compact('accountOwners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'epic_username' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'account_created_date' => 'nullable|date',
            'account_owner_id' => 'required|exists:account_owners,id',
            'notes' => 'nullable|string',
        ]);

        FortniteAccount::create($validated);

        return redirect()->route('fortnite-accounts.index')
            ->with('success', 'Cuenta de Fortnite creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FortniteAccount $fortniteAccount)
    {
        $fortniteAccount->load('accountOwner', 'coachingSessions.coach');
        return view('fortnite-accounts.show', compact('fortniteAccount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FortniteAccount $fortniteAccount)
    {
        $accountOwners = AccountOwner::orderBy('name')->get();
        return view('fortnite-accounts.edit', compact('fortniteAccount', 'accountOwners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FortniteAccount $fortniteAccount)
    {
        $validated = $request->validate([
            'epic_username' => 'required|string|max:255',
            'platform' => 'required|string|max:255',
            'rank' => 'nullable|string|max:255',
            'account_created_date' => 'nullable|date',
            'account_owner_id' => 'required|exists:account_owners,id',
            'notes' => 'nullable|string',
        ]);

        $fortniteAccount->update($validated);

        return redirect()->route('fortnite-accounts.index')
            ->with('success', 'Cuenta de Fortnite actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FortniteAccount $fortniteAccount)
    {
        $fortniteAccount->delete();

        return redirect()->route('fortnite-accounts.index')
            ->with('success', 'Cuenta de Fortnite eliminada exitosamente.');
    }
}
