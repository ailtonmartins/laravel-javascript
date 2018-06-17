<?php

use Illuminate\Database\Seeder;

class GruposSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $grupos = ['A','B' , 'C' , 'D' , 'E' , 'F' , 'G' , 'H' ];

        foreach ( $grupos as $v  ) {
            App\Grupos::create([
                'nome' => $v
            ]);
        }

    }
}