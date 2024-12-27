<?php

namespace App\Http\Controllers;
use GlobalStudio\Common\Models\PageContent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use GlobalStudio\Common\Models\Service;
use App\Models\Booking;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use GlobalStudio\Common\Models\Page;

class BookingController extends Controller
{
    public function booking(){
        $page=Page::where('id',7)->get();
        $page_content=PageContent::where('page_id',7)->get();
        $services=Service::where('status',1)->get();
        return view('frontend.booking',compact('services','page','page_content'));
    }

    public function submit(Request $request)
{
    // Get email from site configuration
    $footerEmail = DB::table('site_config')
        ->where('key', 'mail')
        ->value('value');

    try {
        // Validate user input
        $validator = Validator::make($request->all(), [
            'treatment' => 'nullable|max:255',
            'messege' => 'nullable|max:255',
            'name' => 'nullable',
            'email' => 'required|email',
            'phone' => 'required'
        ]);
    
        if ($validator->fails()) {
            // Redirect back with error messages, old input, and a custom error message
            return redirect()->back()
                             ->with('error', 'Could not create') // Custom error message
                             ->withInput() // Retains old input data
                             ->withErrors($validator); // Sends validation errors
        }
        // Check if both emails (admin and user) are available
        if ($footerEmail || $request->email) {
            // Create a new contact record
            $booking = Booking::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'treatment' => $request->treatment,
                'messege' => $request->messege,
                'appointment_date' => $request->appointment_date,
                'visited_before' => $request->visited_before,
            ]);

            // Send email to admin
            Mail::to($footerEmail)->send(new \App\Mail\BookingFormMail(
                $booking->name,
                $booking->email,
                $booking->phone,
                $booking->treatment,               
                $booking->messege,
                $booking->appointment_date,
                $booking->visited_before,
            ));

            // Send confirmation email to user
            Mail::to($request->email)->send(new \App\Mail\BookingMail(
                $booking->name,
                $booking->email,
                $booking->phone,
                $booking->treatment,                
                $booking->messege,
                $booking->appointment_date,
                $booking->visited_before,
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
