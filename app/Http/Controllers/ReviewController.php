<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Armazena uma nova avaliação para um produto específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $productId
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        // Verifica se o usuário pode avaliar o produto
        if (!$this->canReviewProduct(Auth::id(), $productId)) {
            return back()->with('error', 'Você só pode avaliar produtos que comprou.');
        }

        // Cria a avaliação
        Review::create([
            'product_id' => $productId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Avaliação enviada com sucesso.');
    }

    /**
     * Verifica se o usuário pode avaliar o produto.
     *
     * @param  int  $userId
     * @param  int  $productId
     * @return bool
     */
    private function canReviewProduct($userId, $productId)
    {
        // Exemplo simples de verificação: se o usuário comprou o produto
        // Você pode ajustar esta lógica conforme necessário (por exemplo, verificar se a ordem está completa)
        $product = Product::findOrFail($productId);
        $isUserBuyer = $product->orders()->where('user_id', $userId)->exists();
        
        return $isUserBuyer;
    }
}
