<?php

namespace App\Http\Controllers;

use App\Events\newMessageCreated;
use App\Models\PublicChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class PublicChatController extends Controller
{
    public function index()
    {
        $tempChats = PublicChat::allChats();
        $chats = [];
        for ($i = count($tempChats) - 1; $i >= 0; $i--) {
            $time = explode(':', $tempChats[$i]['message_time'])[0] . ":" . explode(':', $tempChats[$i]['message_time'])[1];
            $tempChats[$i]['message_time'] = $time;
            $chats[] = $tempChats[$i];
        }
        $user_id = Cookie::get('user_id');
        if ($user_id == null) {
            Cookie::queue('user_id', rand(0, 100) + 1, 10500, false);
        }
        return view('chat.index', compact('chats', 'user_id'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $chats = ['message' => $request->message, 'id_user' => Cookie::get('user_id'), 'message_time' => date('H:i:s', strtotime('+6 Hours')), 'message_date' => date('Y-m-d', strtotime('now'))];
            PublicChat::storeNewChat($chats);
            DB::commit();
            newMessageCreated::dispatch($chats);
            return Response()->json(['message' => $request->message, 'id_user' => Cookie::get('user_id')], 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            dd($ex);
            return Response()->json(['message' => $request->message, 'id_user' => Cookie::get('user_id')], 500);
        }
    }
}
