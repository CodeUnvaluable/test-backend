<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FiatTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fiat_type', 'amount', 'transaction_type', 'status'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
