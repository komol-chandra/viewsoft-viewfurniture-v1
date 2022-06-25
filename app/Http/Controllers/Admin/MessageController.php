<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //website message methods

    public function index()
    {
        $list = Message::where('type', 'blank')->where('is_deleted', 0)->latest()->get();
        return view('backend.website-message.index', \compact('list'));
    }

    public function status($id)
    {
        $data = Message::find($id);
        if ($data->is_active == 0) {
            $status = Message::where('id', $id)->update([
                'is_active'  => 1,
                'updated_at' => Carbon::now()->todateTimeString(),
            ]);
        } else {
            $status = Message::where('id', $id)->update([
                'is_active'  => 0,
                'updated_at' => Carbon::now()->todateTimeString(),
            ]);
        }

        if ($status) {
            $notification = [
                'messege'    => 'status change success!',
                'alert-type' => 'success',
            ];
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'messege'    => 'status change Faild!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
    //user message methods

    public function userMessageIndex()
    {
        $list = Message::with('user')->where('type', 'created_by_user')->where('is_deleted', 0)->latest()->get();
        return view('backend.website-message.user_message_index', \compact('list'));
    }

    public function userMessageReplay($id)
    {
        $data = Message::find($id);
        return view('backend.website-message.reply_message', \compact('data'));
    }

    public function userMessageReplayStore(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
            'message' => 'required',
            'user_id' => 'required',
        ]);

        if ($validated) {
            $insert = Message::insertGetId([
                'created_by' => auth()->user()->id,
                'user_id'    => $request->user_id,
                'subject'    => $request->subject,
                'type'       => 'created_by_admin',
                'message'    => $request->message,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            if ($insert) {
                $notification = [
                    'messege'    => 'Insert success!',
                    'alert-type' => 'success',
                ];
                return redirect('/admin/user-message/index')->with($notification);
            } else {
                $notification = [
                    'messege'    => 'insert Faild!',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }

        }
    }
}
