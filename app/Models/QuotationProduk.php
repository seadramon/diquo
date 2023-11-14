<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuotationProduk extends Model
{
    use HasFactory;

    protected $table = 'quo_quotation_produks';

    protected $appends = ['hpju', 'hju', 'total_hju'];

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class, 'quotation_id');
    }
    public function getsbu()
    {
    	return $this->belongsTo(VMasterProduk::class, 'sbu', 'kd_sbu');
    }

    public function getHpjuAttribute()
    {
        return $this->harsat_produk + $this->transportasi;
    }

    public function getHjuAttribute()
    {
        return intval(round($this->hpju * ( 1 + ($this->quotation->idx_hpju / 100)), -3));
    }
    
    public function getTotalHjuAttribute()
    {
        return $this->hju * $this->volume * $this->panjang;
    }
}
