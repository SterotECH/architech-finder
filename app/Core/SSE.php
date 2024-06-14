<?php

namespace App\Core;

use App\Models\Message;

class SSE
{
  protected $clients;
  protected $lastEventId;

  public function __construct()
  {
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('Connection: keep-alive');

    $this->clients = new \SplObjectStorage();
    $this->lastEventId = 0;
  }

  public function addClient($client)
  {
    $this->clients->attach($client);
  }

  public function removeClient($client)
  {
    $this->clients->detach($client);
  }

  public function sendEvent($id, $data)
  {
    echo "id: $id\n";
    echo "data: $data\n\n";
    ob_flush();
    flush();
  }

  public function getLastEventId()
  {
    return $this->lastEventId;
  }

  public function setLastEventId($id)
  {
    $this->lastEventId = $id;
  }

  public function streamEvents()
  {
    while (true) {
      $newMessages = $this->getNewMessages();

      foreach ($newMessages as $message) {
        $this->sendEvent($message->id, json_encode($message));
        $this->setLastEventId($message->id);
      }

      sleep(3);
    }
  }

  protected function getNewMessages()
  {
    return Message::where('sender_id', auth()->user()->id)->get();
  }

  public function close()
  {
    echo "event: close\n";
    echo "data: Connection closed\n\n";
    ob_flush();
    flush();
  }
}
