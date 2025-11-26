<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountOwner extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'account_owners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'discord_username',
        'email',
        'region',
    ];

    /**
     * Get the Fortnite accounts for the account owner.
     */
    public function fortniteAccounts(): HasMany
    {
        return $this->hasMany(FortniteAccount::class);
    }
}
