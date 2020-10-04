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
        $admin->slug = 'administrator';
        $admin->save();

        $director = new Role();
        $director->name = 'Director';
        $director->slug = 'director';
        $director->save();

        $head_teacher = new Role();
        $head_teacher->name = 'Head teacher';
        $head_teacher->slug = 'head-teacher';
        $head_teacher->save();

        $teacher = new Role();
        $teacher->name = 'Teacher';
        $teacher->slug = 'teacher';
        $teacher->save();

        $student = new Role();
        $student->name = 'Student';
        $student->slug = 'student';
        $student->save();
    }
}
