<?php

namespace Modules\Jobs\Models;

use App\Enums\ModuleType;
use App\Models\BaseDocumentBody;
use App\Traits\UseModuleDatabase;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// use Modules\General\Database\Factories\DocumentBodyFactory;

class DocumentBody extends BaseDocumentBody
{
    use HasFactory, UseModuleDatabase;

    protected $module = ModuleType::JOBS->value;
}
