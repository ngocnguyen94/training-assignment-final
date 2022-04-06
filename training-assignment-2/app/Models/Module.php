<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class Module extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'academy_modules';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['academy_program_id', 'name', 'slug', 'description', 'order', 'banner_image', 'parent_id', 'sub_modules_intro'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $appends = ['display_name'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function($obj) {
            Storage::delete(Str::replaceFirst('storage/','public/uploads/images', $obj->image));
        });

        static::saving(function($obj) {
            if (Module::where([
                'academy_program_id' => $obj->academy_program_id,
                'parent_id' => empty($obj->parent_id) ? '0' : $obj->parent_id,
                'order' => $obj->order])
                ->exists())
                throw ValidationException::withMessages(['order' => 'The order is taken.']);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getOrder()
    {
        $orders = [];
        $orders[] = $this->order;
        $parent = $this->parent;

        while ($parent)
        {
            $orders[] = $parent->order;
            $parent = $parent->parent;
        }

        return implode(".", array_reverse($orders));
    }

    public function getParentModule()
    {
        $modules = [];
        $parent = $this->parent;

        while ($parent)
        {
            $modules[] = $parent->name;
            $parent = $parent->parent;
        }

        return implode(" - ", array_reverse($modules));
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function program()
    {
        return $this->belongsTo(Program::class, 'academy_program_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }
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
    public function getDisplayNameAttribute()
    {
        return $this->program->name.': '.$this->name;
    }

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

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = empty($value) ? Str::of($this->attributes['name'])->slug('-') : $value;
    }

    public function setParentIdAttribute($value)
    {
        $this->attributes['parent_id'] = empty($value) ? 0 : $value;
    }
}
