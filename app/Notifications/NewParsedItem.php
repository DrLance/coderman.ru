<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class NewParsedItem extends Notification {
  use Queueable;

  /**
   * Create a new notification instance.
   *
   * @return void
   */
  private $parsedData = [];

  public function __construct($parsedData) {
    $this->parsedData = $parsedData;
  }

  /**
   * Get the notification's delivery channels.
   *
   * @param mixed $notifiable
   *
   * @return array
   */
  public function via($notifiable) {
    return ['slack'];
  }

  /**
   * Get the mail representation of the notification.
   *
   * @param mixed $notifiable
   *
   * @return \Illuminate\Notifications\Messages\MailMessage
   */
  public function toMail($notifiable) {
    return (new MailMessage)
      ->line('The introduction to the notification.')
      ->action('Notification Action', url('/'))
      ->line('Thank you for using our application!');
  }

  /**
   * Get the array representation of the notification.
   *
   * @param mixed $notifiable
   *
   * @return array
   */
  public function toArray($notifiable) {
    return [
      //
    ];
  }

  public function toSlack($notifiable) {
    $data = $this->parsedData;

    return (new SlackMessage)
      ->success()
      ->content('Добавлен новый проект')
      ->attachment(function($attachmet) use ($data) {
        $attachmet->title($data->title, $data->url)->fields([
          'Description' => $data->description
        ]);
      });
  }
}
