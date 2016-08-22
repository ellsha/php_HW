<?php


use App\Permission;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AdminPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = $this->setAdminRole();
        $this->addAdminPermissions($admin);
        $this->attachRole('ellsha', $admin);
    }

    /**
     * @return Role
     */
    private function setAdminRole()
    {
        $admin = new Role();
        $admin->name = 'admin';
        $admin->save();

        return $admin;
    }

    /**
     * @param string $username
     * @param Role $role
     */
    private function attachRole($username, $role)
    {
        $user = User::where('name', '=', $username)->first();
        $user->attachRole($role);
        $user->roles()->attach($role->id); // id only
    }

    /**
     * @param Role $role
     */
    private function addAdminPermissions($role)
    {
        $createArticle = new Permission();
        $createArticle->name = 'create-article';
        $createArticle->save();

        $editArticle = new Permission();
        $editArticle->name = 'edit-article';
        $editArticle->save();

        $deleteArticle = new Permission();
        $deleteArticle->name = 'delete-article';
        $deleteArticle->save();

        $role->attachPermissions([
            $createArticle,
            $editArticle,
            $deleteArticle
        ]);
    }
}