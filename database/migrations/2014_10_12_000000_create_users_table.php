<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('photo');
            $table->string('phone_number');
            $table->string('password');
            $table->string('role');
            $table->string('code')->nullable();
            $table->string('email_varification_token', 32);
            $table->tinyInteger('email_varified')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        User::create([
            'fullName'                  => 'Developer-Rezwan',
            'email'                     => 'rezwanhossainsajeeb@gmail.com',
            'password'                  => Hash::make('password'),
            'photo'                     => 'photo_607e7f3a9bf4b4.345608964wZDRynhq9.png',
            'email_varification_token'  => Str::random(32),
            'email_varified'            => 1,
            'phone_number'              => 8801797840513,
            'role'                      => 'admin'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}