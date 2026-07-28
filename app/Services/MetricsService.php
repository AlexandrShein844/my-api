<?php

namespace App\Services;

use App\Enums\Sentiment;
use App\Models\Contact;
use Carbon\Carbon;

class MetricsService
{
  public function get(): array
  {
    return [
      'total_contacts' => Contact::count(),

      'today_contacts' => Contact::whereDate(
        'created_at',
        Carbon::today()
      )->count(),

      'sentiment' => [
        'positive' => Contact::where(
          'ai_sentiment',
          Sentiment::Positive->value
        )->count(),

        'neutral' => Contact::where(
          'ai_sentiment',
          Sentiment::Neutral->value
        )->count(),

        'negative' => Contact::where(
          'ai_sentiment',
          Sentiment::Negative->value
        )->count(),

        'unknown' => Contact::where(function ($query) {
          $query->where(
            'ai_sentiment',
            Sentiment::Unknown->value
          )
            ->orWhereNull('ai_sentiment');
        })->count(),
      ],
    ];
  }
}
