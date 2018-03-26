<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('missions', function (Blueprint $table) {
        $table->increments('id');
        $table->string('code')->index();
        $table->string('title')->index();
        $table->string('operator')->index();
        $table->mediumText('purpose')->nullable();
        $table->text('description')->nullable();
        $table->boolean('is_ratified')->default(false);
        $table->timestamp('planned_at')->nullable()->index();
        $table->timestamp('started_at')->nullable()->index();
        $table->timestamp('succeeded_at')->nullable()->index();
        $table->timestamp('failed_at')->nullable()->index();
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
public function down()
{
    Schema::dropIfExists('missions');
}
}
