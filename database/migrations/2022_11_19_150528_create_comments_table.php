<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('comments');
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::table('comments', function (Blueprint $table) {
            // $table->dropForeign(['user_id']);
            $table->dropForeign(['book_id']);

            $table->dropColumn('book_id');

        });

        Schema::dropIfExists('comments');
        Schema::enableForeignKeyConstraints();
    }
};
