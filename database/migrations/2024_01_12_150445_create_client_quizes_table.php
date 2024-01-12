<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Quiz;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_quizes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Quiz::class)->nullable()->index()->constrained();
            $table->string('name');
            $table->string('first_name', 40);
            $table->string('last_name', 40);
            $table->string('email')->nullable();
            $table->integer('time_spent')->nullable();
            $table->float('total_score')->nullable();
            $table->integer('num_questions')->nullable();
            $table->integer('answered_questions')->nullable();
            $table->integer('unanswered_questions')->nullable();
            $table->json('questions')->nullable();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_quizes');
    }
};
