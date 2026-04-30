<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Certification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'admin@pq.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        // ========== SERVICES ==========
        $services = [
            [
                'title' => 'IT Consultancy',
                'slug' => 'it-consultancy',
                'description' => 'Strategic technology planning and digital transformation for enterprise and government organizations.',
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
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        // ========== PROJECTS ==========
        DB::table('projects')->truncate();

        $projects = [
            [
                'title' => 'Sativa Rice Mill Project',
                'slug' => 'sativa-rice-mill',
                'category' => 'Agriculture',
                'client_name' => 'Sativa Rice Mill',
                'year' => 2020,
                'description' => 'Comprehensive design, project monitoring, and consultancy services for a state-of-the-art rice milling facility.',
                'content' => 'This project encompassed full architectural, structural, and engineering designs, technical drawings, and detailed project execution frameworks. Price and Quote Limited provided strategic consultancy and continuous project monitoring to ensure quality and milestone compliance.',
                'thumbnail' => 'https://images.unsplash.com/photo-1536633101166-7918ba6a44ec?q=80&w=2070&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'Resettlement Housing - Southern Kebbi',
                'slug' => 'southern-kebbi-housing',
                'category' => 'Constructions',
                'client_name' => 'Mutual Commitment Company Limited (MCC)',
                'year' => 2024,
                'description' => 'Design, monitoring, and consultancy for 292 units of 3-bedroom housing under the Federal Government Resettlement Scheme.',
                'content' => 'A large-scale subcontract involving the complete design of housing units and infrastructure, preparation of bills of quantities, and rigorous project supervision and monitoring over a 24-month duration.',
                'thumbnail' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?q=80&w=2070&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'Agriculture Demonstration Center',
                'slug' => 'agric-demo-center',
                'category' => 'Agriculture',
                'client_name' => 'Mutual Commitment Group',
                'year' => 2022,
                'description' => 'Consultancy and engineering design for the Agriculture Demonstration Center at Abuja Technology Village.',
                'content' => 'Project scope included architectural and engineering designs, Environmental Impact Assessment (EIA) support, and quality assurance monitoring to establish a premier agricultural research and demonstration hub.',
                'thumbnail' => 'https://images.unsplash.com/photo-1560493676-04071c5f467b?q=80&w=1974&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'Dormitory & Maintenance Workshop Complex',
                'slug' => 'mcc-dormitory-complex',
                'category' => 'Constructions',
                'client_name' => 'Mutual Commitment Company Limited (MCC)',
                'year' => 2022,
                'description' => 'Design and construction of a multi-purpose complex including dormitories, office building, canteen, and workshops.',
                'content' => 'Delivery of specialized industrial and residential infrastructure involving the construction of 2No. dormitories, a central office, canteen, and a technical maintenance workshop over a 12-month period.',
                'thumbnail' => 'https://images.unsplash.com/photo-1541888946425-d81bb19240f5?q=80&w=2070&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'Solar Power Plant Training Centres',
                'slug' => 'solar-plant-training-centres',
                'category' => 'Renewable Energy',
                'client_name' => 'DEC/MCC Joint Venture',
                'year' => 2022,
                'description' => 'Design and monitoring for specialized workshop and training centers at NDA Kaduna and UNIMAID solar power plants.',
                'content' => 'Provision of design, quality assurance, and handover support for training facilities located at the Nigerian Defence Academy and University of Maiduguri, supporting the sustainable energy transition.',
                'thumbnail' => 'https://images.unsplash.com/photo-1509391366360-fe5bb58583bb?q=80&w=2070&auto=format&fit=crop',
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }

        // ========== TEAM MEMBERS ==========
        DB::table('team_members')->truncate();
        
        $team = [
            [
                'name' => 'Dr. Nasir Usman Imam',
                'role' => 'Chief Executive Officer',
                'bio' => 'A visionary leader with extensive experience in corporate governance and strategic management. Dr. Imam oversees the global operations of Price and Quote, driving innovation and excellence across all sectors since the company\'s inception in 2014.',
                'social_links' => ['linkedin' => '#'],
                'order' => 1,
            ],
            [
                'name' => 'Mr. Mustapha Abubakar',
                'role' => 'Director Operations',
                'bio' => 'An operational strategist with a proven track record in optimizing large-scale industrial and digital workflows. Mr. Abubakar ensures the seamless execution of complex projects nationwide.',
                'social_links' => ['linkedin' => '#'],
                'order' => 2,
            ],
            [
                'name' => 'Engr. Tijjani Abba Tijjani',
                'role' => 'Mechanical Engineer',
                'bio' => 'Expert mechanical engineer specializing in industrial infrastructure and structural integrity. Engr. Tijjani leads our engineering design and quality assurance initiatives.',
                'social_links' => ['linkedin' => '#'],
                'order' => 3,
            ],
            [
                'name' => 'Engr. Kabiru Abdullahi',
                'role' => 'Elect & Electronics Engineering',
                'bio' => 'Highly skilled electrical engineer with expertise in smart grid systems and industrial automation. Engr. Abdullahi spearheads our electronics and power infrastructure projects.',
                'social_links' => ['linkedin' => '#'],
                'order' => 4,
            ],
            [
                'name' => 'Mr. Abdullahi Haruna Adam',
                'role' => 'BSc. Computer Science',
                'bio' => 'Specialist in software architecture and digital systems development. Mr. Adam manages our technical implementation teams and ensures the delivery of high-performance digital solutions.',
                'social_links' => ['linkedin' => '#'],
                'order' => 5,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::create($member);
        }

        // ========== CERTIFICATIONS ==========
        $certs = [
            [
                'title' => 'CAC Registration',
                'issuer' => 'Corporate Affairs Commission',
                'description' => 'Fully registered corporate entity with the Corporate Affairs Commission of Nigeria.',
            ],
            [
                'title' => 'FIRS Tax Compliance',
                'issuer' => 'Federal Inland Revenue Service',
                'description' => 'Current tax clearance certificate and full compliance with federal tax regulations.',
            ],
            [
                'title' => 'ITF Compliance',
                'issuer' => 'Industrial Training Fund',
                'description' => 'Accredited training partner and fully compliant with Industrial Training Fund requirements.',
            ],
            [
                'title' => 'ISO 27001:2022',
                'issuer' => 'International Organization for Standardization',
                'description' => 'Certified Information Security Management System (ISMS) for enterprise data protection.',
            ],
            [
                'title' => 'NSITF Compliance',
                'issuer' => 'Nigeria Social Insurance Trust Fund',
                'description' => 'Full employee social insurance compliance and contribution certification.',
            ],
            [
                'title' => 'BPP Registration',
                'issuer' => 'Bureau of Public Procurement',
                'description' => 'Registered and certified vendor for public procurement and government contracts.',
            ],
            [
                'title' => 'PENCOM Compliance',
                'issuer' => 'National Pension Commission',
                'description' => 'Compliant with pension contribution regulations for all employees.',
            ],
            [
                'title' => 'ISO 9001:2015',
                'issuer' => 'International Organization for Standardization',
                'description' => 'Quality Management System certification ensuring consistent service delivery excellence.',
            ],
        ];

        foreach ($certs as $cert) {
            Certification::updateOrCreate(['title' => $cert['title']], $cert);
        }
    }
}
