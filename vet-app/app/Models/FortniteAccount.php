<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FortniteAccount extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fortnite_accounts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'epic_username',
        'platform',
        'rank',
        'account_created_date',
        'account_owner_id',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'account_created_date' => 'date',
        ];
    }

    /**
     * Get the account owner that owns the Fortnite account.
     */
    public function accountOwner(): BelongsTo
    {
        return $this->belongsTo(AccountOwner::class);
    }

    /**
     * Get the coaching sessions for the Fortnite account.
     */
    public function coachingSessions(): HasMany
    {
        return $this->hasMany(CoachingSession::class);
    }
}
