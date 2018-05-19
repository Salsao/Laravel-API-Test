<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        return Match::all();
    }

    public function show(Match $match)
    {
        return $match;
    }

    public function showByDate($datetime)
    {
        return Match::whereDate('datetime', '=', $datetime)->get();
    }

    public function store(Request $request)
    {
        $match = Match::create($request->all());

        return response()->json($match, 201);
    }

    public function update(Request $request, Match $match)
    {
        $match->update($request->all());

        return response()->json($match, 200);
    }

    public function delete(Match $match)
    {
        $match->delete();

        return response()->json(null, 204);
    }
}
