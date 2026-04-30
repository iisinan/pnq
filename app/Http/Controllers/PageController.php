<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Certification;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    private function getSettings()
    {
        return SiteSetting::all()->pluck('value', 'key');
    }

    public function index()
    {
        return Inertia::render('Welcome', [
            'settings' => $this->getSettings(),
            'services' => Service::where('is_active', true)->orderBy('order')->get(),
            'featuredProjects' => Project::where('is_featured', true)->take(4)->get(),
        ]);
    }

    public function about()
    {
        return Inertia::render('About', [
            'settings' => $this->getSettings(),
            'team' => TeamMember::orderBy('order')->get(),
            'certifications' => Certification::all(),
        ]);
    }

    public function services()
    {
        return Inertia::render('Services', [
            'services' => Service::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function portfolio()
    {
        return Inertia::render('Portfolio', [
            'projects' => Project::orderBy('year', 'desc')->get(),
        ]);
    }

    public function team()
    {
        return Inertia::render('Team', [
            'team' => TeamMember::orderBy('order')->get(),
        ]);
    }

    public function contact()
    {
        return Inertia::render('Contact');
    }
}
