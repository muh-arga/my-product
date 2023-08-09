<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unique_id',
        'sku',
        'description',
        'specification'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $filters) =>
            $query->where('name', 'like', '%' . $filters . '%')
                ->orWhere('sku', 'like', '%' . $filters . '%')
                ->orWhere('unique_id', 'like', '%' . $filters . '%')
        );
    }
}
