<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddIndexToParsedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parsed_data', function (Blueprint $table) {
            DB::statement("create index parsed_data_description_title on parsed_data using GIN (to_tsvector('english', description || ' ' || title) )");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parsed_data', function (Blueprint $table) {
            $table->dropIndex('parsed_data_description_title');
        });
    }
}
