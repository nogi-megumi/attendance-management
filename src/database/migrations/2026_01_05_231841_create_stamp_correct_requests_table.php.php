<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamp_correct_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('attendance_id');
            $table->dateTime('updated_start_at');
            $table->dateTime('updated_end_at');
            $table->json('updated_rests')->nullable();
            $table->text('note');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
