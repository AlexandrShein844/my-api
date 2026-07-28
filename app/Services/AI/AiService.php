<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Log;
use App\Enums\Sentiment;
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
            'Ты помощник сайта разработчика.Проанализируй сообщение пользователя. Верни только JSON в формате:
                            {
                                "sentiment": "positive|neutral|negative",
                                "response": "короткий ответ пользователю"
                            }
            sentiment может быть только positive, neutral или negative.
            Ответ пользователю должен быть коротким, вежливым и дружелюбным и только на том языке, на котором написано сообщение.
            Если не можешь определить sentiment, верни unknown.
            Если не можешь придумать ответ, верни "Спасибо за ваше обращение."
                            ',
                            
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

      if (!is_array($result)) {
        $result = [];
      }

      $sentiment = $result['sentiment'] ?? Sentiment::Unknown->value;

      if (!in_array(
        $sentiment,
        array_column(Sentiment::cases(), 'value'),
        true
      )) {
        $sentiment = Sentiment::Unknown->value;
      }


      return [
        'sentiment' => $sentiment,
        'response' => $result['response']
          ?? 'Спасибо за ваше обращение.',
      ];
    } catch (\Throwable $exception) {


      Log::error('AI service failed', [
        'error' => $exception->getMessage(),
      ]);


      return [

        'sentiment' => Sentiment::Unknown->value,

        'response' =>
        'Спасибо за обращение. Мы скоро свяжемся с вами.',

      ];
    }
  }
}
