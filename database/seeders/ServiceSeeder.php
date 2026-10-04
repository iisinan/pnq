<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('services')->truncate();

        $services = [
            [
                'title' => 'IT Consulting',
                'slug' => 'it-consulting',
                'description' => 'Strategic technology roadmaps and digital transformation consulting for enterprise growth.',
                'content' => 'We provide comprehensive IT consultancy services to help organizations navigate the complex digital landscape. Our team of certified experts delivers technology roadmaps, digital maturity assessments, and transformation strategies that align with your business objectives.',
                'icon' => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
                'order' => 1,
            ],
            [
                'title' => 'Software Development',
                'slug' => 'software-development',
                'description' => 'Bespoke high-performance web, mobile, and enterprise applications built to scale.',
                'content' => 'Our expert developers build scalable and secure software solutions tailored to your unique business needs. From progressive web applications to native mobile experiences, we leverage modern frameworks and cloud-native architectures.',
                'icon' => 'M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5',
                'order' => 2,
            ],
            [
                'title' => 'Infrastructure & Networking',
                'slug' => 'infrastructure-networking',
                'description' => 'Secure, scalable, and resilient networking solutions for modern enterprise operations.',
                'content' => 'We design and implement enterprise-grade infrastructure solutions including data center architecture, cloud migration, network security, and managed IT services that ensure 99.99% uptime.',
                'icon' => 'M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-.778.099-1.533.284-2.253',
                'order' => 3,
            ],
            [
                'title' => 'Cybersecurity Solutions',
                'slug' => 'cybersecurity',
                'description' => 'End-to-end security auditing, compliance frameworks, and threat management.',
                'content' => 'Our cybersecurity practice provides comprehensive protection through vulnerability assessments, penetration testing, SOC operations, and compliance management for ISO 27001, NDPR, and international standards.',
                'icon' => 'M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z',
                'order' => 4,
            ],
            [
                'title' => 'Cloud & DevOps',
                'slug' => 'cloud-devops',
                'description' => 'Multi-cloud architecture, CI/CD pipelines, and infrastructure-as-code solutions.',
                'content' => 'We architect and manage cloud environments across AWS, Azure, and GCP. Our DevOps engineers implement automated pipelines, containerization strategies, and monitoring solutions that accelerate delivery cycles.',
                'icon' => 'M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z',
                'order' => 5,
            ],
            [
                'title' => 'Data Analytics & AI',
                'slug' => 'data-analytics-ai',
                'description' => 'Business intelligence, machine learning, and predictive analytics for informed decision-making.',
                'content' => 'We transform raw data into actionable insights using advanced analytics platforms, custom dashboards, and AI/ML models that drive competitive advantage and operational efficiency.',
                'icon' => 'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6',
                'order' => 6,
            ],
            [
                'title' => 'Constructions',
                'slug' => 'constructions',
                'description' => 'Civil engineering, structural development, and premium architectural solutions for national infrastructure.',
                'content' => 'We deliver large-scale construction projects including roads, bridges, and smart buildings. Our engineering team combines traditional excellence with modern smart-city technologies.',
                'icon' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-3h.75m-.75 3h.75m-3-6h.75m10.5 3h.75m-.75 3h.75m-3-3h.75m-.75 3h.75',
                'order' => 7,
            ],
            [
                'title' => 'Agriculture',
                'slug' => 'agriculture',
                'description' => 'Ag-Tech integration, smart irrigation systems, and sustainable agricultural development.',
                'content' => 'Transforming the agricultural sector through IoT-driven farming, supply chain automation, and precision agriculture technologies that maximize yield and sustainability.',
                'icon' => 'M12 3v15m0 0l-3-3m3 3l3-3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A4.501 4.501 0 0117.25 19.5H6.75z',
                'order' => 8,
            ],
            [
                'title' => 'Healthcare',
                'slug' => 'healthcare',
                'description' => 'Medical infrastructure, health information systems, and advanced epidemiological surveillance.',
                'content' => 'Building resilient healthcare ecosystems through digital record systems, telemedicine platforms, and advanced diagnostic infrastructure for public and private sectors.',
                'icon' => 'M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z',
                'order' => 9,
            ],
            [
                'title' => 'Oil and Gas',
                'slug' => 'oil-and-gas',
                'description' => 'Energy sector infrastructure, digital oilfield solutions, and strategic resource management.',
                'content' => 'Providing specialized technology and engineering solutions for the energy sector, including pipeline monitoring, production analytics, and operational safety systems.',
                'icon' => 'M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z',
                'order' => 10,
            ],
            [
                'title' => 'Renewable Energy',
                'slug' => 'renewable-energy',
                'description' => 'Solar, wind, and sustainable power solutions with smart grid integration.',
                'content' => 'Engineering the transition to clean energy through utility-scale solar farms, wind energy systems, and intelligent energy storage and distribution networks.',
                'icon' => 'M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z',
                'order' => 11,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
