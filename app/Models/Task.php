<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Comments\Models\Concerns\HasComments;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    /*
     * This string will be used in notifications on what a new comment
     * was made.
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vote(): BelongsTo
    {
        return $this->belongsTo(Vote::class);
    }
    public function upVote(): BelongsTo
    {
        return $this->belongsTo(Vote::class,'id','feedback_id')->where('vote',1);
    }
    public function downVote(): BelongsTo
    {
        return $this->belongsTo(Vote::class,'id','feedback_id')->where('vote',-1);
    }
}
