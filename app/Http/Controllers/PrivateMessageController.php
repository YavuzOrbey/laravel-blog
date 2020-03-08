<?php

namespace App\Http\Controllers;

use App\PrivateMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Events\NewPrivateMessage;
class PrivateMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //get all the previous messages between the users
        $user = User::find($id);
        // make sure user from  isnt the same as user_to 
        // should also get messages TO 
        $privateMessagesFrom = PrivateMessage::where('user_from_id', Auth::id())->where('user_to_id', $user->id);
        $privateMessages = PrivateMessage::where('user_from_id', $user->id)->where('user_to_id',  Auth::id())->union($privateMessagesFrom)->orderBy('created_at')->get();
        $sending = [];
        foreach ($privateMessages as $key => $privateMessage) {
            $sending[$key]['from'] = $privateMessage->user_from->username;
            $sending[$key]['to'] = $privateMessage->user_to->username;
            $sending[$key]['text'] = $privateMessage->text;
            $sending[$key]['created_at'] = $privateMessage->created_at->format('H:i:s');
        }
        return response()->json($sending);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request, $user)
    {
        $privateMessage = PrivateMessage::create([ 

            'user_from_id' => Auth::id(),
            'user_to_id' => $user,
            'text'=>$request->body,
        ]); 
        $privateMessage = PrivateMessage::where('id', $privateMessage->id)->first();
        //$comment = Comment::where('id', $comment->id)->with('user')->first();
        //event(new NewComment($comment));
        broadcast(new NewPrivateMessage($privateMessage))->toOthers(); // this is the better way to do it
        $toSend = ['from' => $privateMessage->user_from->username,
        'to' =>  $privateMessage->user_to->username,
        'text' => $privateMessage->text,
        'created_at' => $privateMessage->created_at->format('H:i:s')];
        return $toSend;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrivateMessage  $privateMessage
     * @return \Illuminate\Http\Response
     */
    public function show(PrivateMessage $privateMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrivateMessage  $privateMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(PrivateMessage $privateMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrivateMessage  $privateMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrivateMessage $privateMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrivateMessage  $privateMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrivateMessage $privateMessage)
    {
        //
    }
}
