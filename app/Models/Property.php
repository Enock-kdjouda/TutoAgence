<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Database\Eloquent\Factories\HasFactory;





class Property extends Model
{
    
    use HasFactory;
    // Use SoftDeletes;
    protected $fillable = [
       
            'title',
            'description',
            'surface' ,
            'rooms',
            'bedrooms',
            'floor',
            'price',
            'city',
            'address',
            'postal_code',
            'sold', 
            'image'
    ];

    public function options(): BelongsToMany{
        return $this->belongsToMany(Option::class);
    }
    public function getSlug(): string{
        return Str::slug($this->title);
    }
    public function imageUrl(): string{
            
        /** @var FilesystemAdapter $storage */
        $storage = Storage::disk('public');
        return $storage->url($this->image);
    }
     public function ScopeAvailable(Builder $builder, bool $available=true): Builder{
         return $builder->where('sold', !$available);
     }
     public function scopeRecent(Builder $builder): Builder{
         return $builder->orderBy('created_at', 'desc');
     }
}
