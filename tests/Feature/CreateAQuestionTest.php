<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    //arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    //Assert :: verificar
    $request->assertRedirect(route('dashboard'));
    assertDatabaseCount('questions', 1);
    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);

});

it('should create as a draft all the time', function () {
    //arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: Agir
    post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    //Assert :: verificar
    assertDatabaseHas('questions', [
        'question' => str_repeat('*', 260) . '?',
        'draft'    => true,
    ]);
});

it('should check if ends with question mark ?', function () {
    //arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    //Assert :: verificar
    $request->assertSessionHasErrors(['question' => 'Are you sure that is a question?, It is missing the question mark in the end.']);
    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {
    //arrange :: preparar
    $user = User::factory()->create();
    actingAs($user);

    //Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    //Assert :: verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]);
    assertDatabaseCount('questions', 0);
});
