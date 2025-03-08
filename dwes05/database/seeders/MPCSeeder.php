<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MascotaMPC;
use Illuminate\Support\Facades\Hash;

class MPCSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (User::where('name', 'MPC1')->count() == 0) {
            $userMPC1 = User::create([
                'name' => 'MPC1',
                'email' => 'MPC1@email.MPC',
                'password' => Hash::make('MPC1'),
                'email_verified_at' => now(),
            ]);
        }
        if (User::where('name', 'MPC2')->count() == 0) {
            $userMPC2 = User::create([
                'name' => 'MPC2',
                'email' => 'MPC2@email.MPC',
                'password' => Hash::make('MPC2'),
                'email_verified_at' => now(),
            ]);
        }
        if (MascotaMPC::where('nombre', 'mascota MPC01')->count() == 0) {
            $mascota1 = MascotaMPC::create([
                'nombre' => 'mascota MPC01',
                'descripcion' => 'Es un perrito',
                'tipo' => 'Perro',
                'publica' => 'Si',
                'user_id' => $userMPC1->id,
            ]);
        }
        if (MascotaMPC::where('nombre', 'mascota MPC02')->count() == 0) {
            $mascota2 = MascotaMPC::create([
                'nombre' => 'mascota MPC02',
                'descripcion' => 'Es un gato',
                'tipo' => 'Gato',
                'publica' => 'Si',
                'user_id' => $userMPC2->id,
            ]);
        }
        if (MascotaMPC::where('nombre', 'mascota MPC03')->count() == 0) {
            $mascota3 = MascotaMPC::create([
                'nombre' => 'mascota MPC03',
                'descripcion' => 'Es un conejo',
                'tipo' => 'Serpiente',
                'publica' => 'No',
                'user_id' => $userMPC1->id,
            ]);
        }
        if (MascotaMPC::where('nombre', 'mascota MPC04')->count() == 0) {
            $mascota4 = MascotaMPC::create([
                'nombre' => 'mascota MPC04',
                'descripcion' => 'Es un hamster',
                'tipo' => 'Hamster',
                'publica' => 'No',
                'user_id' => $userMPC2->id,
            ]);
        }
    }
}
