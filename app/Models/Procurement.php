<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;


class Procurement extends Model
{
      /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'nama_procurement',
        'email_procurement',
        'no_hp'
    ];
}
