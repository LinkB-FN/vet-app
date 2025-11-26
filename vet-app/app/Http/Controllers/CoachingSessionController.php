<?php

namespace App\Http\Controllers;

use App\Models\CoachingSession;
use App\Models\FortniteAccount;
use App\Models\User;
use Illuminate\Http\Request;

class CoachingSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coachingSessions = CoachingSession::with('fortniteAccount.accountOwner', 'coach')
            ->latest('session_date')
            ->paginate(10);
        return view('coaching-sessions.index', compact('coachingSessions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fortniteAccounts = FortniteAccount::with('accountOwner')->get();
        $coaches = User::whereIn('role', ['admin', 'staff'])->orderBy('name')->get();
        return view('coaching-sessions.create', compact('fortniteAccounts', 'coaches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fortnite_account_id' => 'required|exists:fortnite_accounts,id',
            'coach_id' => 'nullable|exists:users,id',
            'session_date' => 'required|date',
            'session_type' => 'required|string|max:255',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        CoachingSession::create($validated);

        return redirect()->route('coaching-sessions.index')
            ->with('success', 'Sesión de coaching creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CoachingSession $coachingSession)
    {
        $coachingSession->load('fortniteAccount.accountOwner', 'coach');
        return view('coaching-sessions.show', compact('coachingSession'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoachingSession $coachingSession)
    {
        $fortniteAccounts = FortniteAccount::with('accountOwner')->get();
        $coaches = User::whereIn('role', ['admin', 'staff'])->orderBy('name')->get();
        return view('coaching-sessions.edit', compact('coachingSession', 'fortniteAccounts', 'coaches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CoachingSession $coachingSession)
    {
        $validated = $request->validate([
            'fortnite_account_id' => 'required|exists:fortnite_accounts,id',
            'coach_id' => 'nullable|exists:users,id',
            'session_date' => 'required|date',
            'session_type' => 'required|string|max:255',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $coachingSession->update($validated);

        return redirect()->route('coaching-sessions.index')
            ->with('success', 'Sesión de coaching actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CoachingSession $coachingSession)
    {
        $coachingSession->delete();

        return redirect()->route('coaching-sessions.index')
            ->with('success', 'Sesión de coaching eliminada exitosamente.');
    }
}
