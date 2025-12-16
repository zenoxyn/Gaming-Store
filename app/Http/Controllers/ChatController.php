<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\ChatParticipant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Get chats where user is a participant
        $chats = Chat::whereHas('participants', function ($query) use ($user) {
            $query->where('id_user', $user->id);
        })
        ->with(['participants.user', 'messages' => function($query) {
            $query->latest()->limit(1);
        }, 'product'])
        ->orderBy('last_message_at', 'desc')
        ->paginate(20);

        return view('chats.index', compact('chats'));
    }
    /**
     * Show the form for creating a new chat or continue existing one.
     */
    public function create(Request $request, $productId)
    {
        $user = Auth::user();
        $product = Product::with('seller.user')->findOrFail($productId);
        $seller = $product->seller->user;
        // Prevent users from chatting with themselves
        if ($user->id === $seller->id) {
            return redirect()->back()->with('error', 'You cannot chat with yourself.');
        }
        // Check if chat already exists between buyer and seller for this product
        $existingChat = Chat::whereHas('participants', function ($query) use ($user)
        {
            $query->where('id_user', $user->id);
        })->whereHas('participants', function ($query) use ($seller)
        {
            $query->where('id_user', $seller->id);
        })->where('id_product', $product->id)->first();
        if ($existingChat) {
            return redirect()->route('chat.show', $existingChat->id);
        }
        // Create new chat
        DB::beginTransaction();
        try {
            $chat = Chat::create([
                'id_product' => $product->id,
            ]);
            // Add participants
            ChatParticipant::create([
                'id_chat' => $chat->id,
                'id_user' => $user->id,
            ]);
            ChatParticipant::create([
                'id_chat' => $chat->id,
                'id_user' => $seller->id,
            ]);
            DB::commit();
            return redirect()->route('chat.show', $chat->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create chat: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified chat.
     */
    public function show($id)
    {
        $user = Auth::user();
        $chat = Chat::with(['participants.user', 'messages.sender', 'product'])->findOrFail($id);
        // Check if user is a participant
        if (!$chat->participants->contains('id_user', $user->id)) {
            abort(403, 'Unauthorized access to this chat.');
        }

        // Mark messages as read and reset unread count
        $myParticipant = $chat->participants->where('id_user', $user->id)->first();
        if ($myParticipant) {
            $myParticipant->resetUnread();
        }

        return view('chats.show', compact('chat'));
    }
    /**
     * Store a newly created message in storage.
     */
    public function storeMessage(Request $request, $chatId)
    {
        $user = Auth::user();
        $chat = Chat::with('participants')->findOrFail($chatId);
        // Check if user is a participant
        if (!$chat->participants->contains('id_user', $user->id)) {
            abort(403, 'Unauthorized access to this chat.');
        }
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);
        // Create message
        ChatMessage::create([
            'id_chat' => $chat->id,
            'id_sender' => $user->id,
            'message' => $validated['message'],
        ]);
        return redirect()->route('chat.show', $chat->id)
            ->with('success', 'Message sent successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        $user = Auth::user();

        // Check if user is a participant
        if (!$chat->participants->contains('id_user', $user->id)) {
            abort(403, 'Unauthorized action');
        }

        DB::beginTransaction();
        try {
            // Delete messages
            ChatMessage::where('id_chat', $chat->id)->delete();

            // Delete participants
            ChatParticipant::where('id_chat', $chat->id)->delete();

            // Delete chat
            $chat->delete();

            DB::commit();

            return redirect()->route('chat.index')
                ->with('success', 'Chat deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete chat: ' . $e->getMessage());
        }
    }
}

