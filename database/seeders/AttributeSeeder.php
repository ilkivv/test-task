<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $attribute1 = new Attribute();
        $attribute1->name = 'Date of employment';
        $attribute1->save();

        $attribute2 = new Attribute();
        $attribute2->name = 'Date of dismissal';
        $attribute2->save();

        $attribute3 = new Attribute();
        $attribute3->name = 'Date of receipt';
        $attribute3->save();

        $attribute4 = new Attribute();
        $attribute4->name = 'Class';
        $attribute4->save();

        $attribute5 = new Attribute();
        $attribute5->name = 'Parallel';
        $attribute5->save();
    }
}
