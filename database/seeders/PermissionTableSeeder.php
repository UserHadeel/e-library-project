<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;



class PermissionTableSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run(): void

    {

        $permissions = [
            'قائمة-الصلاحيات',
            'انشاء-صلاحية',
            'تعديل-صلاحية',
            'حذف-صلاحية',
            'قائمة-الكتب',
            'انشاء-كتاب',
            'استعارة-كتاب',
            'تعديل-كتاب',
            'حذف-كتاب',
            'قائمة-اقسام-الكتب',
            'انشاء-قسم-كتب',
            'تعديل-قسم-كتب',
            'حذف-قسم-كتب',
            'صلاحية-المستخدم',
            'قائمة-المستخدمين',
            'عرض-مستخدم',
            'انشاء-مستخدم',
            'تعديل-مستخدم',
            'حذف-مستخدم',
            'قائمة-الاستعارة',
            'انشاء-استعارة',
            'تعديل-استعارة',
            'اضافة-المشاريع',
            'قائمة-المشاريع',
            'تعديل-المشاريع',
            'حذف-المشاريع',
            'قائمة-المجلات',
            'انشاء-مجلة',
            'تعديل-مجلة',
            'حذف-مجلة',
            'انشاء-استعارة-مشروع',
            'قائمة-استعارات-المشاريع',
            'تعديل-استعارة-مشروع',

        ];

        foreach ($permissions as $permission) {
            if (!Permission::where('name', $permission)->exists()) {
                Permission::create(['name' => $permission]);
            }
        }



        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }

}
