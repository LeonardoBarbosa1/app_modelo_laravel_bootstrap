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
        Schema::table('users', function(Blueprint $table){
            $table->unsignedBigInteger('tipo_conta_id')->nullable()->after('id');
            $table->foreign('tipo_conta_id')->references('id')->on('tipo_contas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function(Blueprint $table){
            $table->dropForeign('users_tipo_conta_id_foreign');
            $table->dropColumn('tipo_conta_id');
        });
    }
};
