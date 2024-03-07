<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'description', 'date', 'location', 'seats','totalSeats', 'status', 'category_id', 'user_id', 'setting','price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function updateTotalSeats($newTotalSeats)
    {
        $oldTotalSeats = $this->totalSeats;

        $seatsDifference = $newTotalSeats - $oldTotalSeats;

        $this->seats += $seatsDifference;

        $this->seats = max(0, $this->seats);

        $this->totalSeats = $newTotalSeats;
        $this->save();
    }
}
