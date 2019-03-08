<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceItemResource;
use App\Invoice;
use App\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceItemController extends Controller
{
    public function store(Request $request, Invoice $invoice)
    {
        $invoiceItem = InvoiceItem::firstOrCreate(
            $request->invoice_item
        );

        return new InvoiceItemResource($invoiceItem);
    }
}
