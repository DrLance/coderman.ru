<?php

namespace App\Observers;

use App\Notifications\NewParsedItem;
use App\Models\ParsedData;
use Illuminate\Notifications\Notifiable;

class ParsedDataObserver
{
  use Notifiable;

    public function created(ParsedData $parsedData)
    {
      $this->notify(new NewParsedItem($parsedData));
    }

    public function updated(ParsedData $parsedData)
    {
        //
    }

    public function deleted(ParsedData $parsedData)
    {
        //
    }

    public function restored(ParsedData $parsedData)
    {
        //
    }

    public function forceDeleted(ParsedData $parsedData)
    {
        //
    }

  public function routeNotificationForSlack($notification) {
    return 'https://hooks.slack.com/services/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';
  }
}
