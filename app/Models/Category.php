<?php

namespace App\Models;

use Carbon\Carbon;
use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Category $category) {
            if (!$category->slug) {
                $slug = Str::slug($category->name, '-');
                $usedSlug = Category::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($category->name, '-').'-'.$slugger;
                    $usedSlug = Category::where('slug', $slug)->first();
                }

                $category->slug = $slug;
                $category->save();
            }
        });

        self::updated(function (Category $category) {
            if (!$category->slug) {
                $slug = Str::slug($category->name, '-');
                $usedSlug = Category::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($category->name, '-').'-'.$slugger;
                    $usedSlug = Category::where('slug', $slug)->first();
                }

                $category->slug = $slug;
                $category->save();
            }
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
