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

    /*
     * Scope a query to only include comments for a specific company.
     */
    public function scopeByCompanyId($query, $companyId)
    {
        return $query->where('company_id', $companyId);
    }
}
