<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationProduk extends Model
{
    use HasFactory;

    protected $table = 'quo_quotation_produks';

    public function getsbu()
    {
    	return $this->belongsTo(VMasterProduk::class, 'sbu', 'kd_sbu');
    }
}
