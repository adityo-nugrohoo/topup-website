<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'game' => 'required|string',
            'player_id' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        Transaction::create([
            'user_id' => Auth::id(),
            'game' => $request->game,
            'player_id' => $request->player_id,
            'amount' => $request->amount,
            'status' => 'Diproses',
        ]);

        return redirect()->route('dashboard')->with('success', 'Top up berhasil diajukan!');
    }
}
