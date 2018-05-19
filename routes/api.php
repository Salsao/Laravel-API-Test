<?php

Route::get('teams', 'TeamController@index');
Route::get('teams/{team}', 'TeamController@show');
Route::get('teams/{team}/flag', 'TeamController@showFlag');
Route::get('teams/{team}/matches', 'TeamController@showMatches');
Route::post('teams', 'TeamController@store');
Route::post('teams/{team}', 'TeamController@update');
Route::delete('teams/{team}', 'TeamController@delete');

Route::get('matches', 'MatchController@index');
Route::get('matches/{match}', 'MatchController@show');
Route::get('matches/dates/{dateTime}', 'MatchController@showByDate');
Route::post('matches', 'MatchController@store');
Route::post('matches/{match}', 'MatchController@update');
Route::delete('matches/{match}', 'MatchController@delete');