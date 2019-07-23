<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableParsedDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsed_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_id');
            $table->timestamps();
            $table->timestamp('date_published_at')->nullable();
            $table->string('title');
            $table->string('url');
            $table->text('description');
            $table->string('category_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parsed_data');
    }
}
