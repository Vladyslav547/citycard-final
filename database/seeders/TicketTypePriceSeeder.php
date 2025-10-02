<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TicketTypePrice;

class TicketTypePriceSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['ticket_type_id'=>1, 'transport_type_id'=>1, 'price'=>10],
            ['ticket_type_id'=>1, 'transport_type_id'=>2, 'price'=>12],
            ['ticket_type_id'=>2, 'transport_type_id'=>1, 'price'=>15],
            ['ticket_type_id'=>2, 'transport_type_id'=>2, 'price'=>18],
        ];

        foreach ($data as $item) {
            TicketTypePrice::updateOrCreate(
                [
                    'ticket_type_id' => $item['ticket_type_id'],
                    'transport_type_id' => $item['transport_type_id'],
                ],
                ['price' => $item['price']]
            );
        }
    }
}
