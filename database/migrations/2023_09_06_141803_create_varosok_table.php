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
        Schema::create('varosok', function (Blueprint $table) {
            $table->id("va_id");
            $table->integer("va_meid",false,true)->default(0)->comment("megye tábla id-ja");
            $table->string("va_nev",30)->default("")->comment("város neve");
            $table->timestamp('va_created')->useCurrent();
            $table->timestamp('va_updated')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('varosok');
    }
};
