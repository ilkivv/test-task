<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission1 = new Permission();
        $permission1->name = 'Access to permissions';
        $permission1->save();

        $permission2 = new Permission();
        $permission2->name = 'Access to CRUD students';
        $permission2->save();
    }
}
