<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function showNotificaton()
    {
        $notifications = Auth::user()->unreadNotifications;
        return view('partials.show_notification', compact('notifications'));
    }

    public function markNotification($type, $id)
    {
        Auth::user()
            ->unreadNotifications
            ->when($id, function ($query) use ($id) {
                return $query->where('id', $id);
            })
            ->markAsRead();

        $jsonData = DB::table('notifications')->where('id', $id)->get('data')->toArray();

        // Accessing the item from the array
        $item = $jsonData[0]->data;

        // Decoding the JSON string into an associative array
        $data = json_decode($item, true);
        $url = $data['0'];

        if ($type == "sales")
            return redirect($url);
        else
            return redirect($url);
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function sendQuoteNotification(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:quotes,id',
        ]);

        $quote = Quote::find($request->id)->first();

        $quote['buttonText'] = 'View Quotes';
        $quote['quoteUrl'] = route('show.quotes');
        $quote['thanks'] = 'Your thank you message';

        $admins = User::whereHas('roles', function ($q) {
            $q->where('id', 1);
        })->get();

        foreach ($admins as $admin) {
            Notification::send($admin, new UserNotification($quote));
        }

        return back()->with('success', 'You have successfully the quote');
    }

    public function sendSaleNotification(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
        ]);

        $quote = Quote::find($request->invoice_id)->first();

        $quote['buttonText'] = 'View Sale';
        $quote['quoteUrl'] = route('show.quotes');
        $quote['thanks'] = 'Your thank you message';

        $admins = User::whereHas('roles', function ($q) {
            $q->where('id', 1);
        })->get();

        foreach ($admins as $admin) {
            Notification::send($admin, new UserNotification($quote));
        }

        return back()->with('You have successfully paid the invoice');
    }
}
