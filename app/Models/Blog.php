<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeBelongsToME($query)
    {
        $query->where('user_id', auth()->id());
    }

    public function generateSlug($slug_generation_text)
    {
        $slug = Str::slug($slug_generation_text);
        if(static::where([
            ['slug', '=', $slug],
            ['id', '!=', $this->id],
        ])->count())
            $slug = $slug.'-'.time();
        return $slug;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable = ['title', 'slug', 'description', 'user_id'];
}
