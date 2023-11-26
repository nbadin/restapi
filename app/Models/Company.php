<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Company extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
    ];

    /**
     * Hook to save logo
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            if ($company->logo) {
                $path = 'company/logo/' . basename($company->logo->store("company/logo/", "public"));
                $company->logo = Storage::disk('public')->url($path);
            }
        });

        static::updating(function ($company) {
            if ($company->logo) {
                $path = 'company/logo/' . basename($company->logo->store("company/logo/", "public"));
                $company->logo = Storage::disk('public')->url($path);
            }
        });
    }

    /**
     * Returns comments to the company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'company_id');
    }

    /**
     * Returns the company's grade
     *
     * @return float|int
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
     *
     * @return mixed
     */
    public static function getTop()
    {
        return Company::withSum('comments', 'grade')
            ->orderByDesc('comments_sum_grade')
            ->take(10)
            ->get();
    }
}
