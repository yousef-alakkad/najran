<?php

namespace Database\Seeders;

use App\Models\Attend;
use App\Models\member;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Workshop::truncate();
//        \App\Models\User::find(1)->update(['password'=>bcrypt('emf123456')]);
        // User::create([
        //     'name'=>'Admin',
        //     'email'=>'admin@admin.admin',
        //     'password'=>bcrypt(123456),
        //     'is_admin'=>1
        // ]);

        $workshops = [
            [
                'name'=>'إدارة التغيير في بيئة العمل  يقدمها معهد الإدارة العامة',
                'stage'=>1,
                'side'=>'معهد الإدارة العامة',
                'start_time'=>'14:00:00',
                'end_time'=>'16:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'إدارة المشاريع الصغيرة والمتوسطة يقدمها كن للتدريب',
                'stage'=>1,
                'side'=>'كن للتدريب',
                'start_time'=>'16:00:00',
                'end_time'=>'18:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'دورة القبول الجامعي في تلبية احتياجات سوق العمل يقدمها جامعة نجران',
                'stage'=>1,
                'side'=>'جامعة نجران',
                'start_time'=>'18:00:00',
                'end_time'=>'19:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'التأمين المالي يقدمها المؤسسة العامة للتدريب التقني والمهني',
                'stage'=>1,
                'side'=>'المؤسسة العامة للتدريب التقني والمهني',
                'start_time'=>'19:00:00',
                'end_time'=>'21:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'مهارات القيادة وإدارة الفرق يقدمها مركز المبدعون',
                'stage'=>2,
                'side'=>'مركز المبدعون',
                'start_time'=>'14:00:00',
                'end_time'=>'16:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'أساسيات الذكاء الاصطناعي – مسرعة المهارات يقدمها وزارة الموارد البشرية والتنمية الاجتماعية',
                'stage'=>2,
                'side'=>'وزارة الموارد البشرية والتنمية الاجتماعية',
                'start_time'=>'16:30:00',
                'end_time'=>'18:30:00',
                'max_count'=>2000
            ],
            [
                'name'=>'مقدمة برنامج ERP-SAP يقدمها المؤسسة العامة للتدريب التقني والمهني',
                'stage'=>2,
                'side'=>'المؤسسة العامة للتدريب التقني والمهني',
                'start_time'=>'19:00:00',
                'end_time'=>'21:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'مهارات التقديم الاعلامي يقدمها أكاديمية ولاء',
                'stage'=>3,
                'side'=>'أكاديمية ولاء',
                'start_time'=>'14:00:00',
                'end_time'=>'16:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'الشخصية الاحترافية في بيئة العمل يقدمها مركز أثر للتدريب',
                'stage'=>3,
                'side'=>'مركز أثر للتدريب',
                'start_time'=>'16:30:00',
                'end_time'=>'18:30:00',
                'max_count'=>2000
            ],
            [
                'name'=>'السلامة المهنية يقدمها المؤسسة العامة للتدريب التقني والمهني',
                'stage'=>3,
                'side'=>'المؤسسة العامة للتدريب التقني والمهني',
                'start_time'=>'19:00:00',
                'end_time'=>'21:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'السياحة البيئية المستدامة يقدمها المعهد العالي للسياحة',
                'stage'=>4,
                'side'=>'المعهد العالي للسياحة',
                'start_time'=>'14:00:00',
                'end_time'=>'16:00:00',
                'max_count'=>2000
            ],
            [
                'name'=>'إدارة المخاطر يقدمها COURSINITY',
                'stage'=>4,
                'side'=>'COURSINITY',
                'start_time'=>'16:30:00',
                'end_time'=>'18:30:00',
                'max_count'=>2000
            ],
            [
                'name'=>'التجارة الالكترونية يقدمها الأكاديمية السعودية للتجزئة',
                'stage'=>4,
                'side'=>'الأكاديمية السعودية للتجزئة',
                'start_time'=>'19:00:00',
                'end_time'=>'21:00:00',
                'max_count'=>2000
            ],

        ];

        foreach ($workshops as $workshop){
            Workshop::create($workshop);
        }
    }
}
