<?php

use App\Models\Permission;
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
        // $this->call(UsersTableSeeder::class);
        $this->seedBranchPermissions();
        $this->seedContactsPermissions();
    }


    /**
     *    Seed Banches Permissions and middlewares.
     */
    public function  seedBranchPermissions()
    {
        $contact_permissions    =   ['view_branch' ,  'create_branch' ,    'update_branch' , 'delete_branch'];
        Permission::query()->where('name' , 'like' , '%'.'branch'.'%')->whereSection('Branches')->delete();
        foreach($contact_permissions as $contact_permission)
        {
            $permission =   [
                'name'                   =>  $contact_permission,
                'section'                =>  'Branches',
                'guard_name'             =>  'web',
            ];
            Permission::query()->updateOrCreate($permission , $permission);
        }
    }

    /**
     * Seed Cotnact Permissions
     */
    public function seedContactsPermissions()
    {
        $contact_permissions    =   ['view_contacts' , 'edit_contacts'];
        foreach($contact_permissions as $contact_permission)
        {
            $permission =   [
                'name'      =>  $contact_permission,
                'section'   =>  'Contact Messages',
                'guard_name'     =>  'web',
            ];
            Permission::query()->updateOrCreate($permission , $permission);
        }
    }

}
