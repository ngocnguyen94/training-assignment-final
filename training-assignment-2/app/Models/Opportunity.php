<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class Opportunity extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'opportunities';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
        'publish_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($obj) {
            Storage::delete(Str::replaceFirst('storage/','public/uploads/images', $obj->image));
        });

        static::saving(function($obj) {
            if (Opportunity::where('slug', $obj->slug )->exists())
                throw ValidationException::withMessages(['slug' => 'The generated slug is taken.']);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function setBannerImageAttribute($value)
    {
        $attribute_name = "banner_image";
        $disk = config('backpack.base.root_disk_name');
        $destination_path = "public/uploads/images";

        if ($value==null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        if (Str::startsWith($value, 'data:image'))
        {
            $image = Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.jpg';
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            Storage::disk($disk)->delete($this->{$attribute_name});

            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }

    public function setMobileBannerImageAttribute($value)
    {
        $attribute_name = "mobile_banner_image";
        $disk = config('backpack.base.root_disk_name');
        $destination_path = "public/uploads/images";

        if ($value==null) {
            Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        if (Str::startsWith($value, 'data:image'))
        {
            $image = Image::make($value)->encode('jpg', 90);
            $filename = md5($value.time()).'.jpg';
            Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            Storage::disk($disk)->delete($this->{$attribute_name});

            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = empty($value) ? Str::of($this->attributes['title'])->slug('-') : $value;
    }
}
