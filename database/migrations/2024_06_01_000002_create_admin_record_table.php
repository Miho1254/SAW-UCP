<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admin_record', function (Blueprint $table) {
            $table->integer('record_id', true);
            $table->integer('account_id')->index();
            $table->string('record_type', 50);
            $table->string('record_reason', 255);
            $table->integer('record_admin');
            $table->integer('record_time')->default(0);
            $table->string('record_date', 50);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_record');
    }
};
