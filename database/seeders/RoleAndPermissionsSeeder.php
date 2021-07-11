<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Permission as AppPermission;
use App\Models\Module;
use App\Models\Role as AppRole;
use App\Models\User;
class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = \Config::get('references.roles');

        foreach($roles as $name){
            $role = Role::firstOrNew(['name'=>$name]);
            if(!$role->exists){
                $role->fill(['guard_name'=>'web'])->save();
            }
        }

        $administator_user = User::firstOrNew(['email'=>'frankdexisne1692@gmail.com']);
        if(!$administator_user->exists){
            $administator_user->fill([
                'name'=>'Frankly Dexisne',
                'password'=>'$2y$10$9f3x9wxJ/hQ8Y/K.CEpuE.2N8WleGnMWKLI/LQuO38drldF20dQ/m'
            ])
            ->save();
        }

        $system_administrator = Role::firstOrNew(['name'=>'SYSTEM ADMINISTRATOR']);

        if($system_administrator->exists){
            if(User::find($administator_user->id)){
                $user = User::where('id',1)->first();
                $user->assignRole('SYSTEM ADMINISTRATOR');
            }
        }

        $modules = \Config::get('references.module');

        foreach($modules as $name){
            $module = Module::firstOrNew(['name'=>$name]);
            if(!$module->exists){
                $module->save();
            }
        }

        $permissions = \Config::get('references.permissions');

        foreach($permissions as $row){
            $module = Module::firstOrNew(['name'=>$row['module_index']]);
            if($module->exists){
                $permission = AppPermission::firstOrNew(['name'=>$row['name']]);
                if(!$permission->exists){
                    $module_id=$module->id;
                    $permission->fill(['display_name'=>$row['display_name'],'module_id'=>$module_id,'guard_name'=>'web'])->save();
                }
            }
        }
    }
}
