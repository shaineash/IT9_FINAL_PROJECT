<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

test('authenticated admin users are redirected to admin dashboard via generic dashboard route', function () {
    $user = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertRedirect(route('admin.dashboard', absolute: false));
});

test('authenticated regular users are redirected to user dashboard via generic dashboard route', function () {
    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertRedirect(route('user.dashboard', absolute: false));
});
