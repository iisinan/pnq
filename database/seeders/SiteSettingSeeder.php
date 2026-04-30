<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            [
                'key' => 'hero_title_line_1',
                'value' => 'ENGINEERING',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_title_line_2',
                'value' => 'EXCELLENCE',
                'type' => 'text',
                'group' => 'hero',
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Transforming governance and enterprise through high-performance technology, strategic consultancy, and robust digital infrastructure.',
                'type' => 'textarea',
                'group' => 'hero',
            ],
            [
                'key' => 'about_mission_title',
                'value' => 'Our Mission & Visionary Approach.',
                'type' => 'text',
                'group' => 'about',
            ],
            [
                'key' => 'about_mission_desc_1',
                'value' => 'At Price and Quote, our mission is to empower organizations through innovative technology and strategic excellence. We believe that robust infrastructure and bespoke software are the backbones of modern progress.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about_hero_subtitle',
                'value' => 'Price and Quote is a premier technology firm specializing in enterprise infrastructure, strategic consultancy, and high-impact digital solutions.',
                'type' => 'textarea',
                'group' => 'about',
            ],
            [
                'key' => 'about_mission_desc_2',
                'value' => 'With a focus on government and enterprise-scale projects, we deliver solutions that are not only technologically advanced but also secure, scalable, and socially impactful.',
                'type' => 'textarea',
                'group' => 'about',
            ],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
