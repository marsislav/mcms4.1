<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailSettings extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('settings', 'mail_host')) {
            Schema::table('settings', function (Blueprint $table) {
                $table->string('mail_host')->nullable()->after('contact_email');
                $table->string('mail_port')->nullable()->after('mail_host');
                $table->string('mail_username')->nullable()->after('mail_port');
                $table->string('mail_password')->nullable()->after('mail_username');
                $table->string('mail_encryption')->nullable()->after('mail_password');
                $table->string('mail_from_address')->nullable()->after('mail_encryption');
            });
        }
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['mail_host','mail_port','mail_username','mail_password','mail_encryption','mail_from_address']);
        });
    }
}
