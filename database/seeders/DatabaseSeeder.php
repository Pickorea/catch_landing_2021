<?php

namespace Database\Seeders;

use App\Models\Fisherman;
use App\Models\Island;
use App\Models\Location;
use App\Models\Method;
use App\Models\Species;
use App\Models\Trip;
use App\Models\User;
use Database\Factories\LocationFactory;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionsSeeder::class);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('secret'),
            'email_verified_at' => now(),
        ]);
        User::factory(10)->create();
        Location::factory(10)->create();

        $data = [
            'Makin', 'Butaritari', 'Marakei', 'Abaiang', 'Tarawa', 'Maiana', 'Abemama', 'Kuria', 'Aranuka', 'Nonouti',
            'Tabiteuea', 'Beru', 'Nikunau', 'Onotoa', 'Tamana', 'Arorae',
        ];
        foreach ($data as $obj) {
            $item = Island::firstOrCreate(['island_name' => $obj]);
        }


        $data = [
            'Splash fishing',
            'Encircling of submerged coral reef using gillnet',
            'Beach seine',
        ];
        foreach ($data as $obj) {
            $item = Method::firstOrCreate(['method_name' => $obj]);
        }


        $data = [
            ['Tridacna gigas', 'Te Were', '320937960.jpg' ],
            ['Anadara sp', 'Te Bun', '1995697308.jpg'],
            ['Panulirus sp', 'Te Waro', '385532554.jpg'],
        ];

        foreach ($data as $obj) {
            $item = Species::firstOrCreate(['species_name' => $obj[1]]);
//            $item->scientific_name = $obj[0];
//            $item->file = $obj[2];
//            $item->save();
        }


        Fisherman::factory()->count(10)
            ->state(new Sequence(
                fn () => ['island_id' => Island::all()->random()->id],
            ))
            ->create();

        Trip::factory()->count(20)
            ->state(new Sequence(
                fn () => [
                    'fisherman_id' => Fisherman::all()->random()->id,
                    'method_id' => Method::all()->random()->id,
                    'location_id' => Location::all()->random()->id]
            ))
            ->create();
    }
}
