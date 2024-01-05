<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->delete();

        Project::factory()
            ->has(Member::factory()
                ->count(5))
            ->count(5)
            ->create();
    }
}
