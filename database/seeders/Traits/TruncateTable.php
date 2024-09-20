<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait TruncateTable
{
    public function truncateTable($table)
    {
        DB::table($table)->delete();
    }
}