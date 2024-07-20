<?php

namespace Database\Seeders;

use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Receipt::truncate();

        $receipts = [
            [
                'category' => 'Food',
                'date' => '2024/07/19',
                'total' => '13.23',
                'img' => asset('storage/receipt-1.png')
            ],
            [
                'category' => 'Cloth',
                'date' => '2024/07/19',
                'total' => '13.23',
                'img' => asset('storage/receipt-2.png')
            ]
        ];

        foreach ($receipts as $receipt) 
        {
            Receipt::create($receipt);
        }
    }
}
