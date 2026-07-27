<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Log;
use OpenAI;

class AiService
{
  public function analyze(string $comment): array
  {

    try {

      if (!config('ai.api_key')) {
        throw new \Exception('AI key missing');
      }


      $client = OpenAI::factory()
        ->withApiKey(
          config('ai.api_key')
        )
        ->withBaseUri(
          config('ai.base_url')
        )
        ->make();


      $response = $client->chat()->create([
        'model' => config('ai.model'),

        'messages' => [

          [
            'role' => 'system',
            'content' =>
            'Ты помощник сайта разработчика.
                            Проанализируй сообщение пользователя.

                            Верни только JSON:
                            {
                                "sentiment": "positive|neutral|negative",
                                "response": "короткий ответ пользователю"
                            }'
          ],

          [
            'role' => 'user',
            'content' => $comment
          ],

        ],

      ]);


      $content =
        $response
          ->choices[0]
        ->message
        ->content;


      $result = json_decode(
        $content,
        true
      );


      return [
        'sentiment' =>
        $result['sentiment'] ?? 'unknown',

        'response' =>
        $result['response']
          ??
          'Спасибо за ваше обращение.',
      ];
    } catch (\Throwable $exception) {


      Log::error('AI service failed', [
        'error' => $exception->getMessage(),
      ]);


      return [

        'sentiment' => 'unknown',

        'response' =>
        'Спасибо за обращение. Мы скоро свяжемся с вами.',

      ];
    }
  }
}
