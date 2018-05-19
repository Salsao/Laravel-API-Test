<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatchController extends Controller
{
    private function errorMessage($message)
    {
        return response()->json(array(
                'status' => 'error',
                'message' => $message
            ), 500);
    }

    public function checkFields($request) 
    {
        return Validator::make($request->all(), [
                'team_a_id' => 'required|exists:teams,id|different:team_b_id',
                'team_b_id' => 'required|exists:teams,id',
                'datetime' => 'required|date_format:Y-m-d H:i:s'
            ],[
                'team_a_id.required' => 'Team A is required.',
                'team_a_id.exists' => 'Team A doesn\'t exist.',
                'team_a_id.different' => 'The teams must be different.',
                'team_b_id.required' => 'Team B is required.',
                'team_b_id.exists' => 'Team B doesn\'t exist.',
                'datetime.date_format' => 'The date does not match the format YYYY-mm-dd HH:MM:SS.'
        ]);
    }

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
        $validator = $this->checkFields($request);

        if ($validator->fails()) {
            return $this->errorMessage($validator->messages());
        }

        $match = Match::create($request->all());

        return response()->json($match, 201);
    }

    public function update(Request $request, Match $match)
    {
        $validator = $this->checkFields($request);

        if ($validator->fails()) {
            return $this->errorMessage($validator->messages());
        }

        $match->update($request->all());

        return response()->json($match, 200);
    }

    public function delete(Match $match)
    {
        $match->delete();

        return response()->json(null, 204);
    }
}
