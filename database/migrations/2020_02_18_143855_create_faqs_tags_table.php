<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faq_id')->nullable(false)->unsigned();
            $table->integer('tag_id')->nullable(false)->unsigned();
            $table->timestamps();

            $table->foreign('faq_id')->references('id')->on('faq');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->index(['faq_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs_tags');
    }
}
