<?php

namespace Database\Seeders;

use App\Models\Progresso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgressoSeeder extends Seeder {

    public function run(): void {
        
        Progresso::create(['nome' => 'Processamento']);
        Progresso::create(['nome' => 'Faturamento']);
        Progresso::create(['nome' => 'Separação/Preparação do envio']);
        Progresso::create(['nome' => 'Expedição (Envio) / Retirada na Loja']);               
        Progresso::create(['nome' => 'Transporte']);
        Progresso::create(['nome' => 'Entregue']);
    }
}
