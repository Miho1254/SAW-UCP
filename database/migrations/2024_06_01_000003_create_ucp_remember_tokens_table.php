<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ucp_remember_tokens', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->string('token', 64);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ucp_remember_tokens');
    }
};
