<?php

namespace App\View\Components\News;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\Http\Response;

class Notifications extends Component
{
    /**
     * notifications collection.
     */
    public $notifications;
    public $unread;
    public function __construct()
    {
        $user = Auth::user();
        $this->notifications = $user->notifications()->limit(6)->get();
        $this->unread = $user->unreadNotifications->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news.notifications');
    }

public function combinedView()
{
    $user = Auth::user();
        $notifications = $user->notifications()->orderBy('created_at', 'desc')
        ->paginate(10);
        $unread = $user->unreadNotifications->count();
    // Render 'auth.not' view
    $indexNotView = view('notificationspage.index',[
        'notifications' => $notifications,
        'unread' => $unread,
    ])->render();


    // Return the combined view as a response
    return new Response($indexNotView);
}
}
