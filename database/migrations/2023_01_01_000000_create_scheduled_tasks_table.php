<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('scheduled_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cron_expression');
            $table->string('command');
            $table->string('timezone')->default('UTC');
            $table->boolean('enabled')->default(true);
            $table->timestamp('last_run_at')->nullable();
            $table->timestamp('next_run_at')->nullable();
            $table->string('status')->nullable();
            $table->text('output')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scheduled_tasks');
    }
};