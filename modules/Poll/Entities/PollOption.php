<?php

namespace Modules\Poll\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        "poll_id",
        "name",
        "total_vote",
    ];

    public $timestamps = false;

    public function poll()
    {
        return $this->belongsTo(Poll::class, 'poll_id');
    }
    
}
