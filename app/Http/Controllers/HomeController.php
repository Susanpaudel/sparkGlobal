<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

use App\Helpers\MyHelper;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use GlobalStudio\Common\Models\Blog;
use GlobalStudio\Common\Models\Page;
use Illuminate\Support\Facades\Mail;
use GlobalStudio\Common\Models\Contact;
use GlobalStudio\Common\Models\Service;
use GlobalStudio\Common\Models\Newsletter;
use GlobalStudio\Common\Models\TraderChooseUs;

class HomeController extends Controller
{
    public function index(){
        $sliders=Helper::getSliders();
        $chooses=Helper::getWhyChooseUs();
        $page=Page::with('pageContents')->find(1);
        return view('frontend.index',compact('sliders','chooses','page'));
    }

    public function about(){
        $page=Page::with('pageContents')->find(3);
        $chooses=Helper::getWhyChooseUs();
        return view('frontend.about',compact('page','chooses'));
    }

    public function service(){
        $services=Helper::getServices();
        $page=Page::find(8);
        return view('frontend.service',compact('services','page'));
    }

    public function service_single($slug){
        $service=Service::where('slug',$slug)->first();
        $traders=TraderChooseUs::whereIn('id',json_decode($service->trader_choose_us_id,true))->get();
        $client_benefit_titles=json_decode($service->client_benefit_title,true);
        $client_benefit_descriptions=json_decode($service->client_benefit_description,true);
        if(!$service){
            return redirect()->route('service')->with('error','Service not found!');
        }
        return view('frontend.service_single',compact('service','traders','client_benefit_titles','client_benefit_descriptions'));
    }

    public function blog(){
        $blogs=Helper::getBlogs();
        $page=Page::with('pageContents')->find(5);
        return view('frontend.blog',compact('blogs','page'));
    }

    public function blog_single($slug){
        $blog=Blog::where('slug',$slug)->first();
        if(!$blog){
            return redirect()->route('blogs')->with('error','Blog not found');
        }
        return view('frontend.blog_single',compact('blog'));
    }

    public function team(){
        $top_teams=Helper::getTeam(0);
        $buttom_teams=Helper::getTeam(1);
        $page=Page::with('pageContents')->find(6);
        return view('frontend.team',compact('top_teams','buttom_teams','page'));
    }

    public function contact(){
        $page=Page::with('pageContents')->find(7);
        return view('frontend.contact',compact('page'));
    }

    public function companyHistory(){
        $page=Page::with('pageContents')->find(4);
        return view('frontend.company_history',compact('page'));
    }

    public function transport(){
        return view('frontend.transport');
    }

    public function maintenance(){
        return view('frontend.maintenance');
    }

    public function equipment(){
        return view('frontend.equipment');
    }

    public function lifeSupport(){
        return view('frontend.life_support');
    }


    public function peopleOutsourcing(){
        return view('frontend.people_outsourcing');
    }

    public function contact_store(Request $request){
        $request->validate([
          'full_name'=>'required|max:255',
          'email'=>'required|email',
          'subject'=>'required|max:255',
          'comments'=>'nullable',
        ]);
        $contact=Contact::create([
            'name'=>strip_tags($request->full_name),
            'email'=>strip_tags($request->email),
            'subject'=>strip_tags($request->subject),
            'messege'=>strip_tags($request->comments),
        ]);
        $mail=MyHelper::getSiteConfig('mail');
        if($mail){
            Mail::to($mail)->send(new ContactFormMail($contact));
        }
       
        return back()->with('success','Email Send Successfully!');
    }

    public function newsletter_store(Request $request){
        $request->validate([
            'email'=>'required|email|unique:newsletters',
        ],
        [
            'email.unique'=>'You have aleady Subscribe to your Newsletter! Thank You.'
        ]
    );
    $contact=Newsletter::create([
        'email'=>strip_tags($request->email),
    ]);
   
    return back()->with('success','Thank you for subscribing our Newsletter!');

    }
}
