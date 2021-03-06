<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Permission as AppPermission;
use App\Models\Module;
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

        $modules = ['Clients','Loans','Expenses','Reports','Categories','Terms','Payment modes','Employees','Branches','Charges','Users'];

        foreach($modules as $name){
            $module = Module::firstOrNew(['name'=>$name]);
            if(!$module->exists){
                $module->save();
            }
        }

        $permissions = [
                        ['name'=>'clients.index','display_name'=>'Browse clients','module_index'=>$modules[0]],
                        ['name'=>'clients.create','display_name'=>'Add client','module_index'=>$modules[0]],
                        ['name'=>'clients.edit','display_name'=>'Edit client','module_index'=>$modules[0]],
                        ['name'=>'clients.destroy','display_name'=>'Delete client','module_index'=>$modules[0]],

                        ['name'=>'groups.index','display_name'=>'Browse groups','module_index'=>$modules[0]],
                        ['name'=>'groups.create','display_name'=>'Add group','module_index'=>$modules[0]],
                        ['name'=>'groups.edit','display_name'=>'Edit group','module_index'=>$modules[0]],
                        ['name'=>'groups.destroy','display_name'=>'Delete group','module_index'=>$modules[0]],

                        ['name'=>'wallets.deposits','display_name'=>'Deposit savings','module_index'=>$modules[0]],
                        ['name'=>'wallets.withdraws','display_name'=>'Withdraw savings','module_index'=>$modules[0]],


                        ['name'=>'loans.show','display_name'=>'Browse','module_index'=>$modules[1]],
                        ['name'=>'loans.create','display_name'=>'Create new','module_index'=>$modules[1]],
                        ['name'=>'loans.edit','display_name'=>'Edit','module_index'=>$modules[1]],
                        ['name'=>'loans.destroy','display_name'=>'Delete','module_index'=>$modules[1]],

                        ['name'=>'loans.add_to_for_approval','display_name'=>'Add to Approval','module_index'=>$modules[1]],
                        ['name'=>'loans.approval','display_name'=>'Approval','module_index'=>$modules[1]],
                        ['name'=>'loans.add_to_for_release','display_name'=>'Add to for release','module_index'=>$modules[1]],
                        ['name'=>'loans.releasing','display_name'=>'Releasing','module_index'=>$modules[1]],

                        ['name'=>'loans.post_payment','display_name'=>'Post Payment','module_index'=>$modules[1]],

                        ['name'=>'expenses.index','display_name'=>'Browse','module_index'=>$modules[2]],
                        ['name'=>'expenses.create','display_name'=>'Create new','module_index'=>$modules[2]],
                        ['name'=>'expenses.edit','display_name'=>'Edit','module_index'=>$modules[2]],
                        ['name'=>'expenses.destroy','display_name'=>'Delete','module_index'=>$modules[2]],

                        ['name'=>'reports.index','display_name'=>'Browse','module_index'=>$modules[3]],

                        ['name'=>'categories.index','display_name'=>'Browse','module_index'=>$modules[4]],
                        ['name'=>'categories.create','display_name'=>'Create new','module_index'=>$modules[4]],
                        ['name'=>'categories.edit','display_name'=>'Edit','module_index'=>$modules[4]],
                        ['name'=>'categories.destroy','display_name'=>'Delete','module_index'=>$modules[4]],

                        ['name'=>'categories.index','display_name'=>'Browse','module_index'=>$modules[4]],
                        ['name'=>'categories.create','display_name'=>'Create new','module_index'=>$modules[4]],
                        ['name'=>'categories.edit','display_name'=>'Edit','module_index'=>$modules[4]],
                        ['name'=>'categories.destroy','display_name'=>'Delete','module_index'=>$modules[4]],

                        ['name'=>'terms.index','display_name'=>'Browse','module_index'=>$modules[5]],
                        ['name'=>'terms.create','display_name'=>'Create new','module_index'=>$modules[5]],
                        ['name'=>'terms.edit','display_name'=>'Edit','module_index'=>$modules[5]],
                        ['name'=>'terms.destroy','display_name'=>'Delete','module_index'=>$modules[5]],

                        ['name'=>'payment_modes.index','display_name'=>'Browse','module_index'=>$modules[6]],
                        ['name'=>'payment_modes.create','display_name'=>'Create new','module_index'=>$modules[6]],
                        ['name'=>'payment_modes.edit','display_name'=>'Edit','module_index'=>$modules[6]],
                        ['name'=>'payment_modes.destroy','display_name'=>'Delete','module_index'=>$modules[6]],

                        ['name'=>'employees.index','display_name'=>'Browse','module_index'=>$modules[7]],
                        ['name'=>'employees.create','display_name'=>'Create new','module_index'=>$modules[7]],
                        ['name'=>'employees.edit','display_name'=>'Edit','module_index'=>$modules[7]],
                        ['name'=>'employees.destroy','display_name'=>'Delete','module_index'=>$modules[7]],

                        ['name'=>'branches.index','display_name'=>'Browse','module_index'=>$modules[8]],
                        ['name'=>'branches.create','display_name'=>'Create new','module_index'=>$modules[8]],
                        ['name'=>'branches.edit','display_name'=>'Edit','module_index'=>$modules[8]],
                        ['name'=>'branches.destroy','display_name'=>'Delete','module_index'=>$modules[8]],

                        ['name'=>'charges.index','display_name'=>'Browse','module_index'=>$modules[9]],
                        ['name'=>'charges.create','display_name'=>'Create new','module_index'=>$modules[9]],
                        ['name'=>'charges.edit','display_name'=>'Edit','module_index'=>$modules[9]],
                        ['name'=>'charges.destroy','display_name'=>'Delete','module_index'=>$modules[9]],

                        ['name'=>'users.index','display_name'=>'Browse','module_index'=>$modules[10]],
                        ['name'=>'users.create','display_name'=>'Create new','module_index'=>$modules[10]],
                        ['name'=>'users.edit','display_name'=>'Edit','module_index'=>$modules[10]],
                        ['name'=>'users.destroy','display_name'=>'Delete','module_index'=>$modules[10]],

                     ];

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
