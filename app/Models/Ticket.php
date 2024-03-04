<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['reservation_id', 'qrcode', 'path'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
