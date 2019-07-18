<?php


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('categories')->truncate();
        DB::table('photos')->truncate();
        DB::table('roles')->truncate();

        factory(App\Photo::class, 1)->create();
        factory(App\Category::class, 8)->create();
        factory(App\Role::class, 3)->create();
        factory(App\User::class, 10)->create()->each(function ($user) {
            $user->posts()->save(factory(App\Post::class)->create());
        });

        // $this->call(UsersTableSeeder::class);
    }
}
