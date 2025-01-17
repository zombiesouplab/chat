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

    // protected $hidden = ['messageable'];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        if (!$this->messageable) {
            return null;
        }

        if (method_exists($this->messageable, 'getChatUserAttributes')) {
            return $this->messageable->getChatUserAttributes();
        }

        return $this->messageable->only('id', 'display_name', 'deleted_at');
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

    public function messageable()
    {
        return $this->morphTo()->withTrashed();
    }
}
