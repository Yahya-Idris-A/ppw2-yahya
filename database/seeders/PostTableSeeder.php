<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTableSeeder extends Seeder
{
    private $_posts = [
        ["title" => "Seeder 1", "description" => "Deskripsi seeder 1"],
        ["title" => "Seeder 2", "description" => "Deskripsi seeder 2"],
        ["title" => "Seeder 3", "description" => "Deskripsi seeder 3"],
        ["title" => "Seeder 4", "description" => "Deskripsi seeder 4"],
        ["title" => "Seeder 5", "description" => "Deskripsi seeder 5"],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        foreach ($this->_posts as $post) {
            $data[] = [
                'title' => $post['title'],
                'description' => $post['description']
            ];
        }
        DB::table('posts')->insert($data);
    }
}
