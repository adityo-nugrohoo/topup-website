<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class TransactionController extends Controller
{
    public function create()
    {
        return view('topup');
    }

    public function store(Request $req)
    {
        try {
            // Validasi input
            $data = $req->validate([
                'game' => 'required|string|max:255',
                'player_id' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'amount' => 'required|numeric|min:1',
                'payment_method' => 'required|string|max:50',
            ]);

            // Simpan data transaksi
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->game = $data['game'];
            $transaction->player_id = $data['player_id'];
            $transaction->email = $data['email'];
            $transaction->amount = $data['amount'];
            $transaction->payment_method = $data['payment_method'];
            $transaction->status = 'Diproses';
            $transaction->save();

            // Redirect ke dashboard dengan notifikasi sukses
            return redirect()->route('dashboard')->with('success', 'Top Up berhasil dilakukan dan sedang diproses!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan transaksi. Silakan coba lagi.');
        }
    }

    public function dashboard()
    {
        Carbon::setLocale('id');

        $transactions = Transaction::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $totalUsers = User::count();
        $totalNominalTopUp = Transaction::where('status', 'Sukses')->sum('amount');

        return view('dashboard', compact('transactions', 'totalUsers', 'totalNominalTopUp'));
    }
}
