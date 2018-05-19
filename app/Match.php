<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
	protected $fillable = ['team_a_id', 'team_b_id', 'datetime'];

  public $timestamps = false;
}
