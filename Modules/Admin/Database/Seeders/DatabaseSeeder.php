<?php

namespace Modules\Admin\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Database\Seeders\DatabaseSeeder as CategorySeeder;
use Modules\Attribute\Database\Seeders\DatabaseSeeder as AttributeSeeder;
use Modules\Core\Database\Seeders\DatabaseSeeder as CoreSeeder;
use Modules\User\Database\Seeders\DatabaseSeeder as UserSeeder;
use Modules\Customer\Database\Seeders\DatabaseSeeder as CustomerSeeder;
use Modules\Inventory\Database\Seeders\DatabaseSeeder as InventorySeeder;
use Modules\CMS\Database\Seeders\DatabaseSeeder as CMSSeeder;
use Modules\SocialLogin\Database\Seeders\DatabaseSeeder as SocialLoginSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(InventorySeeder::class);
        $this->call(CoreSeeder::class);
        $this->call(AttributeSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CMSSeeder::class);
        $this->call(SocialLoginSeeder::class);
    }
}
