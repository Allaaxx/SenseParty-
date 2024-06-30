<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Exemplo de método para verificar se um usuário pode avaliar um produto
    public static function canReview($userId, $productId)
    {
        // Aqui você pode implementar a lógica específica para verificar se o usuário pode avaliar o produto
        // Por exemplo, verificar se o usuário comprou o produto ou se já avaliou antes.
        return true; // Exemplo simples, ajuste conforme necessário
    }
}
