<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $school1 = new School();
        $school1->name = 'Школа 55';
        $school1->open = date('d-m-Y', strtotime('01-01-2015'));
        $school1->close = null;
        $school1->number_of_students = 4;
        $school1->save();

        $school2 = new School();
        $school2->name = 'Школа 7';
        $school2->open = date('d-m-Y', strtotime('01-01-2015'));
        $school2->close = null;
        $school2->number_of_students = 4;
        $school2->save();
    }
}