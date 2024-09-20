<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TriggerForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use TruncateTable, TriggerForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKey();
        $this->truncateTable('users');
        \App\Models\User::factory(10)->create();
        $this->enableForeignKey();
    }
}
