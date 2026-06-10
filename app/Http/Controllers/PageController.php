<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Data shared or used across views
     */
    private function getProducts()
    {
        return [
            [
                'id' => 1,
                'name' => 'BioActivateur Sol-Plus',
                'category' => 'Activateurs',
                'is_featured' => true,
                'short_description' => 'Accélérateur biologique de compostage et régénérateur de sols fatigués.',
                'description' => 'Le BioActivateur Sol-Plus est une formule unique à base de micro-organismes bénéfiques qui accélère la décomposition des matières organiques et restructure les sols en libérant les nutriments bloqués. Idéal pour revitaliser les sols sahéliens et booster le rendement des cultures de manière 100% écologique.',
                'benefits' => [
                    'Régénère la structure humique du sol',
                    'Accélère le compostage (divise le temps par 3)',
                    'Améliore la rétention d’eau dans le sol',
                    'Stimule le développement racinaire'
                ],
                'usage' => 'Diluer 1 litre dans 100 litres d\'eau. Arroser le sol ou le tas de compost. Répéter toutes les 2 semaines.',
                'image' => 'assets/images/box-image/blog-01-330x330.jpg',
                'price' => '15 000 FCFA / Litre'
            ],
            [
                'id' => 2,
                'name' => 'Engrais Organique Djibo-Croissance',
                'category' => 'Fertilisants',
                'is_featured' => false,
                'short_description' => 'Engrais organique complet enrichi en azote naturel et oligo-éléments.',
                'description' => 'Spécialement formulé pour le maraîchage et les cultures céréalières, cet engrais organique assure une croissance vigoureuse sans risque de brûlure des racines ou de pollution des nappes phréatiques.',
                'benefits' => [
                    'Libération progressive des nutriments',
                    'Enrichi en oligo-éléments essentiels',
                    '100% respectueux de l\'environnement'
                ],
                'usage' => 'Appliquer 50g par plant au moment du repiquage ou du semis, puis incorporer légèrement au sol.',
                'image' => 'assets/images/box-image/blog-02-330x330.jpg',
                'price' => '8 500 FCFA / Sac de 25kg'
            ],
            [
                'id' => 3,
                'name' => 'Bioprotect Neem-Forte',
                'category' => 'Biopesticides',
                'is_featured' => false,
                'short_description' => 'Insecticide et répulsif naturel à base d\'extraits de neem concentrés.',
                'description' => 'Protégez vos cultures contre les ravageurs les plus courants (pucerons, chenilles, criquets) grâce à notre formulation naturelle biodégradable qui respecte les insectes pollinisateurs.',
                'benefits' => [
                    'Action systémique et de contact',
                    'Sans résidus chimiques nocifs',
                    'Élimine plus de 150 types de ravageurs'
                ],
                'usage' => 'Diluer 100ml dans 15 litres d\'eau (un pulvérisateur) et traiter les feuilles tôt le matin ou en fin de soirée.',
                'image' => 'assets/images/box-image/blog-03-330x330.jpg',
                'price' => '5 000 FCFA / Flacon de 500ml'
            ],
            [
                'id' => 4,
                'name' => 'Semences Maraîchères Sélectionnées',
                'category' => 'Semences',
                'is_featured' => false,
                'short_description' => 'Variétés de semences à haut rendement et résistantes à la chaleur.',
                'description' => 'Une sélection rigoureuse de semences de tomates, d\'oignons, de piments et de gombo, testées et approuvées pour leur adaptabilité au climat chaud et leur résistance aux maladies courantes.',
                'benefits' => [
                    'Taux de germination supérieur à 92%',
                    'Tolérance élevée au stress hydrique',
                    'Cycle court de production'
                ],
                'usage' => 'Semer en pépinière sur un substrat bien drainé et enrichi avec notre BioActivateur.',
                'image' => 'assets/images/box-image/blog-04-330x330.jpg',
                'price' => 'Prix variable selon la variété'
            ]
        ];
    }

    private function getServices()
    {
        return [
            [
                'slug' => 'formation',
                'title' => 'Formation Agricole',
                'icon' => 'fa-graduation-cap',
                'short_description' => 'Programmes de formation pratiques et adaptés aux techniques culturales modernes et écologiques.',
                'description' => 'Nous formons les producteurs agricoles, les jeunes et les entrepreneurs aux techniques innovantes de production, à la fabrication de compost enrichi, à la gestion de pépinières et à l\'agroécologie pratique.',
                'details' => [
                    'Techniques de maraîchage biologique',
                    'Gestion de l\'irrigation et économie d\'eau',
                    'Production d\'intrants organiques sur place',
                    'Entreprenariat agricole et gestion financière des exploitations'
                ]
            ],
            [
                'slug' => 'appui-conseil',
                'title' => 'Appui Conseil',
                'icon' => 'fa-comments',
                'short_description' => 'Orientation stratégique et conseils personnalisés pour optimiser le rendement de vos parcelles.',
                'description' => 'Nos experts agronomes se déplacent sur vos exploitations pour analyser vos sols, diagnostiquer les maladies de vos cultures et vous conseiller sur les meilleures pratiques agroécologiques adaptées à votre sol.',
                'details' => [
                    'Analyses rapides de la santé du sol',
                    'Plans de fertilisation sur mesure',
                    'Conseil en choix de variétés culturales',
                    'Aide à l\'aménagement et au design de fermes'
                ]
            ],
            [
                'slug' => 'suivi-accompagnement',
                'title' => 'Suivi Accompagnement',
                'icon' => 'fa-seedling',
                'short_description' => 'Assistance continue tout au long du cycle cultural pour sécuriser vos investissements.',
                'description' => 'Nous n\'abandonnons pas nos partenaires après les conseils. Nous mettons en place un calendrier de visites de suivi régulier pour s\'assurer de la bonne exécution des recommandations et corriger les dérives en temps réel.',
                'details' => [
                    'Visites périodiques de techniciens sur le terrain',
                    'Assistance téléphonique en cas d\'urgence phytosanitaire',
                    'Évaluation des rendements et bilan de fin de campagne',
                    'Accompagnement vers la certification biologique'
                ]
            ]
        ];
    }

    private function getRealisations()
    {
        return [
            [
                'id' => 1,
                'title' => 'Projet de Restauration des Sols à Segouboughou',
                'location' => 'Ségou (Mali)',
                'impact' => '15 hectares restaurés',
                'description' => 'Restauration de parcelles agricoles dégradées par l\'utilisation intensive de produits chimiques. Grâce à notre BioActivateur Sol-Plus, les producteurs ont retrouvé un rendement historique de 80% supérieur dès la première récolte d\'oignons.',
                'image' => 'assets/images/box-image/blog-01-330x330.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Aménagement de la Ferme École Djibo-Bio',
                'location' => 'Zone périurbaine de Ségou',
                'impact' => 'Plus de 500 producteurs formés par an',
                'description' => 'Création d\'un centre de démonstration agroécologique moderne combinant maraîchage, arboriculture et élevage intégré, fonctionnant entièrement à l\'énergie solaire et avec recyclage des déchets.',
                'image' => 'assets/images/box-image/blog-02-330x330.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Programme d\'Appui aux Coopératives Féminines',
                'location' => 'Cercle de Ségou',
                'impact' => '120 femmes accompagnées et autonomisées',
                'description' => 'Dotation en intrants organiques et formation complète sur la production de tomates hors-saison. Le projet a permis d\'augmenter les revenus mensuels des familles bénéficiaires de près de 150%.',
                'image' => 'assets/images/box-image/blog-03-330x330.jpg'
            ]
        ];
    }

    private function getTestimonials()
    {
        return [
            [
                'name' => 'Amadou Diallo',
                'role' => 'Maraîcher professionnel',
                'location' => 'Sébougou',
                'quote' => 'J\'utilisais des engrais chimiques depuis des années et mon sol devenait stérile et dur comme de la pierre. Depuis que j\'applique le BioActivateur de Djibo Service, la terre est redevenue meuble et mes oignons sont de bien meilleure qualité !',
                'image' => 'assets/images/testimonial/testimonial-01-70x70.png',
                'before_after' => [
                    'before' => 'Terre compacte et rendement de 8 tonnes/ha',
                    'after' => 'Terre riche et rendement de 14.5 tonnes/ha avec économie d\'eau'
                ]
            ],
            [
                'name' => 'Fatoumata Traoré',
                'role' => 'Présidente de coopérative',
                'location' => 'Pélengana',
                'quote' => 'La formation que nous avons reçue de Djibo Service a changé notre façon de voir l\'agriculture. Nous savons maintenant fabriquer notre propre compost en un temps record et nos produits se vendent plus cher car ils sont sains.',
                'image' => 'assets/images/testimonial/testimonial-02-70x70.png',
                'before_after' => [
                    'before' => 'Production aléatoire sujette aux maladies',
                    'after' => 'Contrôle biologique des ravageurs et récolte garantie stable'
                ]
            ]
        ];
    }

    private function getDistributors()
    {
        return [
            [
                'name' => 'Agro-Dealer Al-Baraka',
                'contact_name' => 'M. Ibrahim Maïga',
                'phone' => '+223 76 54 32 10',
                'location' => 'Grand Marché, Ségou',
                'address' => 'Rue 14, Secteur 2',
                'cities_covered' => 'Ségou Centre, Sébougou'
            ],
            [
                'name' => 'Maison des Intrants du Nord',
                'contact_name' => 'M. Lassana Diarra',
                'phone' => '+223 66 77 88 99',
                'location' => 'Gare Routière, Bla',
                'address' => 'Route Nationale 6',
                'cities_covered' => 'Bla, San'
            ],
            [
                'name' => 'Coopérative Agro-Pastoral de Pélengana',
                'contact_name' => 'Mme Koné Oumou',
                'phone' => '+223 79 12 34 56',
                'location' => 'Face Mairie, Pélengana',
                'address' => 'Avenue de la Liberté',
                'cities_covered' => 'Pélengana, Markala'
            ]
        ];
    }

    private function getNews()
    {
        return [
            [
                'title' => 'Lancement de notre nouveau catalogue d\'intrants organiques',
                'date' => '10 Juin 2026',
                'excerpt' => 'Découvrez nos nouveautés pour booster vos rendements de maraîchage biologique cet été.',
                'image' => 'assets/images/box-image/blog-01-330x330.jpg'
            ],
            [
                'title' => 'Campagne de formation gratuite pour les jeunes maraîchers',
                'date' => '05 Juin 2026',
                'excerpt' => 'Djibo Service organise un atelier pratique de 3 jours sur l\'utilisation rationnelle de l\'eau en agriculture.',
                'image' => 'assets/images/box-image/blog-02-330x330.jpg'
            ],
            [
                'title' => 'Comment fabriquer un compost de qualité en 21 jours ?',
                'date' => '28 Mai 2026',
                'excerpt' => 'Guide pratique expliquant les secrets de la fermentation accélérée avec le BioActivateur Sol-Plus.',
                'image' => 'assets/images/box-image/blog-03-330x330.jpg'
            ]
        ];
    }

    /**
     * Home Page (Accueil)
     */
    public function home()
    {
        $featured_product = collect($this->getProducts())->firstWhere('is_featured', true);
        $products = collect($this->getProducts())->where('is_featured', false)->take(3);
        $services = $this->getServices();
        $realisations = collect($this->getRealisations())->take(2);
        $testimonials = $this->getTestimonials();
        $news = $this->getNews();

        return view('home', compact('featured_product', 'products', 'services', 'realisations', 'testimonials', 'news'));
    }

    /**
     * About Page (À propos)
     */
    public function about()
    {
        $team = [
            [
                'name' => 'M. Bakary Djibo',
                'role' => 'Fondateur & Directeur Général',
                'bio' => 'Ingénieur agronome de formation avec plus de 20 ans d\'expérience dans le conseil agricole au Sahel.',
                'image' => 'assets/images/team/team-01.png'
            ],
            [
                'name' => 'Dr. Aminata Touré',
                'role' => 'Directrice Recherche & Développement',
                'bio' => 'Spécialiste de la microbiologie des sols, responsable de la formulation de notre BioActivateur.',
                'image' => 'assets/images/team/team-02.png'
            ],
            [
                'name' => 'M. Ousmane Coulibaly',
                'role' => 'Responsable Formation & Suivi Terrain',
                'bio' => 'Technicien supérieur d\'agriculture, toujours sur le terrain pour conseiller et guider les producteurs.',
                'image' => 'assets/images/team/team-03.png'
            ]
        ];

        return view('pages.about', compact('team'));
    }

    /**
     * Products Page (Nos produits)
     */
    public function products()
    {
        $products = $this->getProducts();
        return view('pages.products', compact('products'));
    }

    /**
     * Services Page (Nos services)
     */
    public function services()
    {
        $services = $this->getServices();
        return view('pages.services', compact('services'));
    }

    /**
     * Realisations Page (Nos réalisations)
     */
    public function realisations()
    {
        $realisations = $this->getRealisations();
        return view('pages.realisations', compact('realisations'));
    }

    /**
     * Testimonials Page (Témoignages)
     */
    public function testimonials()
    {
        $testimonials = $this->getTestimonials();
        return view('pages.testimonials', compact('testimonials'));
    }

    /**
     * Distributors Page (Nos distributeurs)
     */
    public function distributors()
    {
        $distributors = $this->getDistributors();
        return view('pages.distributors', compact('distributors'));
    }

    /**
     * Contact Page (Contact)
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Handle contact form submit (Simulated)
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // Real applications will mail or database store this.
        return back()->with('success', 'Merci pour votre message ! Notre équipe vous contactera très rapidement.');
    }
}
