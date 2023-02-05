<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $items = Item::where('status', 1)
                ->oredrBy('created_at', 'DESC')
                ->limit(7)
                ->get();

        $popular_items = Item::select(DB::raw('items.*, count(*) as `views_count`'))
                        ->join('views', 'items.id', '=', 'views.item_id')
                        ->groupBy('item_id')
                        ->orderBy('views_count', 'DESC')
                        ->get();

        return view('pages.home', compact('recently_added_items', 'popular_items'));
    }

    public function get_all_users()
    {
        $users = User::with('items')->get();

        return view('pages.user.list', compact('users'));
    }

}
