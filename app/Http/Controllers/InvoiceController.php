<?php

namespace App\Http\Controllers;

use App\InvoiceItem;
use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends Controller
{
    public function index()
    {
        return InvoiceResource::collection(Invoice::with('items')->get());
    }

    public function show(Invoice $invoice)
    {
        return new InvoiceResource(Invoice::with('items')->find($invoice->id));
    }

    public function store(Request $request)
    {
        $invoice = Invoice::create($request->all());
        $invoiceItems = [];
        if(!empty($request->items)) {
            foreach($request->items as $item){
                $invoiceItems[] = new InvoiceItem($item);
            }
        }
        $invoice->items()->saveMany($invoiceItems);
        return new InvoiceResource(Invoice::with('items')->find($invoice->id));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($request->only(['title', 'description']));

        return new InvoiceResource($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json(null, 204);
    }
}
