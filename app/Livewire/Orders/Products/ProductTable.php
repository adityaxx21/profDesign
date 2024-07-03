<?php

namespace App\Livewire\Orders\Products;

use App\Models\Product;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
use Livewire\WithFileUploads;

class ProductTable extends Component
{
  use WithFileUploads;
  protected $listeners = ['openModal'];
  protected $rules = [
    'name' => 'required|string|max:255',
    'category' => 'required|string|max:255',
    'description' => 'required|string',
    'price' => 'required|numeric',
  ];

  public $products;
  public $uuid;
  public $task = false;
  public $name;
  public $category;
  public $description;
  public $price;
  public $product_img;
  public $counter = 0;

  public function mount($products)
  {
    $this->products = $products;
  }

  public function increment($val)
  {
    $this->counter += $val;
  }

  public function openModal($uuid = null)
  {
    $this->task = true;
    if ($uuid) {
      $product = Product::where('uuid', $uuid)->first();
      $this->uuid = $product->uuid;
      $this->name = $product->name;
      $this->category = $product->category;
      $this->description = $product->description;
      $this->price = $product->price;
      $this->product_img = $product->product_img;
    }
  }

  public function save()
  {
    try {
      $this->validate();

      $product = $this->uuid ? Product::where('uuid', $this->uuid)->first() : new Product();

      $product->name = $this->name;
      $product->category = $this->category;
      $product->description = $this->description;
      $product->price = $this->price;
      if ($this->product_img !== $product->product_img && $this->product_img) {
        $product->product_img = $this->product_img->store('products', 'public');
      }

      $product->save();

      session()->flash('message', $this->uuid ? 'Product updated successfully.' : 'Product created successfully.');
      $this->products = Product::orderBy('id', 'DESC')->get();
    } catch (ValidationException $e) {
      $errors = $e->validator->errors()->all();
      $this->dispatch('error', errors: $errors);
    }
    $this->task = false;
  }

  public function delete($uuid)
  {
    $delete = Product::where('uuid', $uuid);

    $delete->delete();

    $this->products = Product::orderBy('id', 'DESC')->get();
  }

  public function render()
  {
    return view('livewire..orders.products.product-table');
  }
}
