<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lesson1 = new Lesson();
        $lesson1->name = 'Математика';
        $lesson1->slug = 'mathematics';
        $lesson1->save();

        $lesson2 = new Lesson();
        $lesson2->name = 'Русский язык';
        $lesson2->slug = 'russian_language';
        $lesson2->save();

        $lesson3 = new Lesson();
        $lesson3->name = 'Литература';
        $lesson3->slug = 'literature';
        $lesson3->save();

        $lesson4 = new Lesson();
        $lesson4->name = 'Физкультура';
        $lesson4->slug = 'physical_culture';
        $lesson4->save();

        $lesson5 = new Lesson();
        $lesson5->name = 'История';
        $lesson5->slug = 'history';
        $lesson5->save();

        $lesson6 = new Lesson();
        $lesson6->name = 'География';
        $lesson6->slug = 'geography';
        $lesson6->save();

        $lesson7 = new Lesson();
        $lesson7->name = 'ОБЖ';
        $lesson7->slug = 'life_safety';
        $lesson7->save();

        $lesson8 = new Lesson();
        $lesson8->name = 'Труд';
        $lesson8->slug = 'labour';
        $lesson8->save();
    }
}
