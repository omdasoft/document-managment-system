<?php

namespace App\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

abstract class BaseDocumentBodyMigration extends Migration
{
    /**
     * Add common fields to the given table.
     */
    protected function addBaseColumns(Blueprint $table)
    {
        $table->id();
        $table->foreignId('document_id')->constrained()->cascadeOnDelete();
        $table->text('encrypted_body');
        $table->string('checksum');
        $table->timestamps();
    }
}
