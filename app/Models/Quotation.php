<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = 'quo_quotations';

    public function produk()
    {
    	return $this->hasMany(QuotationProduk::class, 'quotation_id', 'id');
    }

    public function pabrik()
    {
    	return $this->belongsTo(Pat::class, 'kd_pabrik', 'kd_pat');
    }

    public function getsbu()
    {
    	return $this->belongsTo(VMasterProduk::class, 'sbu', 'kd_sbu');
    }

    public function getpic()
    {
    	return $this->belongsTo(Personal::class, 'pic', 'employee_id');
    }

    public function getse()
    {
    	return $this->belongsTo(Personal::class, 'se_id', 'employee_id');
    }
}
