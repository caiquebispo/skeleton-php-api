<?php

use Illuminate\Database\Capsule\Manager as Capsule;


// Cria a tabela de users se não existir
if (!Capsule::schema()->hasTable('users')) {

    Capsule::schema()->create('users', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('remember_token')->nullable();
        $table->timestamps();
    });

}