<?php

use App\Models\About;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDeleted('cascade')->onUpdated('cascade');
            $table->text('education');
            $table->text('skills');
            $table->text('location');
            $table->text('description');
            $table->timestamps();
        });

        About::create([
            'user_id'       => 1,
            'education'     => 'B.S. in Computer Science from the University of Tennessee at Knoxville',
            'skills'        => 'Php,Laravel,Vue and Restfull Api Developer',
            'location'      => 'Dakkhin jhunagach chapani , Dimla , Nilphamari,Rangpur',
            'description'   => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut dolores sit doloribus asperiores illum voluptatum reiciendis quo vero fugit soluta? Nesciunt facere aut autem? Culpa delectus quaerat praesentium suscipit in!'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about');
    }
}