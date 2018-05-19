<?php

namespace App\Http\Controllers;

use App\Team;
use App\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use finfo;

class TeamController extends Controller
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
                'name' => 'required',
                'image' => 'required|image|max:16000'
            ],[
                'name.required' => 'Team name is required.',
                'image.required' => 'Image is required.',
                'image.image' => 'Image must be in an image extension.',
                'image.max' => 'Image exceeds maximum size(16 megabytes).'
        ]);
    }

    public function index()
    {
        $teams = Team::all();

        foreach($teams as $team) {
            $team->image = 'api/teams/'.$team->id.'/flag';
        }

        return $teams;
    }

    public function show(Team $team)
    {
    	$team->image = 'api/teams/'.$team->id.'/flag';

        return $team;
    }

    public function showFlag(Team $team)
    {
    	$team = Team::find($team->id);

	    return response()->make($team->image, 200, array(
	        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($team->image)
	    ));
    }

    public function showMatches(Team $team)
    {
    	return Match::where('team_a_id', '=', $team->id)->orWhere('team_b_id', '=', $team->id)->get();
    }

    public function store(Request $request)
    {
        $validator = $this->checkFields($request);

        if ($validator->fails()) {
            return $this->errorMessage($validator->messages());
        }

        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());

		$team = Team::create($request->all());

		$teamUpdate = Team::find($team->id);
        $teamUpdate->image = $contents;
        $teamUpdate->save();

		$team->image = 'api/teams/'.$team->id.'/flag';

		return response()->json($team, 201);
    }

    public function update(Request $request, Team $team)
    {
        $validator = $this->checkFields($request);

        if ($validator->fails()) {
            return $this->errorMessage($validator->messages());
        }

        $file = $request->file('image');
        $contents = $file->openFile()->fread($file->getSize());

    	$teamUpdate = Team::find($team->id);
    	$teamUpdate->name = $request->name;
        $teamUpdate->image = $contents;
        $teamUpdate->save();

        $teamUpdate->image = 'api/teams/'.$team->id.'/flag';    

        return response()->json($teamUpdate, 200);
    }

    public function delete(Team $team)
    {
        $team->delete();

        return response()->json(null, 204);
    }
}
