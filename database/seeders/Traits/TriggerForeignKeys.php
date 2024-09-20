<?php
namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\Schema;

trait TriggerForeignKeys
{
    public function disableForeignKey()
    {
        Schema::disableForeignKeyConstraints();
    }

    public function enableForeignKey()
    {
        Schema::enableForeignKeyConstraints();
    }
}