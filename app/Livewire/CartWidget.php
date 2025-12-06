<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartWidget extends Component
{
    public string $mode = 'logo'; // 'logo' or 'button'
    public ?Product $product = null;
    public int $quantity = 1;
    public int $count = 0; // for logo badge

    protected $rules = [
        'quantity' => 'required|integer|min:1',
    ];

    public function mount(string $mode = 'logo', $product = null)
    {
        $this->mode = $mode;
        // Accept either a Product model or an ID
        if ($product instanceof Product) {
            $this->product = $product;
        } elseif (!is_null($product)) {
            $this->product = Product::find($product);
        }
        if ($this->isLogo()) {
            $this->refreshCount();
        }
    }

    public function isLogo(): bool
    {
        return $this->mode === 'logo';
    }

    public function isButton(): bool
    {
        return $this->mode === 'button';
    }

    // ---------- Logo side ----------
    #[On('refreshCount')]
    public function refreshCount()
    {
        $user = Auth::user();
        if (!$user) { $this->count = 0; return; }
        $cart = $user->cart()->with('cartItems')->first();
        // distinct products only
        $this->count = $cart ? (int) $cart->cartItems()->sum('quantity') : 0;
    }

    // ---------- Button side ----------
    public function increase()
    {
        if (!$this->product) return;
        if ($this->quantity < $this->product->quantity) { $this->quantity++; }
    }

    public function decrease()
    {
        if ($this->quantity > 1) { $this->quantity--; }
    }

    public function addToCart()
    {
        Log::info('Add to cart initiated in CartWidget');
        if (!Auth::check()) { return redirect()->route('login'); }
        Log::info('Adding to cart from CartWidget');
        $this->validate();
        Log::info('Validation passed in CartWidget');
        if (!$this->product) { return; }

        Log::info('Proceeding to add product ID: ' . $this->product->id . ' with quantity: ' . $this->quantity);

        if ($this->quantity > $this->product->quantity) {
            session()->flash('error', 'Requested quantity exceeds available stock.');
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

        session()->flash('success', 'Product added to cart successfully');
        // Update logo badges anywhere
        $this->dispatch('refreshCount')->to(self::class);
    }

    public function render()
    {
        return view('livewire.cart-widget');
    }
}
