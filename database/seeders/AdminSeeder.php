<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Actualite;
use App\Models\Produit;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create superadmin role
        $superAdminRole = Role::where('slug', 'superadmin')->first();
        
        // Créer le compte administrateur
        $admin = User::updateOrCreate(
            ['email' => 'admin@djiboservice.com'],
            [
                'name'     => 'Administrateur Djibo',
                'email'    => 'admin@djiboservice.com',
                'password' => Hash::make('djibo@2026'),
                'is_admin' => true,
                'role_id'  => $superAdminRole ? $superAdminRole->id : null,
            ]
        );

        $this->command->info('✅ Compte admin créé : admin@djiboservice.com / djibo@2026');

        // Créer quelques publications d'exemple
        $publications = [
            [
                'titre'            => 'Lancement de notre nouveau catalogue d\'intrants organiques',
                'extrait'          => 'Découvrez nos nouveautés pour booster vos rendements de maraîchage biologique cet été.',
                'contenu'          => '<p>Djibo Services est fier de présenter son nouveau catalogue d\'intrants organiques pour la saison 2026. Ce catalogue inclut notre activateur biologique BioActivateur Sol-Plus, désormais disponible en format économique de 5 litres, ainsi que de nouvelles références d\'engrais organiques adaptés aux cultures sahéliennes.</p><p>Ces produits ont été testés et validés sur plus de 200 parcelles dans la région de Mopti, avec des résultats exceptionnels sur les rendements maraîchers et céréaliers.</p>',
                'image'            => 'assets/images/box-image/blog-01-330x330.jpg',
                'date_publication' => '2026-06-10',
                'publie'           => true,
                'ordre'            => 1,
            ],
            [
                'titre'            => 'Campagne de formation gratuite pour les jeunes maraîchers',
                'extrait'          => 'Djibo Services organise un atelier pratique de 3 jours sur l\'utilisation rationnelle de l\'eau en agriculture.',
                'contenu'          => '<p>Dans le cadre de son programme d\'appui aux jeunes agriculteurs, Djibo Services lance une série d\'ateliers de formation gratuits sur la gestion de l\'eau en agriculture irriguée.</p><p>Ces formations se dérouleront dans 5 communes de la région de Mopti et couvriront les techniques d\'irrigation goutte-à-goutte, la fabrication de compost et l\'utilisation des biopesticides.</p><p>Inscriptions ouvertes jusqu\'au 30 Juin 2026. Contactez-nous par WhatsApp pour vous inscrire.</p>',
                'image'            => 'assets/images/box-image/blog-02-330x330.jpg',
                'date_publication' => '2026-06-05',
                'publie'           => true,
                'ordre'            => 2,
            ],
            [
                'titre'            => 'Comment fabriquer un compost de qualité en 10 jours ?',
                'extrait'          => 'Guide pratique expliquant les secrets de la fermentation accélérée avec le BioActivateur Sol-Plus.',
                'contenu'          => '<p>Le compostage traditionnel prend entre 45 et 90 jours. Avec le BioActivateur Sol-Plus de Djibo Services, vous pouvez obtenir un compost riche et mature en seulement 10 jours !</p><h3>Les étapes clés :</h3><ol><li>Préparer votre tas de matières organiques (résidus de récolte, déchets verts, fumier)</li><li>Arroser avec la solution BioActivateur (1L dilué dans 100L d\'eau) toutes les 2 jours</li><li>Retourner le tas tous les 3 jours pour aérer</li><li>Après 10 jours, votre compost est prêt à l\'emploi !</li></ol><p>Ce compost accéléré présente une teneur en azote et en micro-organismes bénéfiques supérieure au compost traditionnel.</p>',
                'image'            => 'assets/images/box-image/blog-03-330x330.jpg',
                'date_publication' => '2026-05-28',
                'publie'           => true,
                'ordre'            => 3,
            ],
        ];

        foreach ($publications as $pub) {
            Actualite::updateOrCreate(['slug' => \Illuminate\Support\Str::slug($pub['titre'])], $pub);
        }

        $this->command->info('✅ 3 publications d\'exemple créées.');

        // Créer les produits d'exemple
        $produits = [
            [
                'nom' => 'BioActivateur Sol-Plus',
                'categorie' => 'Activateurs',
                'en_vedette' => true,
                'description_courte' => 'Accélérateur biologique de compostage et régénérateur de sols fatigués.',
                'description' => 'Le BioActivateur Sol-Plus est une formule unique à base de micro-organismes bénéfiques qui accélère la décomposition des matières organiques et restructure les sols en libérant les nutriments bloqués. Idéal pour revitaliser les sols sahéliens et booster le rendement des cultures de manière 100% écologique.',
                'avantages' => [
                    'Régénère la structure humique du sol',
                    'Accélère le compostage (divise le temps par 3)',
                    'Améliore la rétention d’eau dans le sol',
                    'Stimule le développement racinaire'
                ],
                'mode_emploi' => 'Diluer 1 litre dans 100 litres d\'eau. Arroser le sol ou le tas de compost. Répéter toutes les 2 semaines.',
                'image' => 'assets/images/box-image/blog-01-330x330.jpg',
                'prix' => '15 000 FCFA / Litre',
                'actif' => true,
                'ordre' => 1
            ],
            [
                'nom' => 'Engrais Organique Djibo-Croissance',
                'categorie' => 'Fertilisants',
                'en_vedette' => false,
                'description_courte' => 'Engrais organique complet enrichi en azote naturel et oligo-éléments.',
                'description' => 'Spécialement formulé pour le maraîchage et les cultures céréalières, cet engrais organique assure une croissance vigoureuse sans risque de brûlure des racines ou de pollution des nappes phréatiques.',
                'avantages' => [
                    'Libération progressive des nutriments',
                    'Enrichi en oligo-éléments essentiels',
                    '100% respectueux de l\'environnement'
                ],
                'mode_emploi' => 'Appliquer 50g par plant au moment du repiquage ou du semis, puis incorporer légèrement au sol.',
                'image' => 'assets/images/box-image/blog-02-330x330.jpg',
                'prix' => '8 500 FCFA / Sac de 25kg',
                'actif' => true,
                'ordre' => 2
            ],
            [
                'nom' => 'Bioprotect Neem-Forte',
                'categorie' => 'Biopesticides',
                'en_vedette' => false,
                'description_courte' => 'Insecticide et répulsif naturel à base d\'extraits de neem concentrés.',
                'description' => 'Protégez vos cultures contre les ravageurs les plus courants (pucerons, chenilles, criquets) grâce à notre formulation naturelle biodégradable qui respecte les insectes pollinisateurs.',
                'avantages' => [
                    'Action systémique et de contact',
                    'Sans résidus chimiques nocifs',
                    'Élimine plus de 150 types de ravageurs'
                ],
                'mode_emploi' => 'Diluer 100ml dans 15 litres d\'eau (un pulvérisateur) et traiter les feuilles tôt le matin ou en fin de soirée.',
                'image' => 'assets/images/box-image/blog-03-330x330.jpg',
                'prix' => '5 000 FCFA / Flacon de 500ml',
                'actif' => true,
                'ordre' => 3
            ],
            [
                'nom' => 'Semences Maraîchères Sélectionnées',
                'categorie' => 'Semences',
                'en_vedette' => false,
                'description_courte' => 'Variétés de semences à haut rendement et résistantes à la chaleur.',
                'description' => 'Une sélection rigoureuse de semences de tomates, d\'oignons, de piments et de gombo, testées et approuvées pour leur adaptabilité au climat chaud et leur résistance aux maladies courantes.',
                'avantages' => [
                    'Taux de germination supérieur à 92%',
                    'Tolérance élevée au stress hydrique',
                    'Cycle court de production'
                ],
                'mode_emploi' => 'Semer en pépinière sur un substrat bien drainé et enrichi avec notre BioActivateur.',
                'image' => 'assets/images/box-image/blog-04-330x330.jpg',
                'prix' => 'Prix variable selon la variété',
                'actif' => true,
                'ordre' => 4
            ]
        ];

        foreach ($produits as $prod) {
            Produit::updateOrCreate(['slug' => \Illuminate\Support\Str::slug($prod['nom'])], $prod);
        }

        $this->command->info('✅ 4 produits d\'exemple créés.');
    }
}
