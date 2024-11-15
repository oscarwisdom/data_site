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
        Schema::create('table_employees', function (Blueprint $table) {
            $table->id();
            $table->timestamps('names');
            $table->string("Department");
            $table->integer("age");
            $table->integer("salary");
            $table->string("image_path")->nullable();
            $table->text("description");
            $table->boolean("is_active")->nullable()->default(false);
            $table->timestamp();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_employees');
    }
};
