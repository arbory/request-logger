<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLogTable extends Migration
{
    public function up(): void
    {
        Schema::create('admin_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name')->nullable()->index();
            $table->string('ip')->nullable();
            $table->string('forwarded_ip')->nullable();
            $table->string('request_method')->nullable();
            $table->text('request_uri')->nullable();
            $table->text('user_agent')->nullable();
            $table->text('http_referer')->nullable();
            $table->text('http_cookie')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admin_log');
    }
}
