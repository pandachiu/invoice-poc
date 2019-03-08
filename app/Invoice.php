<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Invoice
 * @package App
 */
class Invoice extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'postcode'];

    /**
     * @return HasMany
     */
    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
