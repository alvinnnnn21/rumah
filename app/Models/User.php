<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $timestamps = false;
    protected $table = "user";
    protected $primaryKey = 'iduser';   

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
       "username",
       "password",
       "nama",
       "roles",
       "email",
       "no_telpon",
       "no_rekening",
       "bank"
    ];

    public function reminder()
    {
        return $this->hasMany(Reminder::class, "iduser", "iduser");
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, "iduser", "penerima");
    }
}
