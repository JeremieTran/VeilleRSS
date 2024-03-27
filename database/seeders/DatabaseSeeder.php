<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    // public function run()
    // {
    //     $faker = Faker::create();

    //     // Générer les utilisateurs sans inclure parent_id
    //     for ($i = 0; $i < 100; $i++) {
    //         DB::table('users')->insert([
    //             'name' => $faker->name,
    //             'email' => $faker->unique()->safeEmail,
    //             'password' => Hash::make('password'), // Vous pouvez changer cela selon vos besoins
    //             'created_at' => now(),
    //             'updated_at' => now(),
    //         ]);
    //     }

    public function run()
    {
        $userIds = \DB::table('users')->pluck('id')->toArray();
    
        foreach ($userIds as $userId) {
            // Générer un parent_id différent de l'ID de l'utilisateur actuel
            $parentId = $userIds[array_rand($userIds)]; // Sélectionne un ID aléatoire parmi les existants
    
            \DB::table('users')->where('id', $userId)->update([
                'parent_id' => $parentId,
            ]);
        }
    }
}
