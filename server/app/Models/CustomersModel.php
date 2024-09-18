<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomersModel extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'enterprise',
        'user_id',
        'age',
        'cpf',
        'cnpj',
    ];

    public function relUser(): BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }
}
