<?php

use App\Models\WorkerType;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('login page renders inside the main layout', function () {
    $this->get(route('login'))
        ->assertOk()
        ->assertViewIs('auth.login')
        ->assertSee('action="'.route('login').'"', false)
        ->assertSee('name="email"', false)
        ->assertSee('name="password"', false)
        ->assertSee(route('register'));
});

test('register page renders inside the main layout with worker types', function () {
    $workerType = WorkerType::create(['name' => 'Tukang Listrik']);

    $this->get(route('register'))
        ->assertOk()
        ->assertViewIs('auth.register')
        ->assertViewHas('workerTypes')
        ->assertSee('action="'.route('register').'"', false)
        ->assertSee('name="password_confirmation"', false)
        ->assertSee('value="'.$workerType->id.'"', false)
        ->assertSee('Tukang Listrik')
        ->assertSee(route('login'));
});
