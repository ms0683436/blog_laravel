<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentToLikelistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likelist', function (Blueprint $table) {
            $table->renameColumn('post_id', 'object_id');
            $table->integer('object');
            $table->dropPrimary(['user_id', 'object_id']);
            $table->primary(['user_id', 'object_id', 'object']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likelist', function (Blueprint $table) {
            $table->dropPrimary(['user_id', 'post_id', 'object']);
            $table->primary(['user_id', 'post_id']);
            $table->dropColumn('object');
            $table->renameColumn('object_id', 'post_id');
        });
    }
}
