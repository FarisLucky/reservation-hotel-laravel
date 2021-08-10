<?php

namespace App\Models;

use App\Models\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Rooms extends Model implements ApiModelInterface
{
    use HasFactory, UseUuid;

    protected $primaryKey = "room_id";

    protected $fillable = [
        'room_number',
        'description'
    ];

    public function category() {
        return $this->belongsTo(Categories::class,"category_id","category_id");
    }

    public function type(): string
    {
        return "room";
    }

    public function allowedAttributes(): Collection
    {
        return collect($this->getAttributes())
            ->filter(function ($item, $key) {
                return !collect($this->getHidden())->contains($key) && $key !== $this->getKeyName();
            });
    }

}
