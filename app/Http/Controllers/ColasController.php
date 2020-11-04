<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Url;
Use App;
use App\Http\Controllers\Auth;

class ColasController extends Controller
{


  public function store(Request $request ) {
    
    define("RABBITMQ_HOST", "rabbitmq");
    define("RABBITMQ_PORT", 5672);
    define("RABBITMQ_USERNAME", "admin");
    define("RABBITMQ_PASSWORD", "admin");
    define("RABBITMQ_QUEUE_NAME", "default");

    $connection = new \PhpAmqpLib\Connection\AMQPStreamConnection(
        RABBITMQ_HOST, 
        RABBITMQ_PORT, 
        RABBITMQ_USERNAME, 
        RABBITMQ_PASSWORD
    );

    $channel = $connection->channel();


    $channel->queue_declare(
        $queue = RABBITMQ_QUEUE_NAME,
        $passive = false,
        $durable = true,
        $exclusive = false,
        $auto_delete = false,
        $nowait = false,
        $arguments = null,
        $ticket = null
    );

        $ViArray = array(
            'id' =>$request->id,
            'user_id' =>auth()->user()->id,
            'link' => $request->url,
            'format' => $request->format
        );
        
        
        $msg = new \PhpAmqpLib\Message\AMQPMessage(
            json_encode($ViArray, JSON_UNESCAPED_SLASHES),
            array('delivery_mode' => 2)
        );
            
        $channel->basic_publish($msg, '', RABBITMQ_QUEUE_NAME);
        return back();
    }
}
