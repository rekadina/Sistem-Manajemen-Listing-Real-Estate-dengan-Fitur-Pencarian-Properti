<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Featured properties (marked as featured and active)
        $featuredProperties = Property::where('featured', true)
    ->where('status', 'active')
    ->with(['category', 'user']) // <--- Ganti menjadi 'user'
    ->take(6)
    ->get();

        // Categories with property count
        $categories = Category::where('is_active', true)
            ->withCount(['properties' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('order')
            ->take(8)
            ->get();

        // Latest properties
        $latestProperties = Property::where('status', 'active')
            ->with(['category'])
            ->latest()
            ->take(8)
            ->get();

        // Stats for homepage
        $stats = [
            'total_properties' => Property::where('status', 'active')->count(),
            'featured_properties' => Property::where('featured', true)->where('status', 'active')->count(),
            'happy_clients' => 500, // This could be from database if you track clients
            'years_experience' => 15,
        ];

        return view('home', compact(
            'featuredProperties',
            'categories',
            'latestProperties',
            'stats'
        ));
    }

    public function about()
    {
        // Get agents for about page
        $agents = \App\Models\User::where('is_agent', true)
            ->take(4)
            ->get();

        // FAQ data
        $faqs = [
            [
                'question' => 'How do I schedule a property viewing?',
                'answer' => 'You can schedule a viewing by contacting us through our contact form or calling our office. We\'ll arrange a convenient time for you.'
            ],
            [
                'question' => 'What areas do you specialize in?',
                'answer' => 'We specialize in luxury properties in Beverly Hills, Malibu, Miami, New York, and international locations like Dubai and London.'
            ],
            [
                'question' => 'Do you offer property management services?',
                'answer' => 'Yes, we offer comprehensive property management services for luxury properties, including maintenance, tenant screening, and financial management.'
            ],
            [
                'question' => 'How do you determine property valuations?',
                'answer' => 'We use market analysis, comparable sales, property condition assessment, and current market trends to provide accurate valuations.'
            ],
        ];

        return view('about', compact('agents', 'faqs'));
    }

    public function contact()
    {
        $faqs = [
            [
                'question' => 'What are your business hours?',
                'answer' => 'Our office is open Monday through Friday from 9:00 AM to 6:00 PM, and Saturdays from 10:00 AM to 4:00 PM.'
            ],
            [
                'question' => 'How quickly will you respond to my inquiry?',
                'answer' => 'We aim to respond to all inquiries within 24 hours during business days.'
            ],
            [
                'question' => 'Do you offer virtual property tours?',
                'answer' => 'Yes, we offer virtual tours for all our listed properties. Contact us to schedule one.'
            ],
            [
                'question' => 'Can I list my property with LuxuryEstate?',
                'answer' => 'Absolutely! Contact us for a free property valuation and to discuss our listing services.'
            ],
        ];

        return view('contact', compact('faqs'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:255',
            'property_interest' => 'nullable|string|max:255',
            'message' => 'required|string|min:10',
            'newsletter' => 'nullable|boolean',
            'marketing' => 'nullable|boolean',
            'terms' => 'required|accepted',
        ]);

        // Here you would typically:
        // 1. Save the contact inquiry to database
        // 2. Send email notification
        // 3. Send confirmation email to user
        
        // For now, we'll just redirect with success message
        return redirect()->back()->with('success', 'Thank you for your message. We will contact you within 24 hours.');
    }
}