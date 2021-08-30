<?php

namespace App\Models;

use App\Models\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ReservationDetail extends Model
{
    use HasFactory, UseUuid;

    protected $primaryKey = 'detail_id';

    protected $fillable = [
        'reservation_id',
        'room_id',
        'price'
    ];

    public function type(): string
    {
        return 'reservation_detail';
    }

    public function allowedAttributes(): Collection
    {
        return collect($this->getAttributes())
            ->filter(function ($item, $key) {
                return !collect($this->getHidden())->contains($key) && $key !== $this->getKeyName();
            })
            ->merge([
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ]);
    }
}
