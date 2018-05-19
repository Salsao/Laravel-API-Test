# Laravel-API-Test
Test for using Laravel to create an API to create teams and matches for the World Cup. Only back-end.

CRUD for
  * **Team:** name and image(flag);
  * **Match:** team_a_id, team_b_id and datetime;
  
## How to execute
1. Configure the database in the .env file. (line 9 to line 14)
2. Run the command 'php artisan serve' to run the server of the application
3. Run the command 'php artisan migrate' to create a database with all the tables you need to run the application

## API examples


**Get all teams:**
GET api/teams

**Get one team:**
GET api/teams/{id}

**Get one team's flag:**
GET api/teams/{id}/flag

**Get all team's matches:**
GET api/teams/{id}/matches

**Post one team:**
POST api/teams

**Update one team:**
POST* api/teams/{id}

**Delete one team:**
DELETE api/teams/{id}

**Get all the matches:**
GET api/matches

**Get one match:**
GET api/matches/{id}

**Get all the matches in some date:**
GET api/matches/dates/{date}   Ex.:2018-05-22

**Post one match:**
POST api/matches

**Update one match:**
POST* api/matches/{id}

**Delete one match:**
DELETE api/matches/{id}

`*` It's back-end only, so I had to do it POST instead of PUT/PATCH. [How to make PUT/PATCH work with front-end](https://laravel.com/docs/5.2/routing#form-method-spoofing).

## Built With

* [Laravel](https://laravel.com/)
