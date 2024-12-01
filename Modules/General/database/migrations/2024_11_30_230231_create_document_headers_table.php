<?php

use App\Migrations\BaseDocumentHeaderMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseDocumentHeaderMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql_general')->create('document_headers', function (Blueprint $table) {
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_headers');
    }
};
