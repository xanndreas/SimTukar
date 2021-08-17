<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class NewsPage extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'news_pages';

    protected $appends = [
        'photos',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'slug',
        'content',
        'views',
        'user_id',
        'organization_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'category_id',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        self::created(function (NewsPage $newsPage) {
            if (!$newsPage->slug) {
                $slug = Str::slug($newsPage->title, '-');
                $usedSlug = NewsPage::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($newsPage->title, '-').'-'.$slugger;
                    $usedSlug = NewsPage::where('slug', $slug)->first();
                }

                $newsPage->slug = $slug;
                $newsPage->save();
            }
        });

        self::updated(function (NewsPage $newsPage) {
            if (!$newsPage->slug) {
                $slug = Str::slug($newsPage->title, '-');
                $usedSlug = NewsPage::where('slug', $slug)->first();
                $slugger = 1;

                while ($usedSlug) {
                    $slug = Str::slug($newsPage->title, '-').'-'.$slugger;
                    $usedSlug = NewsPage::where('slug', $slug)->first();
                }

                $newsPage->slug = $slug;
                $newsPage->save();
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
