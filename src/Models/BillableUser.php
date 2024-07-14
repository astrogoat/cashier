<?php

namespace Astrogoat\Cashier\Models;

use Helix\Lego\Models\User;
use Helix\Lego\Models\Model;
use Laravel\Cashier\Billable;

class BillableUser extends Model
{
    use Billable;

    protected $table = 'users';

    public function getForeignKey(): string
    {
        return 'user_id';
    }

    public static function fromUser(User $user): static
    {
        return static::find($user->id);
    }

    #[\Override] public static function icon(): string
    {
        return '';
    }
}
