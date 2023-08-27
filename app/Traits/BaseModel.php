<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Venturecraft\Revisionable\RevisionableTrait;

trait BaseModel
{
    use RevisionableTrait, SoftDeletes;

    protected bool $revisionForceDeleteEnabled = true;

    protected bool $revisionCleanup = true;

    protected bool $revisionEnabled = true;

    protected int $historyLimit = 100;

    protected bool $revisionCreationsEnabled = true;
}
