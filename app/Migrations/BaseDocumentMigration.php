<?php

namespace App\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

abstract class BaseDocumentMigration extends Migration
{
    /**
     * Add common fields to the given table.
     */
    protected function addBaseColumns(Blueprint $table)
    {
        $table->id();
        $table->unsignedBigInteger('user_id')->unique();
        $table->string('module');
        $table->string('title')->nullable();
        $table->json('metadata')->nullable();
        $table->text('encryption_key');
        $table->timestamps();
        $table->softDeletes();
    }
}
