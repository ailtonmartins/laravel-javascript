<?php

use Illuminate\Database\Seeder;

class ContinentesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $grupos = ['Ásia','América do Sul' , 'América do Norte' , 'África' , 'Antártida' , 'Europa' ];

        foreach ( $grupos as $v  ) {
            App\Continentes::create([
                'nome' => $v
            ]);
        }

    }
}