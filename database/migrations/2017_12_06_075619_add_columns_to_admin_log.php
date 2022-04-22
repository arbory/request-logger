<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToAdminLog extends Migration
{
    public function up(): void
    {
        Schema::table('admin_log', function (Blueprint $table) {
            $table->dropColumn('forwarded_ip');
            $table->text('ips')->nullable();
            $table->string('http_content_type')->nullable();
            $table->text('session')->nullable();
            $table->text('content')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('admin_log', function (Blueprint $table) {
            $table->string('forwarded_ip')->nullable();
            $table->dropColumn('ips');
            $table->dropColumn('http_content_type');
            $table->dropColumn('session');
            $table->dropColumn('content');
        });
    }
}
