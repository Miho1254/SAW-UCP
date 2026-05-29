<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ucp_connections', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->index();
            $table->string('ip_address', 45);
            $table->tinyInteger('is_web')->default(0);
            $table->timestamp('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ucp_connections');
    }
};
