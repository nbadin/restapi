<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
    ];

    /*
     * Hook to save logo
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            if ($company->logo) {
                $company->logo = 'company/logo/' . basename($company->logo->store("company/logo/", "public"));
            }
        });

        static::updating(function ($company) {
            if ($company->logo) {
                $company->logo = 'company/logo/' . basename($company->logo->store("company/logo/", "public"));
            }
        });
    }

    /*
     * Returns comments to the company
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'company_id');
    }

    /*
     * Returns the company's grade
     */
    public function get_grade()
    {
        $comments = $this->comments();

        if ($count = $comments->count()) {
            return  $comments->sum('grade') / $count;
        }

        return 0;
    }

    /**
     * Returns of top 10 companies
     */
    public static function getTop()
    {
        return Company::withSum('comments', 'grade')
            ->orderByDesc('comments_sum_grade')
            ->take(10)
            ->get();
    }
}
