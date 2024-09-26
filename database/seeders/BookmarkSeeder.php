<?php

namespace Database\Seeders;

use App\Models\Bookmarks;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookmarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookmarks = Bookmarks::all();
        foreach ($bookmarks as $bookmark) {
            $user = User::where('name', $bookmark->name_user)->first();
            if ($user) {
                $bookmark->id_user = $user->id;
                $bookmark->save();
            }
        }
    }
}
