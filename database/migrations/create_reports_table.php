<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Reportable.
 *
 * (c) Brian Faust <hello@brianfaust.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('reportable');
            $table->morphs('reporter');
            $table->text('reason');
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('reports_conclusions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('report_id')->unsigned()->index();
            $table->morphs('judge');
            $table->text('conclusion');
            $table->text('action_taken');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
        Schema::dropIfExists('reports_conclusions');
    }
}
