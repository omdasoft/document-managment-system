<?php

namespace Modules\General\Models;

use App\Enums\ModuleType;
use App\Models\BaseDocument;
use App\Traits\UseModuleDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

// use Modules\General\Database\Factories\DocumentFactory;

class Document extends BaseDocument
{
    use HasFactory, UseModuleDatabase;

    protected $module = ModuleType::GENERAL->value;

    public function documentHeader(): HasOne
    {
        return $this->HasOne(DocumentHeader::class);
    }

    public function documentBody(): HasOne
    {
        return $this->HasOne(DocumentBody::class);
    }
}
