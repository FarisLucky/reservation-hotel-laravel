<?php

namespace App\Models;

use App\Models\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class InvoiceGuest extends Model implements ApiModelInterface
{
    use HasFactory, UseUuid;

    protected $primaryKey = 'invoice_id';

    protected $fillable = [
        'guest_id',
        'reservation_id',
        'invoice_amount',
        'ts_issued',
        'ts_paid',
        'ts_canceled'
    ];

    public function type(): string
    {
        return 'invoice_guest';
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
