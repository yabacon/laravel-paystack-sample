<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('tasks');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks',
                      function (Blueprint $table) {
            Schema::create('tasks',
                           function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->index();
                $table->string('name');
                $table->timestamps();
            });
        });
    }
}
