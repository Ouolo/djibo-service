<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'email'   => 'required|email',
            'subject' => 'required|string|max:150',
            'message' => 'required|string',
        ]);

        Mail::send([], [], function ($mail) use ($validated) {
            $mail->to('amadoudembele7548@gmail.com')
                 ->subject('Contact – ' . $validated['subject'])
                 ->html('
                    <div style="font-family:Arial,sans-serif;max-width:600px;margin:auto;border:1px solid #ddd;border-radius:10px;overflow:hidden;">
                        <div style="background:#2e7d32;padding:24px 32px;">
                            <h2 style="color:#fff;margin:0;">📩 Nouveau message – Djibo Services</h2>
                        </div>
                        <div style="padding:32px;background:#fff;">
                            <table style="width:100%;border-collapse:collapse;">
                                <tr><td style="padding:10px 0;color:#6b5e50;font-weight:600;width:130px;">Nom</td><td style="padding:10px 0;">' . htmlspecialchars($validated['name']) . '</td></tr>
                                <tr style="background:#f9f6f2;"><td style="padding:10px 8px;color:#6b5e50;font-weight:600;">Téléphone</td><td style="padding:10px 8px;">' . htmlspecialchars($validated['phone']) . '</td></tr>
                                <tr><td style="padding:10px 0;color:#6b5e50;font-weight:600;">E-mail</td><td style="padding:10px 0;"><a href="mailto:' . htmlspecialchars($validated['email']) . '">' . htmlspecialchars($validated['email']) . '</a></td></tr>
                                <tr style="background:#f9f6f2;"><td style="padding:10px 8px;color:#6b5e50;font-weight:600;">Sujet</td><td style="padding:10px 8px;">' . htmlspecialchars($validated['subject']) . '</td></tr>
                            </table>
                            <div style="margin-top:24px;padding:20px;background:#f9f6f2;border-radius:8px;border-left:4px solid #2e7d32;">
                                <strong style="color:#6b5e50;">Message :</strong>
                                <p style="margin:10px 0 0;line-height:1.7;">' . nl2br(htmlspecialchars($validated['message'])) . '</p>
                            </div>
                        </div>
                        <div style="background:#f9f6f2;padding:16px 32px;text-align:center;color:#999;font-size:13px;">
                            Djibo Services – Mopti, Sévaré, Mali
                        </div>
                    </div>
                 ');
        });

        return back()->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons sous 24h.');
    }
}