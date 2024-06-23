<?php

namespace App\Livewire;

use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SidebarUser extends Component
{
    public $admin;
    public $seller;
    
    public $listeners = [
        'render' => '$refresh',
    ];

    public function mount()
    {
        if (Auth::guard('admin')->check()) {
            $this->admin = Admin::findOrfail(auth('admin')->id());
        } 
        if (Auth::guard('seller')->check()) {
            $this->seller = Seller::findOrfail(auth('seller')->id());
        }
    }
    public function render()
    {
        return view('livewire.sidebar-user');
    }
}
