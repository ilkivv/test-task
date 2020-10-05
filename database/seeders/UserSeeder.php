<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Lesson;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = Role::where('name','Administrator')->first();
        $director = Role::where('name', 'Director')->first();
        $head_teacher = Role::where('name','Head teacher')->first();
        $teacher = Role::where('name','Teacher')->first();
        $student = Role::where('name','Student')->first();

        $access_to_permissions = Permission::where('name','Access to permissions')->first();
        $acsess_to_crud_students = Permission::where('name','Access to CRUD students')->first();

        $date_of_employment = Attribute::where('name','Date of employment')->first();
        $date_of_dismissal = Attribute::where('name','Date of dismissal')->first();
        $date_of_receipt = Attribute::where('name','Date of receipt')->first();
        $class = Attribute::where('name','Class')->first();
        $parallel = Attribute::where('name','Parallel')->first();

        $mathematics = Lesson::where('slug','mathematics')->first();
        $russian_language = Lesson::where('slug','russian_language')->first();
        $literature = Lesson::where('slug','literature')->first();
        $physical_culture = Lesson::where('slug','physical_culture')->first();
        $history = Lesson::where('slug','history')->first();
        $geography = Lesson::where('slug','geography')->first();
        $life_safety = Lesson::where('slug','life_safety')->first();
        $labour = Lesson::where('slug','labour')->first();

        $user1 = new User();
        $user1->email = 'admin@admin.com';
        $user1->full_name = 'admin';
        $user1->password = bcrypt(1234);
        $user1->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user1->gender = 1;
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($access_to_permissions);
        $user1->permissions()->attach($acsess_to_crud_students);

        $user2 = new User();
        $user2->email = 'director@test.com';
        $user2->full_name = 'Пользователь 1';
        $user2->password = bcrypt(1234);
        $user2->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user2->gender = 1;
        $user2->school_id = 1;
        $user2->save();
        $user2->roles()->attach($director);
        $user2->permissions()->attach($acsess_to_crud_students);
        $user2->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user2->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user3 = new User();
        $user3->email = 'headteacher1@test.com';
        $user3->password = bcrypt(1234);
        $user3->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user3->full_name = 'Пользователь 2';
        $user3->gender = 1;
        $user3->school_id = 1;
        $user3->save();
        $user3->roles()->attach($head_teacher);
        $user3->permissions()->attach($acsess_to_crud_students);
        $user3->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user3->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user18 = new User();
        $user18->email = 'headteacher2@test.com';
        $user18->full_name = 'Пользователь 3';
        $user18->password = bcrypt(1234);
        $user18->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user18->gender = 1;
        $user18->school_id = 2;
        $user18->save();
        $user18->roles()->attach($head_teacher);
        $user18->permissions()->attach($acsess_to_crud_students);
        $user18->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user18->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user4 = new User();
        $user4->email = 'teacher1@test.com';
        $user4->full_name = 'Пользователь 4';
        $user4->password = bcrypt(1234);
        $user4->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user4->gender = 0;
        $user4->school_id = 1;
        $user4->save();
        $user4->roles()->attach($teacher);
        $user4->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user4->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user5 = new User();
        $user5->email = 'teacher2@test.com';
        $user5->full_name = 'Пользователь 5';
        $user5->password = bcrypt(1234);
        $user5->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user5->gender = 0;
        $user5->school_id = 1;
        $user5->save();
        $user5->roles()->attach($teacher);
        $user5->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user5->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user6 = new User();
        $user6->email = 'teacher3@test.com';
        $user6->full_name = 'Пользователь 6';
        $user6->password = bcrypt(1234);
        $user6->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user6->gender = 0;
        $user6->school_id = 1;
        $user6->save();
        $user6->roles()->attach($teacher);
        $user6->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user6->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user7 = new User();
        $user7->email = 'teacher4@test.com';
        $user7->full_name = 'Пользователь 7';
        $user7->password = bcrypt(1234);
        $user7->birthday = date('d-m-Y', strtotime('05-10-1996'));;
        $user7->gender = 0;
        $user7->school_id = 1;
        $user7->save();
        $user7->roles()->attach($teacher);
        $user7->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user7->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user8 = new User();
        $user8->email = 'teacher5@test.com';
        $user8->full_name = 'Пользователь 8';
        $user8->password = bcrypt(1234);
        $user8->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user8->gender = 1;
        $user8->school_id = 2;
        $user8->save();
        $user8->roles()->attach($teacher);
        $user8->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user8->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user9 = new User();
        $user9->email = 'teacher6@test.com';
        $user9->full_name = 'Пользователь 9';
        $user9->password = bcrypt(1234);
        $user9->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user9->gender = 0;
        $user9->school_id = 2;
        $user9->save();
        $user9->roles()->attach($teacher);
        $user9->attributes_db()->attach($date_of_employment, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user9->attributes_db()->attach($date_of_dismissal, ['value' => null]);

        $user10 = new User();
        $user10->email = 'student1@test.com';
        $user10->full_name = 'Пользователь 10';
        $user10->password = bcrypt(1234);
        $user10->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user10->gender = 0;
        $user10->school_id = 1;
        $user10->save();
        $user10->roles()->attach($student);
        $user10->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user10->attributes_db()->attach($class, ['value' => 1]);
        $user10->attributes_db()->attach($parallel, ['value' => 'A']);
        $user10->lessons()->attach($mathematics);
        $user10->lessons()->attach($russian_language);
        $user10->lessons()->attach($literature);
        $user10->lessons()->attach($physical_culture);
        $user10->lessons()->attach($history);
        $user10->lessons()->attach($geography);
        $user10->lessons()->attach($life_safety);
        $user10->lessons()->attach($labour);

        $user11 = new User();
        $user11->email = 'student2@test.com';
        $user11->full_name = 'Пользователь 11';
        $user11->password = bcrypt(1234);
        $user11->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user11->gender = 0;
        $user11->school_id = 1;
        $user11->save();
        $user11->roles()->attach($student);
        $user11->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user11->attributes_db()->attach($class, ['value' => 1]);
        $user11->attributes_db()->attach($parallel, ['value' => 'A']);
        $user11->lessons()->attach($mathematics);
        $user11->lessons()->attach($russian_language);
        $user11->lessons()->attach($literature);
        $user11->lessons()->attach($physical_culture);
        $user11->lessons()->attach($history);
        $user11->lessons()->attach($geography);
        $user11->lessons()->attach($life_safety);
        $user11->lessons()->attach($labour);

        $user12 = new User();
        $user12->email = 'student3@test.com';
        $user12->full_name = 'Пользователь 12';
        $user12->password = bcrypt(1234);
        $user12->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user12->gender = 0;
        $user12->school_id = 2;
        $user12->save();
        $user12->roles()->attach($student);
        $user12->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user12->attributes_db()->attach($class, ['value' => 2]);
        $user12->attributes_db()->attach($parallel, ['value' => 'B']);
        $user12->lessons()->attach($mathematics);
        $user12->lessons()->attach($russian_language);
        $user12->lessons()->attach($literature);
        $user12->lessons()->attach($physical_culture);
        $user12->lessons()->attach($history);
        $user12->lessons()->attach($geography);
        $user12->lessons()->attach($life_safety);
        $user12->lessons()->attach($labour);

        $user13 = new User();
        $user13->email = 'student4@test.com';
        $user13->full_name = 'Пользователь 13';
        $user13->password = bcrypt(1234);
        $user13->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user13->gender = 0;
        $user13->school_id = 2;
        $user13->save();
        $user13->roles()->attach($student);
        $user13->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user13->attributes_db()->attach($class, ['value' => 2]);
        $user13->attributes_db()->attach($parallel, ['value' => 'B']);
        $user13->lessons()->attach($mathematics);
        $user13->lessons()->attach($russian_language);
        $user13->lessons()->attach($literature);
        $user13->lessons()->attach($physical_culture);
        $user13->lessons()->attach($history);
        $user13->lessons()->attach($geography);
        $user13->lessons()->attach($life_safety);
        $user13->lessons()->attach($labour);

        $user14 = new User();
        $user14->email = 'student5@test.com';
        $user14->full_name = 'Пользователь 14';
        $user14->password = bcrypt(1234);
        $user14->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user14->gender = 0;
        $user1->school_id = 1;
        $user14->save();
        $user14->roles()->attach($student);
        $user14->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user14->attributes_db()->attach($class, ['value' => 1]);
        $user14->attributes_db()->attach($parallel, ['value' => 'A']);
        $user14->lessons()->attach($mathematics);
        $user14->lessons()->attach($russian_language);
        $user14->lessons()->attach($literature);
        $user14->lessons()->attach($physical_culture);
        $user14->lessons()->attach($history);
        $user14->lessons()->attach($geography);
        $user14->lessons()->attach($life_safety);
        $user14->lessons()->attach($labour);

        $user15 = new User();
        $user15->email = 'student6@test.com';
        $user15->full_name = 'Пользователь 15';
        $user15->password = bcrypt(1234);
        $user15->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user15->gender = 0;
        $user15->school_id = 1;
        $user15->save();
        $user15->roles()->attach($student);
        $user15->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user15->attributes_db()->attach($class, ['value' => 1]);
        $user15->attributes_db()->attach($parallel, ['value' => 'A']);
        $user15->lessons()->attach($mathematics);
        $user15->lessons()->attach($russian_language);
        $user15->lessons()->attach($literature);
        $user15->lessons()->attach($physical_culture);
        $user15->lessons()->attach($history);
        $user15->lessons()->attach($geography);
        $user15->lessons()->attach($life_safety);
        $user15->lessons()->attach($labour);

        $user16 = new User();
        $user16->email = 'student7@test.com';
        $user16->full_name = 'Пользователь 16';
        $user16->password = bcrypt(1234);
        $user16->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user16->gender = 0;
        $user16->school_id = 2;
        $user16->save();
        $user16->roles()->attach($student);
        $user16->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user16->attributes_db()->attach($class, ['value' => 2]);
        $user16->attributes_db()->attach($parallel, ['value' => 'B']);
        $user16->lessons()->attach($mathematics);
        $user16->lessons()->attach($russian_language);
        $user16->lessons()->attach($literature);
        $user16->lessons()->attach($physical_culture);
        $user16->lessons()->attach($history);
        $user16->lessons()->attach($geography);
        $user16->lessons()->attach($life_safety);
        $user16->lessons()->attach($labour);

        $user17 = new User();
        $user17->email = 'student8@test.com';
        $user17->full_name = 'Пользователь 17';
        $user17->password = bcrypt(1234);
        $user17->birthday = date('d-m-Y', strtotime('05-10-1996'));
        $user17->gender = 0;
        $user17->school_id = 2;
        $user17->save();
        $user17->roles()->attach($student);
        $user17->attributes_db()->attach($date_of_receipt, ['value' => date('d-m-Y', strtotime('01-10-2015'))]);
        $user17->attributes_db()->attach($class, ['value' => 2]);
        $user17->attributes_db()->attach($parallel, ['value' => 'B']);
        $user17->lessons()->attach($mathematics);
        $user17->lessons()->attach($russian_language);
        $user17->lessons()->attach($literature);
        $user17->lessons()->attach($physical_culture);
        $user17->lessons()->attach($history);
        $user17->lessons()->attach($geography);
        $user17->lessons()->attach($life_safety);
        $user17->lessons()->attach($labour);
    }
}
