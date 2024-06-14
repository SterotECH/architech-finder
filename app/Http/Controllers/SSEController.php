<?php

namespace App\Http\Controllers;

use App\Core\SSE;
use App\Core\Request;
use App\Models\Message;

class SSEController
{
  protected $sse;

  public function __construct()
  {
    $this->sse = new SSE();
  }

  public function stream(Request $request)
  {
    $lastEventId = isset($_GET['lastEventId']) ? intval($_GET['lastEventId']) : 0;

    $this->sse->setLastEventId($lastEventId);

    $this->sse->streamEvents();
  }

  public function sendMessage(Request $request)
  {
    $newMessage = new Message();

    $newMessage->message = $request->input('message');
    $newMessage->receiver_id = $request->input('receiver_id');
    $newMessage->project_id = $request->input('project_id');
    $newMessage->sender_id = auth()->user()->id;
    $newMessage->sent_at =  date('Y-m-d H:i:s');

    $result = $newMessage->save();


    if ($result) {
      echo json_encode(['status' => 'success']);
    } else {
      echo json_encode(['status' => 'fail', 'message' => 'Message could not be sent.']);
    }
  }

  public function uploadFile()
  {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['file']['tmp_name'];
      $fileName = $_FILES['file']['name'];
      $uploadFileDir = base_path('/public/uploads/');
      $dest_path = $uploadFileDir . $fileName;

      if (move_uploaded_file($fileTmpPath, $dest_path)) {
        echo json_encode(['status' => 'success', 'file_path' => $dest_path]);
      } else {
        echo json_encode(['status' => 'fail', 'message' => 'File upload failed.']);
      }
    } else {
      echo json_encode(['status' => 'fail', 'message' => 'File error.']);
    }
  }

  public function getMessages(Request $request)
  {
    return Message::where('project_id', $request->params()->projectId)
      ->where('sender_id', auth()->user()->id)
      ->get();
  }
}
