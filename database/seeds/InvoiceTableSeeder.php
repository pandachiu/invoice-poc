<?php

use App\Invoice;
use App\InvoiceItem;
use Illuminate\Database\Seeder;

class InvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Invoice::class, 50)->create()->each(function (Invoice $invoice) {
            for ($rand = 0; $rand <= rand(0, 10); $rand++) {
                $invoice->items()->save(factory(InvoiceItem::class)->make());
            }
        });
    }
}
