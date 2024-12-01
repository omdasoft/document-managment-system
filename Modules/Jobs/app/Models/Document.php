<?php

namespace Modules\Jobs\Models;

use App\Enums\ModuleType;
use App\Models\BaseDocument;
use App\Traits\UseModuleDatabase;
use Illuminate\Database\Eloquent\Relations\HasOne;

// use Modules\General\Database\Factories\DocumentFactory;

class Document extends BaseDocument
{
    use UseModuleDatabase;

    protected $module = ModuleType::JOBS->value;

    public function documentHeader(): HasOne
    {
        return $this->HasOne(DocumentHeader::class);
    }

    public function documentBody(): HasOne
    {
        return $this->HasOne(DocumentBody::class);
    }
}
