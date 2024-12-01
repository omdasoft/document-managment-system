<?php

use App\Migrations\BaseDocumentBodyMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseDocumentBodyMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql_motors')->create('document_bodies', function (Blueprint $table) {
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_bodies');
    }
};
