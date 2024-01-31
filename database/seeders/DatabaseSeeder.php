<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(AdminExtensionsTableSeeder::class);
        $this->call(AdminExtensionHistoriesTableSeeder::class);
        $this->call(AdminMenuTableSeeder::class);
        $this->call(AdminPermissionsTableSeeder::class);
        $this->call(AdminPermissionMenuTableSeeder::class);
        $this->call(AdminRolesTableSeeder::class);
        $this->call(AdminRoleMenuTableSeeder::class);
        $this->call(AdminRolePermissionsTableSeeder::class);
        $this->call(AdminRoleUsersTableSeeder::class);
        $this->call(AdminSettingsTableSeeder::class);
        $this->call(AdminUsersTableSeeder::class);
        $this->call(EntryTableSeeder::class);
        $this->call(EntrySkuTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
        $this->call(GoodsTableSeeder::class);
        $this->call(GoodsCategoryTableSeeder::class);
        $this->call(GoodsSkuTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(OrderSkuTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(PasswordResetTokensTableSeeder::class);
        $this->call(PersonalAccessTokensTableSeeder::class);
        $this->call(SkuLogTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VendorTableSeeder::class);
    }
}
