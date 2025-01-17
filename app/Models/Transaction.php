<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = ['email', 'whatsapp', 'note', 'product_id', 'amount', 'status', 'transfet_receipt'];

  public function product()
  {
    return $this->belongsTo(Product::class);
  }
}
