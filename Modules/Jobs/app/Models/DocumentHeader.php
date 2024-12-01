<?php

namespace Modules\Jobs\Models;

use App\Enums\ModuleType;
use App\Models\BaseDocumentHeader;
use App\Traits\UseModuleDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\General\Database\Factories\DocumentHeaderFactory;

class DocumentHeader extends BaseDocumentHeader
{
    use HasFactory, UseModuleDatabase;

    protected $module = ModuleType::JOBS->value;
}
