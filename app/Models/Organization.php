<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Organization extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'organizations';

    protected $appends = [
        'photos',
    ];

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
        self::created(function (Organization $organization) {
            if (!$organization->slug) {
                $slug = Str::slug($organization->name, '-');
                $usedSlug = Organization::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Organization::slug($organization->name, '-').'-'.$slugger;
                    $usedSlug = User::where('slug', $slug)->first();
                }

                $organization->slug = $slug;
                $organization->save();
            }
        });

        self::updated(function (Organization $organization) {
            if (!$organization->slug) {
                $slug = Str::slug($organization->name, '-');
                $usedSlug = Organization::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Organization::slug($organization->name, '-').'-'.$slugger;
                    $usedSlug = User::where('slug', $slug)->first();
                }

                $organization->slug = $slug;
                $organization->save();
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
