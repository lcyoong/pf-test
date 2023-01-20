<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('can add user record', function () {

    $user = User::factory()->create(['name' => 'John Doe']);

    $this->assertTrue(User::where('name', 'John Doe')->exists());
 
});