<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Role();
        $admin->name = 'Administrator';
        $admin->save();

        $director = new Role();
        $director->name = 'Director';
        $director->save();

        $head_teacher = new Role();
        $head_teacher->name = 'Head teacher';
        $head_teacher->save();

        $teacher = new Role();
        $teacher->name = 'Teacher';
        $teacher->save();

        $student = new Role();
        $student->name = 'Student';
        $student->save();
    }
}
