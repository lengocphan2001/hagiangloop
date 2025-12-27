<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Send contact email.
     */
    public function send(ContactRequest $request)
    {
        try {
            $validated = $request->validated();
            
            // Log before sending
            Log::info('Attempting to send contact email', [
                'to' => 'lengocphan503@gmail.com',
                'from' => config('mail.from.address'),
                'mailer' => config('mail.default'),
            ]);
            
            // Send email
            Mail::to('lengocphan503@gmail.com')->send(new ContactMail($validated));
            
            Log::info('Contact form submitted successfully', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'whatsapp' => $validated['whatsapp'],
            ]);
            
            return back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            Log::error('Failed to send contact email', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'mail_driver' => config('mail.default'),
                'mail_host' => config('mail.mailers.smtp.host'),
            ]);
            
            // In development, show detailed error. In production, show generic message
            $errorMessage = config('app.debug') 
                ? 'Error: ' . $e->getMessage() . ' (Check logs/storage/logs/laravel.log for details)'
                : 'Sorry, there was an error sending your message. Please try again later or contact us directly.';
            
            return back()->with('error', $errorMessage)->withInput();
        }
    }
}

