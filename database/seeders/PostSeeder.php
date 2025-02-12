<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->truncate(); // Optional: Clear existing records

        Post::insert([
            [
                'title' => 'First Post',
                'content' => 'This is the first post content.',
                'status' => 'pending',
                'phone' => '1234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Second Post',
                'content' => 'This is another interesting post.',
                'status' => 'approved',
                'phone' => '9876543210',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Third Post',
                'content' => 'This is yet another post with some content.',
                'status' => 'rejected',
                'phone' => null, // No phone number for this one
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
