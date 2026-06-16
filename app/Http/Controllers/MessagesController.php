<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Setting;

class MessagesController extends Controller
{
    public function submit(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'message' => 'required'
        ]);

        $contact = Message::create($request->only('name', 'email', 'message'));

        // Изпращане на имейл известие
        try {
            $settings    = Setting::first();
            $notifyEmail = $settings?->contact_email;

            if ($notifyEmail) {
                $name = $contact->name;
                $from = $contact->email;
                $msg  = $contact->message;
                $date = $contact->created_at->format('d.m.Y H:i');

                $html = '
                <div style="font-family:Arial,sans-serif;color:#333;max-width:600px;margin:30px auto;border:1px solid #ddd;border-radius:6px;overflow:hidden;">
                  <div style="background:#2d2d2d;color:#fff;padding:20px 30px;">
                    <h2 style="margin:0;font-size:18px;">📩 Ново съобщение от контактната форма</h2>
                  </div>
                  <div style="padding:25px 30px;">
                    <p><strong>Изпращач:</strong> ' . htmlspecialchars($name) . '</p>
                    <p><strong>Имейл:</strong> <a href="mailto:' . htmlspecialchars($from) . '">' . htmlspecialchars($from) . '</a></p>
                    <p><strong>Съобщение:</strong></p>
                    <div style="background:#f9f9f9;border-left:4px solid #2d2d2d;padding:12px 16px;white-space:pre-wrap;">' . htmlspecialchars($msg) . '</div>
                    <p style="color:#888;font-size:12px;margin-top:20px;">Получено на: ' . $date . '</p>
                  </div>
                </div>';

                $transport = (new \Swift_SmtpTransport(
                    config('mail.mailers.smtp.host'),
                    config('mail.mailers.smtp.port'),
                    config('mail.mailers.smtp.encryption')
                ))
                ->setUsername(config('mail.mailers.smtp.username'))
                ->setPassword(config('mail.mailers.smtp.password'));

                $mailer = new \Swift_Mailer($transport);

                $message = (new \Swift_Message('Ново съобщение от контактната форма: ' . $name))
                    ->setFrom([config('mail.from.address') => config('mail.from.name')])
                    ->setTo([$notifyEmail])
                    ->setReplyTo([$from => $name])
                    ->setBody($html, 'text/html');

                $mailer->send($message);
            }
        } catch (\Exception $e) {
            \Log::error('Contact form mail error: ' . $e->getMessage());
        }

        return redirect('/')->with('success', 'Message sent! Thanks! :)');
    }

    public function getMessages()
    {
        Message::where('is_read', false)->update(['is_read' => true]);
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.messages', compact('messages'));
    }

    public function delete($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully!');
    }

    public function unreadCount()
    {
        $count = Message::where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}