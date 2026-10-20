<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        $user = request()->user();

        // Cashier accounts start at the register; management accounts get the dashboard.
        if ($user->can('access pos') && ! $user->can('manage menu')) {
            return redirect()->route('pos');
        }

        if ($user->can('view kitchen display') && ! $user->can('manage menu')) {
            return redirect()->route('kitchen.display');
        }

        return view('dashboard.index');
    }
}
