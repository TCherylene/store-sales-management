<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasLog;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'username', 'password', 'department', 'opt_status'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    use HasLog;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

    const DEPT_SUPERUSER = 1;
    const OPT_STATUS_ACTIVE = 1;
    const OPT_STATUS_INACTIVE = 0;
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public static function listDepartment(){
        return [
            self::DEPT_SUPERUSER => "Superuser",
        ];
    }

    public static function listStatus(){
        return [
            self::OPT_STATUS_ACTIVE => "Aktif",
            self::OPT_STATUS_INACTIVE => "Non Aktif",
        ];
    }

    public function deptName(): string
    {
        return self::listDepartment()[$this->department] ?? '-';
    }
}
