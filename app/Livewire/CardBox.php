<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class CardBox extends Component
{
    public $admin;

    public $listeners = [
        'updateAdminSellerHeaderInfo' => '$refresh',
    ];
    
    public function mount()
    {
        $this->loadAdminData();
    }

    public function loadAdminData()
    {
        if (Auth::guard('admin')->check()) {
            $this->admin = Admin::findOrFail(auth()->id());
        }
    }

    public function render()
    {
        $this->loadAdminData();
        
        return view('livewire.card-box', [
            'admin' => $this->admin
        ]);
    }
}
