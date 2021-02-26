<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * message controller.
 * @author Sumit <sumit.sharma@nmgtechnologies.com>
 */
class MessageController extends Controller
{
    /**
     * private message.
     *
     * @var [object]
     */
    private $message;
    /**
     * constructor of class.
     *
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $data['users']    = User::select("id", "name")->where("id", "<>", Auth::user()->id)->get();
            $data['messages'] = $this->message->getMessages(Auth::user()->id);
            return view("users.messages", $data);
        } catch (\Throwable $th) {
            Log::error($th->getMessage() . ' at line ' . $th->getLine());
            return back()->withErrors($th->getMessage());
        }
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
    public function store(Request $request)
    {
        try {
            $request->validate(Message::rules());
            info($request->all());
            $store = $this->message->create([
                "sender_id"   => Auth::user()->id,
                "content"     => $request->content,
                "receiver_id" => $request->receiver_id ? decrypt($request->receiver_id) : null,
            ]);
            if ($store) {
                info($store);
                return redirect()->route("message");
            }
        } catch (\Throwable $th) {
            return back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
