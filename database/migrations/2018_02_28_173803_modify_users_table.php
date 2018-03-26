<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class ModifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('name');

        $table->string('first_name')->after('id');
        $table->string('last_name')->after('first_name');
        $table->timestamp('birthday')->index()->nullable()->after('email');
        $table->string('code_melli')->unique()->after('birthday');
        $table->string('position')->index()->after('code_melli');

        $table->softDeletes();

        $table->dropUnique('users_email_unique');
        $table->index('email');
        $table->index(['last_name' , 'first_name'] , 'users_name_index');
    });
}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('name')->after('id');

        $table->dropUnique('users_email_index');
        $table->unique('email');

        $table->dropColumn([
             'first_name',
             'last_name',
             'birthday',
             'code_melli',
             'position',
             'deleted_at'
        ]);

    });
}
}
