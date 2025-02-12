<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostNotification;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all());
    }

    public function updateStatus(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->status = $request->status;
        $post->save();

        // Send email notification
        Mail::to('admin@example.com')->send(new PostNotification($post));

        return response()->json(['message' => 'Post status updated and email sent']);
    }

    public function makeCall($id)
    {
        $post = Post::findOrFail($id);
        
        if (!$post->phone) {
            return response()->json(['message' => 'No phone number available'], 400);
        }

        // Simulate call (Replace this with an actual call API like Twilio)
        return response()->json(['message' => "Calling {$post->phone}..."]);
    }
    public function updateCallStatus(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->call_done = $request->call_done;
        $post->call_result = $request->call_done ? $request->call_result : null;
        $post->save();

        return response()->json(['message' => 'Call status updated successfully']);
    }
}
