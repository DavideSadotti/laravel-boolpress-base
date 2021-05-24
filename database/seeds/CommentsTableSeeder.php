<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Comment;
use App\Post;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // SELEZIONO SOLO I POST PUBBLICATI
        $posts = Post::where('published', 1)->get();
        // CICLO I POST
        foreach($posts as $post){
            // CICLO N VOLTE PER CREARE I COMMENTI
            for($i = 0; $i < rand(0,3); $i++){
                $newCommet = new Comment();
                $newCommet->post_id = $post->id;
                // IN CASO DI COLONNA NULLABLE
                if(rand(0,1)){
                    $newCommet->name = $faker->name();
                }
                $newCommet->content = $faker->text();
                $newCommet->save();
            }
        }
    }
}
