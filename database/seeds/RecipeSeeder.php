<?php

use Illuminate\Database\Seeder;
use App\Models\Recipe;
use App\Models\User; // Import the User model if not already done

class RecipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::truncate();

        $adminUser = User::where('email', 'admin@admin.com')->first();

        if ($adminUser) {
            // Create recipes for the admin user
            for ($i = 1; $i < 4; $i++) {
                Recipe::create([
                    'user_id'      => $adminUser->id,
                    'name'         => 'Recipe ' . $i,
                    'ingredients'  => 'Ingredient ' . $i,
                    'instructions' => 'Instructions ' . $i,
                    'duration'     => 10 + $i * 2,
                ]);
            }
        }

        // Assuming the other 100 users are created via factory as per UserSeeder
        // Associate some recipes with other users created by factory
        $users = User::where('is_admin', false)->get();

        foreach ($users as $user) {
            Recipe::create([
                'user_id'      => $user->id,
                'name'         => 'Recipe for User ' . $user->id,
                'ingredients'  => 'Ingredients for User ' . $user->id,
                'instructions' => 'Instructions for User ' . $user->id,
                'duration'     => 15 + $user->id,
            ]);
        }
    }
}

