<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        $seasons = $series->seasons()->with('episodes')->get();

        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('serie', $series);
    }

    // public function index(int $series)
    // {
    //     $seasons = Season::query()
    //         ->with('episodes')
    //         ->where('series_id', $series)
    //         ->get();

    //     return view('seasons.index')
    //         ->with('seasons', $seasons);
    // }
}
