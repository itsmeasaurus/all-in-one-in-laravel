<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Seeders\Traits\TriggerForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
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
        $this->truncateTable('comments');
        \App\Models\Comment::factory(5)->create();
        $this->enableForeignKey();
    }
}
