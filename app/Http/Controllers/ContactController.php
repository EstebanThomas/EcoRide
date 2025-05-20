<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Exception;

class ContactController extends Controller
{
    public function showContact()
    {
        return view('contact');
    }

    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ]);

        try{
            Mail::send('emails.contact', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'userMessage' => $validated['message'],
            ], function ($message) use ($validated) {
                $message->to('ecoride.et@gmail.com')
                        ->subject('Nouveau message de contact')
                        ->replyTo($validated['email'], $validated['name']);
            });

            return redirect()->route('contact.form')->with('success', 'Message envoyé avec succès !');
        } catch (Exception $e){
            return redirect()->route('contact.form')->with('error', 'Une erreur est survenue lors de l\'envoi de votre message : ' . $e->getMessage());
        }
        
    }
}