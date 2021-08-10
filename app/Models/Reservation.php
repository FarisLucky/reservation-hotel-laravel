<?php

namespace App\Models;

use App\Models\Traits\UseUuid;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Reservation extends Model implements ApiModelInterface
{
    use HasFactory;
    use UseUuid;

    protected $primaryKey = 'reservation_id';

    protected $fillable = [
        'reservation_user_id',
        'reservation_room',
        'reservation_price',
        'reservation_num_of_rooms',
        'reservation_num_of_persons',
        'reservation_num_of_children',
        'reservation_open_buffet',
        'reservation_from_date',
        'reservation_stay_days',
    ];


    public function usesTimestamps()
    {
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'reservation_user_id', 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d');
    }

    public function type(): string
    {
        return "reservation";
    }

    public function allowedAttributes(): Collection
    {
        return collect($this->getAttributes())
            ->filter(function ($item, $key) {
                return !collect($this->getHidden())->contains($key) && $key !== $this->getKeyName();
            });
    }


}
