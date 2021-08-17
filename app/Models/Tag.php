<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Tag extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'tags';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Tag $tag) {
            if (!$tag->slug) {
                $slug = Str::slug($tag->name, '-');
                $usedSlug = Tag::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($tag->name, '-').'-'.$slugger;
                    $usedSlug = Tag::where('slug', $slug)->first();
                }

                $tag->slug = $slug;
                $tag->save();
            }
        });

        self::updated(function (Tag $tag) {
            if (!$tag->slug) {
                $slug = Str::slug($tag->name, '-');
                $usedSlug = Tag::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($tag->name, '-').'-'.$slugger;
                    $usedSlug = Tag::where('slug', $slug)->first();
                }

                $tag->slug = $slug;
                $tag->save();
            }
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
