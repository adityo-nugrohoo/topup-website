<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopupController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'game' => 'required|string',
            'player_id' => 'required|string',
            'email' => 'required|email',
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Simpan ke database
        DB::table('topups')->insert([
            'game' => $request->game,
            'player_id' => $request->player_id,
            'email' => $request->email,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Top Up berhasil disimpan!');
    }
}
