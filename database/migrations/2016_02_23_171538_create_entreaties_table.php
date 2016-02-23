<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntreatiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entreaties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('recipient_name');
            $table->string('recipient_email');
            $table->string('invoice_title');
            $table->text('invoice_description');
            $table->decimal('amount',10,2);
            $table->boolean('invoice_paid')->default(false);
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
        Schema::drop('entreaties');
    }
}
