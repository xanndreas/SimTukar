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

class Umkm extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'umkms';

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
        'longitude',
        'latitude',
        'contact_detail_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (Umkm $umkm) {
            if (!$umkm->slug) {
                $slug = Str::slug($umkm->name, '-');
                $usedSlug = Umkm::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($umkm->name, '-').'-'.$slugger;
                    $usedSlug = Umkm::where('slug', $slug)->first();
                }

                $umkm->slug = $slug;
                $umkm->save();
            }
        });


        self::updated(function (Umkm $umkm) {
            if (!$umkm->slug) {
                $slug = Str::slug($umkm->name, '-');
                $usedSlug = Umkm::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($umkm->name, '-').'-'.$slugger;
                    $usedSlug = Umkm::where('slug', $slug)->first();
                }

                $umkm->slug = $slug;
                $umkm->save();
            }
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function contact_detail()
    {
        return $this->belongsTo(ContactDetail::class, 'contact_detail_id');
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
