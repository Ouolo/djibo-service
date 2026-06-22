<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Realisation;

class RealisationSeeder extends Seeder
{
    public function run(): void
    {
        // Ne pas dupliquer si déjà peuplé
        if (Realisation::count() > 0) {
            $this->command->info('Table realisations déjà peuplée — seeder ignoré.');
            return;
        }

        $data = [
            [
                'titre'        => 'Projet de Restauration des Sols à Segouboughou',
                'localisation' => 'Ségou (Mali)',
                'impact'       => '15 hectares restaurés',
                'description'  => 'Restauration de parcelles agricoles dégradées par l\'utilisation intensive de produits chimiques. Grâce à notre BioActivateur Sol-Plus, les producteurs ont retrouvé un rendement historique de 80% supérieur dès la première récolte d\'oignons.',
                'image'        => 'assets/images/realisation/IMG-20260615-WA0129.jpg',
                'date_projet'  => '2026-03-01',
                'actif'        => true,
                'ordre'        => 1,
            ],
            [
                'titre'        => 'Aménagement de la Ferme École Djibo-Bio',
                'localisation' => 'Zone périurbaine de Ségou',
                'impact'       => 'Plus de 500 producteurs formés par an',
                'description'  => 'Création d\'un centre de démonstration agroécologique moderne combinant maraîchage, arboriculture et élevage intégré, fonctionnant entièrement à l\'énergie solaire et avec recyclage des déchets.',
                'image'        => 'assets/images/realisation/formation.jpg',
                'date_projet'  => '2025-11-01',
                'actif'        => true,
                'ordre'        => 2,
            ],
            [
                'titre'        => 'Programme d\'Appui aux Coopératives Féminines',
                'localisation' => 'Cercle de Ségou',
                'impact'       => '120 femmes accompagnées et autonomisées',
                'description'  => 'Dotation en intrants organiques et formation complète sur la production de tomates hors-saison. Le projet a permis d\'augmenter les revenus mensuels des familles bénéficiaires de près de 150%.',
                'image'        => 'assets/images/realisation/amenagement deni hectar en tomate.jpg',
                'date_projet'  => '2025-09-01',
                'actif'        => true,
                'ordre'        => 3,
            ],
            [
                'titre'        => 'Aménagement de Parcelles de Papayes',
                'localisation' => 'Ségou (Mali)',
                'impact'       => '1 hectare de papayes planté',
                'description'  => 'Accompagnement technique de producteurs pour la mise en place d\'une plantation moderne de papayers de haute productivité avec système d\'irrigation localisé.',
                'image'        => "assets/images/realisation/amenagement d'unhectar en papaye.jpg",
                'date_projet'  => '2025-07-01',
                'actif'        => true,
                'ordre'        => 4,
            ],
            [
                'titre'        => 'Encadrement Pratique des Jeunes Stagiaires',
                'localisation' => 'Centre Djibo-Bio',
                'impact'       => '30+ stagiaires formés et qualifiés',
                'description'  => 'Encadrement professionnel d\'étudiants en agronomie et jeunes ruraux sur la production d\'intrants organiques et la conduite d\'exploitations agroécologiques.',
                'image'        => 'assets/images/realisation/stagaire.jpg',
                'date_projet'  => '2025-06-01',
                'actif'        => true,
                'ordre'        => 5,
            ],
            [
                'titre'        => 'Réalisation de Diagnostics de Parcelles',
                'localisation' => 'Région de Ségou',
                'impact'       => '100+ diagnostics de sols effectués',
                'description'  => 'Fourniture de fiches techniques personnalisées et de conseils pratiques pour optimiser la fertilisation naturelle et la protection des cultures.',
                'image'        => 'assets/images/realisation/ficheTechnique.jpg',
                'date_projet'  => '2025-05-01',
                'actif'        => true,
                'ordre'        => 6,
            ],
        ];

        foreach ($data as $item) {
            $item['slug'] = Str::slug($item['titre']);
            Realisation::create($item);
        }

        $this->command->info('✅ ' . count($data) . ' réalisations insérées avec succès.');
    }
}
