<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function assignMultipleRoles(array $roleNameOrIds): void
    {
        $roles = Role::query()
            ->whereIn('name', $roleNameOrIds)
            ->orWhereIn('id', $roleNameOrIds)
            ->get();

        if (!empty($roles)) {
            $this->roles()->sync($roles);
        }
    }

    public function assignRole(string|int|Role $role): void
    {
        $needle = $role;

        if (!$needle instanceof Role) {
            $needle = Role::where(is_string($role) ? 'name' : 'id', $role)->first();
        }

        if (is_null($needle)) {
            throw new ModelNotFoundException("Role {$role} not found");
        }

        $this->roles()->sync($needle);
    }

    public function hasRole(string|int|Role $role): bool
    {
        $needle = $role;

        if (!$needle instanceof Role) {
            $needle = Role::where(is_string($role) ? 'name' : 'id', $role)->first();
        }

        return $this->roles->contains($needle->id);
    }
}
