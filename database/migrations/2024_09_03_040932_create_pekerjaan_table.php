<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pekerjaan', function (Blueprint $table) {
            $table->id();
            $table->string('pekerjaan');
            $table->integer('laki_laki');
            $table->integer('perempuan');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pekerjaan');
    }
};
