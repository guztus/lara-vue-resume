<?php

namespace Database\Seeders;

use App\Models\Basic;
use App\Models\Education;
use App\Models\Resume;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'demo@demo.gz')->first();
        if ($user) {
            $user->delete();
        }

        $user = User::create([
            'name' => 'demo@demo.gz',
            'email' => 'demo@demo.gz',
            'password' => bcrypt('demo@demo.gz')
        ]);

        $this->createCompleteResume($user);
        $this->createInCompleteResume($user);
    }

    private function createCompleteResume($user) {
        $resume = $user->resume()->create([
            'name' => 'Dec/2023',
        ]);

        Basic::create([
            'resume_id' => $resume->id,
            'name' => 'Gustavs',
            'surname' => 'Zubars',
            'email' => 'gustavs.zubars@gmail.com',
            'phoneNumber' => '28343205',
            'website' => 'github.com/guztus',
            'address' => null,
            'country' => null,
            'city' => 'Riga',
            'zipcode' => null,
        ]);

        Education::create([
            'resume_id' => $resume->id,
            'school' => 'Rīgas Valsts tehnikums',
            'faculty' => 'Finanses',
            'direction' => 'Grāmatvedība',
            'from' => '09/2018',
            'to' => '06/2022',
            'level' => null,
        ]);

        Work::create([
            'resume_id' => $resume->id,
            'employer' => 'CODELEX',
            'position' => 'Software Developer',
            'type' => null,
            'currentlyActive' => false,
            'from' => '10/2022',
            'to' => '03/2023',
            'description' => 'A part of a team working on maintaining e-commerce sites as well as
developing an e-commere platform. I work on the backend (PHP,
Laravel, MySQL) as well as the frontend (Javascript, JQuery, Twig,
Blade).
* Various API integrations
* Code optimization and refactoring
* Object oriented programming
* Projects with MVC architecture',
        ]);

        Work::create([
            'resume_id' => $resume->id,
            'employer' => 'WebDev.lv',
            'position' => 'Software Developer',
            'type' => null,
            'currentlyActive' => true,
            'from' => '03/2023',
            'to' => null,
            'description' => 'Development using backend (PHP, Laravel, MySQL) and frontend
(Javascript, JQuery, Blade, Vue.Js)
* Object oriented programming
* Plain PHP MVC projects
* Projects with Laravel, Vue.js
* REST API implementation, as well as integration',
        ]);
    }

    private function createIncompleteResume($user) {
        $resume = $user->resume()->create([
            'name' => 'Incomplete resume',
        ]);

        Basic::create([
            'resume_id' => $resume->id,
            'name' => 'Gustavs',
            'surname' => 'Zubars',
            'email' => 'gustavs.zubars@gmail.com',
            'phoneNumber' => '28343205',
            'website' => 'github.com/guztus',
            'address' => null,
            'country' => null,
            'city' => 'Riga',
            'zipcode' => null,
        ]);

        Education::create([
            'resume_id' => $resume->id,
            'school' => 'Uni',
            'faculty' => 'Finanses',
            'direction' => 'd',
            'from' => '09/2018',
            'to' => '06/2022',
            'level' => null,
        ]);

        Education::create([
            'resume_id' => $resume->id,
            'school' => 'School',
            'faculty' => 'Finanses',
            'direction' => 'Ekonomika',
            'from' => '09/2018',
            'to' => null,
            'level' => null,
        ]);

        Education::create([
            'resume_id' => $resume->id,
            'school' => 'School',
            'faculty' => '',
            'direction' => 'Ec',
            'from' => '09/2018',
            'to' => null,
            'level' => null,
        ]);
    }
}
