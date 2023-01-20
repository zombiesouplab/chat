<?php

namespace Musonza\Chat\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Musonza\Chat\BaseModel;
use Musonza\Chat\ConfigurationManager;

class Participation extends BaseModel
{
    //    use SoftDeletes;

    protected $table = ConfigurationManager::PARTICIPATION_TABLE;
    protected $fillable = [
        'conversation_id',
        'settings',
    ];

    protected $casts = [
        'settings' => 'array',
    ];
    protected $appends = ['user', 'messageable'];

    public function getUserAttribute()
    {
        if ($this->msgbl) {
            return $this->msgbl->only('id', 'display_name');
        } else {
            return null;
        }
    }
    public function getMessageableAttribute()
    {
        if ($this->msgbl) {
            return $this->msgbl->only('id', 'display_name');
        } else {
            return null;
        }
    }
    /**
     * Conversation.
     *
     * @return BelongsTo
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function msgbl()
    {
        return $this->morphTo();
    }
}
