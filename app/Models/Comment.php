<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'message',
        'grade',
    ];

    public function scopeByCompanyId($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }
}
