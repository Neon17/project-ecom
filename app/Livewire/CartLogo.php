<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CartLogo extends Component
{
    public int $count = 0;

    public function mount()
    {
        $this->refreshCount();
    }


    #[On('refreshCount')]
    public function refreshCount()
    {
        if ($this->count != 0){
            dd('refreshed');
        }
        $user = Auth::user();
        if (!$user) {
            $this->count = 0;
            return;
        }

        $cart = $user->cart()->with('cartItems')->first();
        
        $distinct = $cart?->cartItems()->distinct('product_id')->count() ?? 0;
        $this->count = $distinct;
    }

    // Fallback: Listen to a generic event name if needed (optional)
    #[On('cartUpdated')]
    public function onCartUpdated()
    {
        $this->refreshCount();
    }

    public function render()
    {
        return view('livewire.cart-logo');
    }
}

