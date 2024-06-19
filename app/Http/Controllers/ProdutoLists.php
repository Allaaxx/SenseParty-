<?php


use Livewire\Component;
use App\Models\Product;
use App\Models\User;

class produtossos extends Component{

    public $produtossos;

    public function mount()
    {
        $this->produtossos = Product::all();
    }

    public function render()
    {
        return view('livewire.product-lists');
    }
}
