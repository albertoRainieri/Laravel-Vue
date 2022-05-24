<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
        });

        DB::table(Category::TABLE_NAME)->insert(
            array(
                Category::NAME     =>   'Home',
                Category::DESCRIPTION => 'Everything related to Home Section'
            )
        );

        DB::table(Category::TABLE_NAME)->insert(
            array(
                Category::NAME     =>   'Office',
                Category::DESCRIPTION => 'Everything related to Office Section'
            )
        );


        DB::table(Category::TABLE_NAME)->insert(
            array(
                Category::NAME     =>   'Other',
                Category::DESCRIPTION => 'Everything related to Other Section'
            )
        );

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }




}
