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
