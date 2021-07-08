<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactDetail extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'contact_details';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contact_icon_id',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function contact_icon()
    {
        return $this->belongsTo(ContactIcon::class, 'contact_icon_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
