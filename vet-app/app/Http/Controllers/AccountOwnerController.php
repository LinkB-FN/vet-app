<?php

namespace App\Http\Controllers;

use App\Models\AccountOwner;
use Illuminate\Http\Request;

class AccountOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountOwners = AccountOwner::with('fortniteAccounts')->latest()->paginate(10);
        return view('account-owners.index', compact('accountOwners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('account-owners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discord_username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'region' => 'nullable|string|max:255',
        ]);

        AccountOwner::create($validated);

        return redirect()->route('account-owners.index')
            ->with('success', 'Propietario de cuenta creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountOwner $accountOwner)
    {
        $accountOwner->load('fortniteAccounts.coachingSessions');
        return view('account-owners.show', compact('accountOwner'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountOwner $accountOwner)
    {
        return view('account-owners.edit', compact('accountOwner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AccountOwner $accountOwner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'discord_username' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'region' => 'nullable|string|max:255',
        ]);

        $accountOwner->update($validated);

        return redirect()->route('account-owners.index')
            ->with('success', 'Propietario de cuenta actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountOwner $accountOwner)
    {
        $accountOwner->delete();

        return redirect()->route('account-owners.index')
            ->with('success', 'Propietario de cuenta eliminado exitosamente.');
    }
}
