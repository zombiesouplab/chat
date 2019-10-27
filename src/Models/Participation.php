<?php

namespace Musonza\Chat\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Musonza\Chat\BaseModel;

class Participation extends BaseModel
{
//    use SoftDeletes;

    protected $table = 'mc_participation';
    protected $fillable = [
        'conversation_id',
    ];

    /**
     * Conversation.
     *
     * @return BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function messageable()
    {
        return $this->morphTo();
    }
}
