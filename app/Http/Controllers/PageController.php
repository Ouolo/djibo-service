<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actualite;
use App\Models\Produit;
use App\Models\Realisation;
use App\Models\Temoignage;


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
        // If a dedicated services table/model exists in the future this can be
        // replaced by a DB query. For now provide a safe static fallback so
        // views always receive an array (avoids foreach null errors).
        return [
            [
                'slug' => 'formation',
                'icon' => 'fa-chalkboard-teacher',
                'title' => 'Formations & Ateliers',
                'short_description' => 'Formations pratiques pour producteurs',
                'description' => 'Formations sur agroécologie, compostage et techniques de régénération des sols.',
                'details' => [
                    'Formation sur compostage et fertilité',
                    'Techniques de restauration des sols',
                    'Ateliers pratiques sur la gestion de ferme'
                ],
            ],
            [
                'slug' => 'conseil',
                'icon' => 'fa-handshake',
                'title' => 'Conseil & Accompagnement',
                'short_description' => 'Accompagnement technique sur-mesure',
                'description' => 'Accompagnement technique et organisationnel pour coopératives et projets.',
                'details' => [
                    'Diagnostic de ferme',
                    'Plan de fertilité',
                    'Suivi post-formation'
                ],
            ],
            [
                'slug' => 'produits',
                'icon' => 'fa-seedling',
                'title' => 'Fourniture de produits',
                'short_description' => 'Produits organiques et intrants',
                'description' => 'Vente d’intrants, composts et kits pratiques pour producteurs.',
                'details' => [
                    'Produits certifiés',
                    'Kits de démarrage',
                    'Livraison locale'
                ],
            ],
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
                'title' => 'Formation terrain à Koutiala',
                'location' => 'Koutiala',
                'impact' => 'Réduction de l érosion, +20% rendement',
                'description' => 'Programme de formation de 3 jours sur le compostage et les cultures associées.',
                'image' => 'assets/images/realisation/formation.jpg',
            ],
            [
                'id' => 2,
                'title' => 'Restauration de parcelle',
                'location' => 'Sikasso',
                'impact' => 'Réhabilitation de 5 ha',
                'description' => 'Intervention de régénération avec méthodes agroécologiques.',
                'image' => 'assets/images/realisation/ferme.jpg',
            ],
        ];
    }

    private function getTestimonials()
    {
        // Charger les témoignages depuis la base de données
        $fromDb = Temoignage::publie()->ordre()->get();

        if ($fromDb->isNotEmpty()) {
            return $fromDb->map(function ($t) {
                $result = [
                    'name' => $t->nom_client,
                    'role' => $t->role,
                    'location' => $t->localisation,
                    'type' => $t->type,
                    'quote' => $t->contenu,
                ];

                // Ajouter les médias selon le type
                if ($t->type === 'image' && $t->media) {
                    $result['image'] = $t->media_url;
                } elseif ($t->type === 'video' && $t->media) {
                    $result['video'] = $t->media_url;
                } else {
                    $result['image'] = 'assets/images/logo-djibo.jpg';
                }

                // Ajouter avant/après
                if ($t->avant || $t->apres) {
                    $result['before_after'] = [
                        'before' => $t->avant,
                        'after' => $t->apres
                    ];
                }

                return $result;
            })->toArray();
        }

        // Fallback static testimonials when DB is empty
        return [
            [
                'name' => 'Mariama C.',
                'role' => 'Productrice',
                'location' => 'Bamako',
                'type' => 'image',
                'quote' => 'Les formations m ont aidée à améliorer mes rendements.',
                'image' => 'assets/images/logo-djibo.jpg'
            ],
            [
                'name' => 'Oumar K.',
                'role' => 'Coopérative',
                'location' => 'Sikasso',
                'type' => 'image',
                'quote' => 'Accompagnement professionnel et utile.',
                'image' => 'assets/images/logo-djibo.jpg'
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
                'slug'   => $a->slug,
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
                'image' => 'assets/images/image-equipe/e2.jpeg'
            ],
            [
                'name' => 'M. Abdoulaye N. Traoré',
                'role' => 'Responsable Des Opérations',
                'image' => 'assets/images/image-equipe/e4.jpeg'
            ],
            [
                'name' => 'M. Almamy Oumar Kane',
                'role' => 'Chargé Des Productions & Le Développement Des Innovations',
                'image' => 'assets/images/image-equipe/e1.jpeg'
            ],
            [
                'name' => 'M. Lasseini Pamanta',
                'role' => 'Charge de la Gestion administrative et Financière',
                'image' => 'assets/images/image-equipe/Lasseini Pamanta.jpg'
            ],
            [
                'name' => 'M. Nouhoum Djitèye',
                'role' => 'Chargé Communication & Marketing',
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
     * Show a single realisation (public)
     */
    public function realisationShow($id)
    {
        // Try to load from DB first
        if (class_exists(Realisation::class)) {
            $r = Realisation::find($id);
            if ($r) {
                $realisation = [
                    'id' => $r->id,
                    'title' => $r->titre,
                    'location' => $r->localisation,
                    'impact' => $r->impact,
                    'description' => $r->description,
                    'image' => \Illuminate\Support\Str::startsWith($r->image ?? '', 'assets/') ? ($r->image ?? '') : 'storage/' . ($r->image ?? ''),
                ];
                return view('pages.realisation-show', compact('realisation'));
            }
        }

        // Fallback to static list
        $list = $this->getRealisations();
        foreach ($list as $item) {
            if ((int) ($item['id'] ?? 0) === (int) $id) {
                $realisation = $item;
                return view('pages.realisation-show', compact('realisation'));
            }
        }

        abort(404);
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
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'required|string|max:30',
        'subject' => 'required|string|max:255',
        'message' => 'required|string'
    ]);

    // Sauvegarde en BDD
    Contact::create($request->only([
        'name', 'email', 'phone', 'subject', 'message'
    ]));

    // Envoi email à djiboservices@gmail.com
    Mail::to('djiboservices@gmail.com')->send(new ContactMail($request->all()));

    return back()->with('success', 'Merci pour votre message ! Notre équipe vous contactera très rapidement.');
}
}
