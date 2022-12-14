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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('title',255);
            $table->date('published_date');
            $table->text('synopsis');
            $table->unsignedSmallInteger('no_pages')->nullable();
            $table->string('isbn',16)->nullable();
            $table->string('cover_image')->nullable();
            $table->string('author');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
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
        // Schema::table('books', function (Blueprint $table) {
            // $table->dropForeign(['user_id']);
            // $table->dropForeign(['book_id']);

            // $table->dropColumn(['user_id']);
        // });
        Schema::dropIfExists('books');
        Schema::enableForeignKeyConstraints();
    }
};
