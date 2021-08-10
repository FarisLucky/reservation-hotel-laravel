<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Categories extends Model implements ApiModelInterface
{
    use HasFactory;

    protected $primaryKey = "category_id";

    protected $fillable = [
        'category_name'
    ];

    protected $casts = ['created_at','updated_at'];

    public function rooms(){
        return $this->hasMany(Rooms::class,"category_id","category_id");
    }

    public function type(): string
    {
        return "category";
    }

    public function allowedAttributes(): Collection
    {
        return collect($this->getAttributes())
            ->filter(function ($item, $key) {
                return !collect($this->getHidden())->contains($key) && $key != $this->getKeyName();
            })
            ->merge([
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at
            ]);
    }

}
