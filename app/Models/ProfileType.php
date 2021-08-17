<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProfileType extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'profile_types';

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
        self::created(function (ProfileType $profileType) {
            if (!$profileType->slug) {
                $slug = Str::slug($profileType->name, '-');
                $usedSlug = ProfileType::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = ProfileType::slug($profileType->name, '-').'-'.$slugger;
                    $usedSlug = User::where('slug', $slug)->first();
                }

                $profileType->slug = $slug;
                $profileType->save();
            }
        });

        self::updated(function (ProfileType $profileType) {
            if (!$profileType->slug) {
                $slug = Str::slug($profileType->name, '-');
                $usedSlug = ProfileType::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = ProfileType::slug($profileType->name, '-').'-'.$slugger;
                    $usedSlug = User::where('slug', $slug)->first();
                }

                $profileType->slug = $slug;
                $profileType->save();
            }
        });
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
