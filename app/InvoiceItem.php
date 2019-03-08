<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['item', 'price'];

    //
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
