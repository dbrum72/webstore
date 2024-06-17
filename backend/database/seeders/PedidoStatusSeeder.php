<?php

namespace Database\Seeders;

use App\Models\PedidoStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoStatusSeeder extends Seeder {

    public function run(): void {
        
        PedidoStatus::create(['nome' => 'Em processamento']);
        PedidoStatus::create(['nome' => 'Em separação']);
        PedidoStatus::create(['nome' => 'Aguardando confirmação de pagamento']);       
        PedidoStatus::create(['nome' => 'Enviado']);
    }
}
