<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\InvoiceProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['total', 'discount', 'vat', 'payable', 'user_id', 'customer_id'];

    function customer():BelongsTo{
        return $this->belongsTo(Customer::class);
    }
    function invoice_product():HasMany{
        return $this->hasMany(InvoiceProduct::class);
    }
}
