<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'profile_access',
            ],
            [
                'id'    => 20,
                'title' => 'profile_type_create',
            ],
            [
                'id'    => 21,
                'title' => 'profile_type_edit',
            ],
            [
                'id'    => 22,
                'title' => 'profile_type_show',
            ],
            [
                'id'    => 23,
                'title' => 'profile_type_delete',
            ],
            [
                'id'    => 24,
                'title' => 'profile_type_access',
            ],
            [
                'id'    => 25,
                'title' => 'profile_page_create',
            ],
            [
                'id'    => 26,
                'title' => 'profile_page_edit',
            ],
            [
                'id'    => 27,
                'title' => 'profile_page_show',
            ],
            [
                'id'    => 28,
                'title' => 'profile_page_delete',
            ],
            [
                'id'    => 29,
                'title' => 'profile_page_access',
            ],
            [
                'id'    => 30,
                'title' => 'contact_access',
            ],
            [
                'id'    => 31,
                'title' => 'contact_icon_create',
            ],
            [
                'id'    => 32,
                'title' => 'contact_icon_edit',
            ],
            [
                'id'    => 33,
                'title' => 'contact_icon_show',
            ],
            [
                'id'    => 34,
                'title' => 'contact_icon_delete',
            ],
            [
                'id'    => 35,
                'title' => 'contact_icon_access',
            ],
            [
                'id'    => 36,
                'title' => 'contact_detail_create',
            ],
            [
                'id'    => 37,
                'title' => 'contact_detail_edit',
            ],
            [
                'id'    => 38,
                'title' => 'contact_detail_show',
            ],
            [
                'id'    => 39,
                'title' => 'contact_detail_delete',
            ],
            [
                'id'    => 40,
                'title' => 'contact_detail_access',
            ],
            [
                'id'    => 41,
                'title' => 'umkm_create',
            ],
            [
                'id'    => 42,
                'title' => 'umkm_edit',
            ],
            [
                'id'    => 43,
                'title' => 'umkm_show',
            ],
            [
                'id'    => 44,
                'title' => 'umkm_delete',
            ],
            [
                'id'    => 45,
                'title' => 'umkm_access',
            ],
            [
                'id'    => 46,
                'title' => 'organization_create',
            ],
            [
                'id'    => 47,
                'title' => 'organization_edit',
            ],
            [
                'id'    => 48,
                'title' => 'organization_show',
            ],
            [
                'id'    => 49,
                'title' => 'organization_delete',
            ],
            [
                'id'    => 50,
                'title' => 'organization_access',
            ],
            [
                'id'    => 51,
                'title' => 'news_access',
            ],
            [
                'id'    => 52,
                'title' => 'category_create',
            ],
            [
                'id'    => 53,
                'title' => 'category_edit',
            ],
            [
                'id'    => 54,
                'title' => 'category_show',
            ],
            [
                'id'    => 55,
                'title' => 'category_delete',
            ],
            [
                'id'    => 56,
                'title' => 'category_access',
            ],
            [
                'id'    => 57,
                'title' => 'tag_create',
            ],
            [
                'id'    => 58,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 59,
                'title' => 'tag_show',
            ],
            [
                'id'    => 60,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 61,
                'title' => 'tag_access',
            ],
            [
                'id'    => 62,
                'title' => 'news_page_create',
            ],
            [
                'id'    => 63,
                'title' => 'news_page_edit',
            ],
            [
                'id'    => 64,
                'title' => 'news_page_show',
            ],
            [
                'id'    => 65,
                'title' => 'news_page_delete',
            ],
            [
                'id'    => 66,
                'title' => 'news_page_access',
            ],
            [
                'id'    => 67,
                'title' => 'comment_create',
            ],
            [
                'id'    => 68,
                'title' => 'comment_edit',
            ],
            [
                'id'    => 69,
                'title' => 'comment_show',
            ],
            [
                'id'    => 70,
                'title' => 'comment_delete',
            ],
            [
                'id'    => 71,
                'title' => 'comment_access',
            ],
            [
                'id'    => 72,
                'title' => 'agenda_create',
            ],
            [
                'id'    => 73,
                'title' => 'agenda_edit',
            ],
            [
                'id'    => 74,
                'title' => 'agenda_show',
            ],
            [
                'id'    => 75,
                'title' => 'agenda_delete',
            ],
            [
                'id'    => 76,
                'title' => 'agenda_access',
            ],
            [
                'id'    => 77,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
