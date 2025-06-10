<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();

        return view('dashboard', [
            'transactions' => $transactions,
            'totalUsers' => User::count()
        ]);
    }
}