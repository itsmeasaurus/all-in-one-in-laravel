<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Database\Seeders\Traits\TriggerForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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
        $this->truncateTable('posts');

        $user = User::find(31);

        $posts = Post::factory()
                ->count(200)
                ->has(Comment::factory()->count(3))
                ->create();

        $user->posts()->attach($posts->pluck('id'));

        $this->enableForeignKey();
    }
}
