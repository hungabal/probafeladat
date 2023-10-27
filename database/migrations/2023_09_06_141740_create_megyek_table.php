<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('megyek', function (Blueprint $table) {
            $table->id("me_id");
            $table->string("me_nev",30)->default("")->comment("megye neve");
            $table->timestamp('me_created')->useCurrent();
            $table->timestamp('me_updated')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('megyek');
    }
};
