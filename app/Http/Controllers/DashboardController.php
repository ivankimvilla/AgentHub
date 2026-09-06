<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use App\Models\Agent;
use App\Models\SocialAccount;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('layouts.app', [
            'queue' => ContentItem::latest()->with('publishLogs')->get(),
            'agents' => Agent::where('active', true)->orderBy('name')->get(),
            'socialAccounts' => SocialAccount::latest()->get(),
        ]);
    }
}
