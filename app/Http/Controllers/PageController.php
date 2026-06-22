<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
use App\Models\Produit;
use App\Models\Realisation;


class PageController extends Controller
{
    /**
     * Data shared or used across views
     */
    private function getProducts()
    {
        return Produit::actif()->get()->map(function ($p) {
            return [
                'id' => $p->id,
                'name' => $p->nom,
                'category' => $p->categorie,
                'is_featured' => $p->en_vedette,
                'short_description' => $p->description_courte,
                'description' => $p->description,
                'benefits' => is_array($p->avantages) ? $p->avantages : [],
                'usage' => $p->mode_emploi,
                'image' => empty($p->image) ? 'assets/images/box-image/blog-01-330x330.jpg' : (\Illuminate\Support\Str::startsWith($p->image, 'assets/')
                                ? $p->image
                                : 'storage/' . $p->image),
                'price' => $p->prix,
            ];
        })->toArray();
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
        $fromDb = Realisation::actif()->get();

        // Si la BDD contient des réalisations, on les utilise
        if ($fromDb->isNotEmpty()) {
            return $fromDb->map(function ($r) {
                return [
                    'id'          => $r->id,
                    'title'       => $r->titre,
                    'location'    => $r->localisation,
                    'impact'      => $r->impact,
                    'description' => $r->description,
                    'image'       => \Illuminate\Support\Str::startsWith($r->image ?? '', 'assets/')
                                        ? ($r->image ?? 'assets/images/realisation/formation.jpg')
                                        : 'storage/' . ($r->image ?? ''),
                ];
            })->toArray();
        }

        // Fallback statique si la BDD est vide
        return [
            [
                'id' => 1,
                'title' => 'Projet de Restauration des Sols à Segouboughou',
                'location' => 'Ségou (Mali)',
                'impact' => '15 hectares restaurés',
                'description' => 'Restauration de parcelles agricoles dégradées par l\'utilisation intensive de produits chimiques. Grâce à notre BioActivateur Sol-Plus, les producteurs ont retrouvé un rendement historique de 80% supérieur dès la première récolte d\'oignons.',
                'image' => 'assets/images/realisation/IMG-20260615-WA0129.jpg'
            ],
            [
                'id' => 2,
                'title' => 'Aménagement de la Ferme École Djibo-Bio',
                'location' => 'Zone périurbaine de Ségou',
                'impact' => 'Plus de 500 producteurs formés par an',
                'description' => 'Création d\'un centre de démonstration agroécologique moderne combinant maraîchage, arboriculture et élevage intégré, fonctionnant entièrement à l\'énergie solaire et avec recyclage des déchets.',
                'image' => 'assets/images/realisation/formation.jpg'
            ],
            [
                'id' => 3,
                'title' => 'Programme d\'Appui aux Coopératives Féminines',
                'location' => 'Cercle de Ségou',
                'impact' => '120 femmes accompagnées et autonomisées',
                'description' => 'Dotation en intrants organiques et formation complète sur la production de tomates hors-saison. Le projet a permis d\'augmenter les revenus mensuels des familles bénéficiaires de près de 150%.',
                'image' => 'assets/images/realisation/amenagement deni hectar en tomate.jpg'
            ],
        ];
    }

    private function getTestimonials()
    {
        return [
            [
                'name' => 'Amadou Diallo',
                'role' => 'Maraîcher professionnel',
                'location' => 'Mopti',
                'quote' => 'J\'utilisais des engrais chimiques depuis des années et mon sol devenait stérile et dur comme de la pierre. Depuis que j\'applique le BioActivateur de Djibo Service, la terre est redevenue meuble et mes oignons sont de bien meilleure qualité !',
                'image' => 'assets/images/logo-djibo.jpg',
                'before_after' => [
                    'before' => 'Terre compacte et rendement de 8 tonnes/ha',
                    'after' => 'Terre riche et rendement de 14.5 tonnes/ha avec économie d\'eau'
                ]
            ],
            [
                'name' => 'Fatoumata Traoré',
                'role' => 'Présidente de coopérative',
                'location' => 'Badiangara',
                'quote' => 'La formation que nous avons reçue de Djibo Service a changé notre façon de voir l\'agriculture. Nous savons maintenant fabriquer notre propre compost en un temps record et nos produits se vendent plus cher car ils sont sains.',
                'image' => 'assets/images/logo-djibo.jpg',
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
        $products         = collect($this->getProducts())->where('is_featured', false)->take(3);
        $services         = $this->getServices();
        $realisations     = collect($this->getRealisations())->take(3);
        $testimonials     = $this->getTestimonials();

        // Charger les actualités depuis la base de données
        $news = Actualite::publie()->take(3)->get()->map(function ($a) {
            return [
                'title'  => $a->titre,
                'date'   => $a->date_formattee,
                'excerpt'=> $a->extrait,
                'image'  => \Illuminate\Support\Str::startsWith($a->image, 'assets/')
                                ? $a->image
                                : 'storage/' . $a->image,
            ];
        });

        return view('home', compact('featured_product', 'products', 'services', 'realisations', 'testimonials', 'news'));
    }

    /**
     * About Page (À propos)
     */
    public function about()
    {
        $team = [
            [
                'name' => 'M. Baba Djibo',
                'role' => 'Fondateur & Directeur Général',
                'image' => 'assets/images/image-equipe/Baba Djibo .jpg'
            ],
            [
                'name' => 'Mme Nafi Kébé',
                'role' => 'Assistante Chargée De Projet & Programmation',
                'image' => 'assets/images/image-equipe/Nafi kebe.jpg'
            ],
            [
                'name' => 'M. Abdoulaye N. Traoré',
                'role' => 'Responsable Des Opérations',
                'image' => 'assets/images/image-equipe/Adboulaye N Traore.jpg'
            ],
            [
                'name' => 'M. Almamy Oumar Kane',
                'role' => 'Chargé Des Productions & Le Développement Des Innovations',
                'image' => 'assets/images/image-equipe/Almany oumar Kane.jpg'
            ],
            [
                'name' => 'M. Lasseini Pamanta',
                'role' => 'Responsable Administratif & Communication',
                'image' => 'assets/images/image-equipe/Lasseini Pamanta.jpg'
            ],
            [
                'name' => 'M. Nouhoum Djitèye',
                'role' => 'Responsable Logistique & Distribution',
                'image' => 'assets/images/image-equipe/NouhoumDjiteye.jpg'
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
     * Fiche Technique Page (Bonnes Pratiques)
     */
    public function ficheTechnique()
    {
        return view('pages.fiche-technique');
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
     * Public Actualites Page
     */
    public function actualites()
    {
        $actualites = Actualite::publie()->paginate(9);
        return view('pages.actualites', compact('actualites'));
    }

    /**
     * Public Actualite Detail Page
     */
    public function actualiteShow($slug)
    {
        $actualite = Actualite::where('slug', $slug)->where('publie', true)->firstOrFail();
        return view('pages.actualite-show', compact('actualite'));
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
