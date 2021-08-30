<?php

namespace App\Models;

use App\Models\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Guest extends Model implements ApiModelInterface
{
    use HasFactory, UseUuid;

    protected $primaryKey = "guest_id";

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone',
        'address',
        'detail'
    ];

    public function type(): string
    {
        return 'guest';
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
