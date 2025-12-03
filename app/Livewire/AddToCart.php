<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddToCart extends Component
{
    public Product $product;
    public int $quantity = 1;

    protected $rules = [
        'quantity' => 'required|integer|min:1',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->quantity = 1;
    }

    public function increase()
    {
        if ($this->quantity < $this->product->quantity) {
            $this->quantity++;
        }
    }

    public function decrease()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        // Ensure we don't add more than available
        if ($this->quantity > $this->product->quantity) {
            session()->flash('error', 'Requested quantity exceeds available stock.');
            $this->dispatch('cart-error');
            return;
        }

        $user = Auth::user();

        DB::transaction(function () use ($user) {
            $cart = $user->cart()->firstOrCreate(['user_id' => $user->id]);

            $cartItem = $cart->cartItems()->where('product_id', $this->product->id)->first();

            $totalQuantity = $cartItem ? ($cartItem->quantity + $this->quantity) : $this->quantity;

            if ($totalQuantity > $this->product->quantity) {
                $availableToAdd = $this->product->quantity - ($cartItem ? $cartItem->quantity : 0);
                session()->flash('error', "Stock full! You can only add {$availableToAdd} more of this item.");
                $this->dispatch('cart-error');
                return;
            }

            if ($cartItem) {
                $cartItem->increment('quantity', $this->quantity);
            } else {
                $cart->cartItems()->create([
                    'product_id' => $this->product->id,
                    'quantity' => $this->quantity,
                    'user_id' => $user->id,
                ]);
            }
    });
    $this->dispatch('refreshCount');
    }
    public function render()
    {
        return view('livewire.add-to-cart');
    }
}
