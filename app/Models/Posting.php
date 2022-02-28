<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Posting extends Model
{
    use HasFactory;

    // protected $table = 'postings';

    protected $fillable = ['title','content'];

    // protected $visible = [];
    // protected $hidden = ['created_at','updated_at'];

    protected $casts = [

        'is_published' => 'boolean',
        'like_count' => 'integer',
        'dislike_count' => 'integer',
    ];


    // == Relations

    // == https://laravel.com/docs/8.x/eloquent-relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // == Scopes

    public function scopePublished($query)
    {
        return $query->where('is_published', '=', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('is_published', '=', false);
    }

    public function scopeRelevant($query)
    {
        return $query
            ->where('is_published', '=', true)
            ->where('like_count', '>=', 1000)
            ->where('created_at', '>=', Carbon::now()->subMonths(6));
    }


    // == Attributes

    public function getLikeRatioAttribute()
    {
        return $this->dislike_count ? round($this->like_count / $this->dislike_count, 2) : 0;
    }

    public function getIsPositiveAttribute()
    {
        return $this->like_ratio > 1;
    }

    public function getIsNegativeAttribute()
    {
        return !$this->is_positive;
    }

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }
}
