<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_attachment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->comment('User ID');
            $table->foreignId('document_id')->unsigned()->comment('Document ID');
            $table->foreignId('media_id')->unsigned()->comment('Media ID');
            $table->string('name')->nullable(false)->comment('Name');
            $table->string('slug')->nullable(false)->comment('Slug');
            $table->enum('status', [0,1])->default(1)->comment('Status');
            $table->timestamps();
            $table->softDeletes()->comment('Deleted At');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('document_attachment');
    }
}
