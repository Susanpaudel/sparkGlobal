<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GlobalStudio\Common\Models\Contact;
use Illuminate\Support\Facades\Mail;
class ContactController extends Controller
{
    // public function contacts(Request $request)
    // {
    //     // Get email from site configuration
    //     $footerEmail = DB::table('site_config')
    //         ->where('key', 'mail')
    //         ->value('value');
    
    //     try {
    //         // Validate user input
    //         $request->validate([
    //             'name' => 'nullable|max:255',
    //             'messege' => 'nullable|max:255',
    //             'subject' => 'nullable',
    //             'email' => 'required|email',
    //             'phone' => 'numeric|digits:10'  // Should be phone instead of contact
    //         ]);
    
    //         // Check if both emails (admin and user) are available
    //         if ($footerEmail || $request->email) {
    //             // Create a new contact record
    //             $contact = Contact::create([
    //                 'name' => $request->name,
    //                 'email' => $request->email,
    //                 'phone' => $request->phone,
    //                 'subject' => $request->subject,
    //                 'messege' => $request->messege,
    //             ]);
    
    //             // Send email to admin
    //             Mail::to($footerEmail)->send(new \App\Mail\ContactFormMail(
    //                 $contact->name,
    //                 $contact->email,
    //                 $contact->subject, 
    //                 $contact->phone,
    //                 $contact->messege
    //             ));
    
    //             // Send confirmation email to user
    //             Mail::to($request->email)->send(new \App\Mail\ContactMail(
    //                 $contact->name,
    //                 $contact->email,
    //                 $contact->phone,
    //                 $contact->subject,
    //                 $contact->messege
    //             ));
    
    //             // Redirect back with success message
    //             return redirect()->back()->with('success', 'Thanks for contacting us.');
    //         } else {
    //             // Redirect back with an error message if emails are missing
    //             return redirect()->back()->with('error', 'Both admin and user emails are required to send the message.');
    //         }
    
    //     } catch (ValidationException $e) {
    //         // Validation failed
    //         return redirect()->back()
    //             ->withInput()
    //             ->withErrors($e->validator->errors())
    //             ->with('error', 'Validation failed. Please check your inputs and try again.');
    //     } catch (\Exception $e) {
    //         return redirect()->back()
    //             ->with('alert-type', 'error')
    //             ->with('message', 'Something went wrong. Please try again.');
    //     }
    // }
    // In your ContactController.php

public function contacts(Request $request)
{
    // Get email from site configuration
    $footerEmail = DB::table('site_config')
        ->where('key', 'mail')
        ->value('value');

    try {
        // Validate user input
        $request->validate([
            'name' => 'nullable|max:255',
            'messege' => 'nullable|max:255',
            'subject' => 'nullable',
            'email' => 'required|email',
            'phone' => 'numeric|digits:10'
        ]);

        // Check if both emails (admin and user) are available
        if ($footerEmail || $request->email) {
            // Create a new contact record
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'messege' => $request->messege,
            ]);

            // Send email to admin
            Mail::to($footerEmail)->send(new \App\Mail\ContactFormMail(
                $contact->name,
                $contact->email,
                $contact->subject, 
                $contact->phone,
                $contact->messege
            ));

            // Send confirmation email to user
            Mail::to($request->email)->send(new \App\Mail\ContactMail(
                $contact->name,
                $contact->email,
                $contact->phone,
                $contact->subject,
                $contact->messege
            ));

            // Redirect back with success message
            return redirect()->back()->with('success', 'Thanks for contacting us.');
        } else {
            // Redirect back with an error message if emails are missing
            return redirect()->back()->with('error', 'Both admin and user emails are required to send the message.');
        }
    } catch (ValidationException $e) {
        // Validation failed
        return redirect()->back()
            ->withInput()
            ->withErrors($e->validator->errors())
            ->with('error', 'Validation failed. Please check your inputs and try again.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Something went wrong. Please try again.');
    }
}


    }

