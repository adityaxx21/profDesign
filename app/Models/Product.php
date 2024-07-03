<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
  use HasFactory, SoftDeletes;

  protected static function boot()
  {
    parent::boot();

    static::creating(function ($model) {
      $model->uuid = Uuid::uuid4()->toString();
    });
  }

  protected $fillable = ['uuid', 'name', 'category', 'description', 'price', 'product_img'];

  public function transactions()
  {
    return $this->hasMany(Transaction::class);
  }
}
