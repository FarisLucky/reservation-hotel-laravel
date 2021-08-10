<?php

namespace App\Models;

use Illuminate\Support\Collection;

interface ApiModelInterface {

    public function type(): string;

    /**
     * Merge Created_at and Updated_at in attributes
     *
     * @return Collection
     */
    public function allowedAttributes(): Collection;
}
