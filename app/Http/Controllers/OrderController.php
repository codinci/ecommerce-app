<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index($total)
    {
        return Inertia::render('Order', [
            'total' => $total,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        Order::create([
            'customer_id' => $user->id,
            'total_amount' => $request->total,
        ]);
        return redirect()->route('dashboard')->with('success', 'Order made successfully!');
    }
}
