<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'id_user',
        'aktivitas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public static function catat(string $aktivitas)
    {
        if (Auth::check()) {
            static::create([
                'id_user' => Auth::id(),
                'aktivitas' => $aktivitas,
            ]);
        }
    }
}
