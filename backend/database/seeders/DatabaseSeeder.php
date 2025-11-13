<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table("usuarios")->insert([
            [
                "usuario" => "admin",
                "senha" => Hash::make("Isaque2004@"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);

        DB::table("impostos")->insert([
            [
                "sigla" => "IPTU",
                "nome_completo" => "Imposto Predial e Territorial Urbano",
                "icone" => "predio",
                "descricao" => "Tributo municipal cobrado anualmente de proprietários de imóveis urbanos.",
                "finalidade" => "Recursos arrecadados são destinados à manutenção de serviços públicos como iluminação, pavimentação, limpeza urbana e melhorias na infraestrutura da cidade.",
                "curiosidades" => '["O IPTU existe no Brasil desde 1891.","O valor \u00e9 calculado com base no valor venal do im\u00f3vel.","Descontos s\u00e3o oferecidos para pagamento \u00e0 vista em Macei\u00f3.","Im\u00f3veis tombados podem ter descontos no IPTU."]',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "sigla" => "ISS",
                "nome_completo" => "Imposto Sobre Serviços",
                "icone" => "maleta",
                "descricao" => "Tributo municipal cobrado sobre a prestação de serviços por empresas e profissionais autônomos.",
                "finalidade" => "Financia obras públicas, saúde, educação e outros serviços essenciais prestados pelo município de Maceió.",
                "curiosidades" => '["A alíquota varia de 2% a 5% dependendo do tipo de serviço.","Mais de 100 tipos de serviços são tributados pelo ISS.","É um dos principais impostos municipais.","Profissionais liberais também pagam ISS."]',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "sigla" => "ITBI",
                "nome_completo" => "Imposto de Transmissão de Bens Imóveis",
                "icone" => "casa",
                "descricao" => "Imposto municipal cobrado na transferência de propriedade de imóveis.",
                "finalidade" => "Recursos utilizados para investimentos em infraestrutura urbana e serviços públicos municipais.",
                "curiosidades" => '["É cobrado apenas uma vez, no momento da transferência.","A alíquota em Maceió é de 2% sobre o valor venal.","Não incide em doações ou heranças.","Deve ser pago antes do registro do imóvel."]',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
