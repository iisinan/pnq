<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
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
                'thumbnail' => '/images/rice_mill.png',
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
                'thumbnail' => '/images/agriculture.png',
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
                'thumbnail' => '/images/solar.png',
                'is_featured' => true,
            ],
            [
                'title' => 'Irshad Platform',
                'slug' => 'irshad-platform',
                'category' => 'Software Development',
                'client_name' => 'Irshad',
                'year' => 2024,
                'description' => 'Development of a comprehensive digital platform. Visit: https://iirshad.com/',
                'content' => 'End-to-end software development and deployment of the Irshad platform (https://iirshad.com/). The project involved full-stack web development, API integrations, and scalable cloud infrastructure deployment to support a seamless user experience.',
                'thumbnail' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2070&auto=format&fit=crop',
                'is_featured' => true,
            ],
            [
                'title' => 'ACETEL Thesis Monitoring System',
                'slug' => 'acetel-tms',
                'category' => 'Software Development',
                'client_name' => 'ACETEL / NOU',
                'year' => 2023,
                'description' => 'Thesis Monitoring System for the National Open University of Nigeria (NOUN). Visit: https://aceteltms.nou.edu.ng/',
                'content' => 'Design and development of a robust Thesis Monitoring System (https://aceteltms.nou.edu.ng/) for ACETEL at the National Open University of Nigeria. The platform streamlines thesis submission, tracking, and evaluation for students and faculty.',
                'thumbnail' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070&auto=format&fit=crop',
                'is_featured' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
