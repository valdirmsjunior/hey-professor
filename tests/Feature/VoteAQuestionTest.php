<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('should be able to like a quesrtion', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //logando com o usuario
    actingAs($user);

    post(route('question.like', $question))->assertRedirect();

    //realizando consulta no banco de dados
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);
});

it('should not be able to like more than 1 time', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //logando com o usuario
    actingAs($user);

    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));
    post(route('question.like', $question));

    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});

it('should be able to unlike a quesrtion', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //logando com o usuario
    actingAs($user);

    post(route('question.unlike', $question))->assertRedirect();

    //realizando consulta no banco de dados
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 0,
        'unlike'      => 1,
        'user_id'     => $user->id,
    ]);
});

it('should not be able to unlike more than 1 time', function () {
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    //logando com o usuario
    actingAs($user);

    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));
    post(route('question.unlike', $question));

    expect($user->votes()->where('question_id', '=', $question->id)->get())->toHaveCount(1);
});
