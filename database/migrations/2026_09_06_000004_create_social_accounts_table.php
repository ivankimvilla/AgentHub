<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('platform');
            $table->string('handle');
            $table->text('access_token')->nullable();
            $table->boolean('publishing_enabled')->default(true);
            $table->timestamps();
            $table->unique(['user_id', 'platform', 'handle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_accounts');
    }
};
