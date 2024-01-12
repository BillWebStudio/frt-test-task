<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Enums\ActiveStatus as ActiveStatusEnum;
use App\Models\User as Admin;
use App\Models\Scopes\OrganizationFilterScope;

use Kyslik\ColumnSortable\Sortable;
use App\Traits\FilesProcessing;


class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sortable;
    use FilesProcessing;


    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'dob',
        'telegram',
        'referrer',
        //'country',
        'country_id',
        'training_type',
        'hours_left',
        'hours_valid_until',
        'comments',
        'status',
        'photo',
        'organization_id',
        'admin_id',
    ];

    protected $casts = [
        'status' => ActiveStatusEnum::class,
        'training_type' => 'array',
        'created_at'  => 'date:Y-m-d H:i',
        'updated_at'  => 'date:Y-m-d H:i',
        'deleted_at'  => 'date:Y-m-d H:i',
    ];


    public $sortable = [
        'id',
        'name',
        'email',
        'phone',
        'dob',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        ];


    public $uploadsModelFolder = "clients";

    public $imageSizes = [
        'small' => [
            'w' => 150,
            'h' => 150,
        ],
        'medium' => [
            'w' => 300,
            'h' => 300,
        ],
    ];

    protected $appends = ['uploadsFolder'];


    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }


    protected static function booted(): void
    {
        static::addGlobalScope(new OrganizationFilterScope);
    }


    function getUploadsFolderAttribute() {
        return $this->getUploadsFolder();
    }
}
