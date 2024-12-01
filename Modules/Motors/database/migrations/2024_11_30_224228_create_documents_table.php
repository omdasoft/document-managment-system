<?php

use App\Migrations\BaseDocumentMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseDocumentMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('mysql_motors')->create('documents', function (Blueprint $table) {
            $this->addBaseColumns($table);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
