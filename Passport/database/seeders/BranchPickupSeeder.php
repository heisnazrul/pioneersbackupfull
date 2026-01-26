<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\SchoolBranch;
use App\Models\City;
use App\Models\BranchPickup;
use Illuminate\Support\Str;

class BranchPickupSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [
            // Anglotec Academy – Scarborough
            ['school' => 'Anglotec Academy', 'branch' => 'Scarborough', 'pickup_city' => 'Leeds Bradford airport taxi transfer', 'fee' => 150],
            ['school' => 'Anglotec Academy', 'branch' => 'Scarborough', 'pickup_city' => 'Manchester airport',                   'fee' => 230],
            ['school' => 'Anglotec Academy', 'branch' => 'Scarborough', 'pickup_city' => 'Liverpool',                            'fee' => 240],
            ['school' => 'Anglotec Academy', 'branch' => 'Scarborough', 'pickup_city' => 'Heathrow',                             'fee' => 400],
            ['school' => 'Anglotec Academy', 'branch' => 'Scarborough', 'pickup_city' => 'Gatwick',                              'fee' => 450],

            // Atlantic Centre of Education – Galway
            ['school' => 'Atlantic Centre of Education', 'branch' => 'Galway', 'pickup_city' => 'Dublin',       'fee' => 395],
            ['school' => 'Atlantic Centre of Education', 'branch' => 'Galway', 'pickup_city' => 'Shannon',      'fee' => 190],
            ['school' => 'Atlantic Centre of Education', 'branch' => 'Galway', 'pickup_city' => 'Ireland West', 'fee' => 190],

            // Bath Academy of English – Bath
            ['school' => 'Bath Academy of English', 'branch' => 'Bath', 'pickup_city' => 'London Heathrow', 'fee' => 290],

            // Bayswater – London
            ['school' => 'Bayswater', 'branch' => 'London', 'pickup_city' => 'Heathrow',      'fee' => 175],
            ['school' => 'Bayswater', 'branch' => 'London', 'pickup_city' => 'Gatwick',       'fee' => 230],
            ['school' => 'Bayswater', 'branch' => 'London', 'pickup_city' => 'Luton',         'fee' => 210],
            ['school' => 'Bayswater', 'branch' => 'London', 'pickup_city' => 'Stansted',      'fee' => 220],
            ['school' => 'Bayswater', 'branch' => 'London', 'pickup_city' => 'City Airport',  'fee' => 130],
            ['school' => 'Bayswater', 'branch' => 'London', 'pickup_city' => 'St Pancras',    'fee' => 100],

            // Bayswater – Liverpool
            ['school' => 'Bayswater', 'branch' => 'Liverpool', 'pickup_city' => 'Liverpool Airport',  'fee' => 75],
            ['school' => 'Bayswater', 'branch' => 'Liverpool', 'pickup_city' => 'Manchester Airport', 'fee' => 120],

            // Bayswater – Brighton
            ['school' => 'Bayswater', 'branch' => 'Brighton', 'pickup_city' => 'Gatwick',      'fee' => 130],
            ['school' => 'Bayswater', 'branch' => 'Brighton', 'pickup_city' => 'Heathrow',     'fee' => 200],
            ['school' => 'Bayswater', 'branch' => 'Brighton', 'pickup_city' => 'City Airport', 'fee' => 245],
            ['school' => 'Bayswater', 'branch' => 'Brighton', 'pickup_city' => 'St Pancras',   'fee' => 245],

            // Bayswater – Bournemouth
            ['school' => 'Bayswater', 'branch' => 'Bournemouth', 'pickup_city' => 'Bournemouth Airport', 'fee' => 65],
            ['school' => 'Bayswater', 'branch' => 'Bournemouth', 'pickup_city' => 'Heathrow',            'fee' => 210],
            ['school' => 'Bayswater', 'branch' => 'Bournemouth', 'pickup_city' => 'Gatwick',             'fee' => 230],
            ['school' => 'Bayswater', 'branch' => 'Bournemouth', 'pickup_city' => 'Luton',               'fee' => 265],

            // Bayswater – Vancouver
            ['school' => 'Bayswater', 'branch' => 'Vancouver', 'pickup_city' => 'Vancouver International', 'fee' => 175],

            // Bayswater – Toronto
            ['school' => 'Bayswater', 'branch' => 'Toronto', 'pickup_city' => 'Toronto Pearson', 'fee' => 165],

            // Bayswater – Calgary
            ['school' => 'Bayswater', 'branch' => 'Calgary', 'pickup_city' => 'Calgary International', 'fee' => 150],

            // Bayswater – Cape Town
            ['school' => 'Bayswater', 'branch' => 'Cape Town', 'pickup_city' => 'Cape Town International', 'fee' => 60],

            // Bayswater – Cyprus (Limassol)
            ['school' => 'Bayswater', 'branch' => 'Cyprus (Limassol)', 'pickup_city' => 'Larnaca', 'fee' => 90],
            ['school' => 'Bayswater', 'branch' => 'Cyprus (Limassol)', 'pickup_city' => 'Paphos',  'fee' => 120],

            // Beet Language Centre – Bournemouth
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Heathrow',        'fee' => 263],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Gatwick',         'fee' => 276],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Bournemouth',     'fee' => 100],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Southampton',     'fee' => 158],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Central London',  'fee' => 314],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Stansted',        'fee' => 326],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Luton',           'fee' => 276],
            ['school' => 'Beet Language Centre', 'branch' => 'Bournemouth', 'pickup_city' => 'Bristol',         'fee' => 327],

            // Berlitz – London
            ['school' => 'Berlitz', 'branch' => 'London', 'pickup_city' => 'Heathrow', 'fee' => 130],
            ['school' => 'Berlitz', 'branch' => 'London', 'pickup_city' => 'Gatwick',  'fee' => 170],
            ['school' => 'Berlitz', 'branch' => 'London', 'pickup_city' => 'Stansted', 'fee' => 170],

            // Berlitz – Manchester
            ['school' => 'Berlitz', 'branch' => 'Manchester', 'pickup_city' => 'Manchester Airport', 'fee' => 85],
            ['school' => 'Berlitz', 'branch' => 'Manchester', 'pickup_city' => 'Liverpool Airport',  'fee' => 115],
            ['school' => 'Berlitz', 'branch' => 'Manchester', 'pickup_city' => 'London Airport',     'fee' => 365],

            // Berlitz – Dublin
            ['school' => 'Berlitz', 'branch' => 'Dublin', 'pickup_city' => 'Dublin Airport', 'fee' => 100],

            // Bright School of English – Bournemouth
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Heathrow',   'fee' => 260],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Gatwick',    'fee' => 280],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Luton',      'fee' => 290],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Stansted',   'fee' => 310],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'Southampton',       'fee' => 70],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'Bournemouth',       'fee' => 40],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'Poole Ferry Terminal', 'fee' => 35],
            ['school' => 'Bright School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'Central London',    'fee' => 280],

            // Bournemouth City College BCC – Bournemouth
            ['school' => 'Bournemouth City College BCC', 'branch' => 'Bournemouth', 'pickup_city' => 'Heathrow',    'fee' => 190],
            ['school' => 'Bournemouth City College BCC', 'branch' => 'Bournemouth', 'pickup_city' => 'Gatwick',     'fee' => 190],
            ['school' => 'Bournemouth City College BCC', 'branch' => 'Bournemouth', 'pickup_city' => 'Luton',       'fee' => 210],
            ['school' => 'Bournemouth City College BCC', 'branch' => 'Bournemouth', 'pickup_city' => 'Stansted',    'fee' => 240],
            ['school' => 'Bournemouth City College BCC', 'branch' => 'Bournemouth', 'pickup_city' => 'Southampton', 'fee' => 90],
            ['school' => 'Bournemouth City College BCC', 'branch' => 'Bournemouth', 'pickup_city' => 'Bournemouth', 'fee' => 50],

            // Brighton Language College International – Brighton
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'pickup_city' => 'Gatwick',     'fee' => 95],
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'pickup_city' => 'Heathrow',    'fee' => 160],
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'pickup_city' => 'Luton',       'fee' => 210],
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'pickup_city' => 'Stansted',    'fee' => 210],
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'pickup_city' => 'London City', 'fee' => 205],
            ['school' => 'Brighton Language College International', 'branch' => 'Brighton', 'pickup_city' => 'St Pancras',  'fee' => 205],

            // Britannia English Academy – Manchester
            ['school' => 'Britannia English Academy', 'branch' => 'Manchester', 'pickup_city' => 'Manchester', 'fee' => 80],

            // Burlington School – London
            ['school' => 'Burlington School', 'branch' => 'London', 'pickup_city' => 'Heathrow',    'fee' => 130],
            ['school' => 'Burlington School', 'branch' => 'London', 'pickup_city' => 'Gatwick',     'fee' => 140],
            ['school' => 'Burlington School', 'branch' => 'London', 'pickup_city' => 'Luton',       'fee' => 170],
            ['school' => 'Burlington School', 'branch' => 'London', 'pickup_city' => 'Stansted',    'fee' => 170],
            ['school' => 'Burlington School', 'branch' => 'London', 'pickup_city' => 'St. Pancras', 'fee' => 120],

            // Concorde International – Canterbury
            ['school' => 'Concorde International', 'branch' => 'Canterbury', 'pickup_city' => 'Gatwick', 'fee' => 179],
            ['school' => 'Concorde International', 'branch' => 'Canterbury', 'pickup_city' => 'Heathrow', 'fee' => 200],
            ['school' => 'Concorde International', 'branch' => 'Canterbury', 'pickup_city' => 'Stansted', 'fee' => 189],
            ['school' => 'Concorde International', 'branch' => 'Canterbury', 'pickup_city' => 'Luton',    'fee' => 205],

            // CES – Dublin
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Dublin', 'pickup_city' => 'Dublin', 'fee' => 85],

            // CES – Cork
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Cork', 'pickup_city' => 'Cork', 'fee' => 60],

            // CES – Toronto
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Toronto', 'pickup_city' => 'Toronto Airport (one way)', 'fee' => 150],

            // CES – Vancouver
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Vancouver', 'pickup_city' => 'Vancouver Airport (one way)', 'fee' => 150],

            // CES – London
            ['school' => 'CES - Centre of English Studies', 'branch' => 'London', 'pickup_city' => 'Heathrow', 'fee' => 145],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'London', 'pickup_city' => 'Stansted', 'fee' => 200],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'London', 'pickup_city' => 'Gatwick',  'fee' => 145],

            // CES – Edinburgh
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Edinburgh', 'pickup_city' => 'Edinburgh Airport', 'fee' => 80],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Edinburgh', 'pickup_city' => 'Glasgow Airport',   'fee' => 280],

            // CES – Oxford
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Oxford', 'pickup_city' => 'Heathrow', 'fee' => 165],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Oxford', 'pickup_city' => 'Gatwick',  'fee' => 205],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Oxford', 'pickup_city' => 'Stansted', 'fee' => 215],

            // CES – Leeds
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Leeds', 'pickup_city' => 'Leeds Bradford', 'fee' => 100],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Leeds', 'pickup_city' => 'Manchester',     'fee' => 150],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Leeds', 'pickup_city' => 'Liverpool',      'fee' => 185],

            // CES – Worthing
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Worthing', 'pickup_city' => 'Heathrow', 'fee' => 170],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Worthing', 'pickup_city' => 'Gatwick',  'fee' => 140],
            ['school' => 'CES - Centre of English Studies', 'branch' => 'Worthing', 'pickup_city' => 'Stansted', 'fee' => 250],

            // ETC International College – Bournemouth
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'Heathrow',      'fee' => 180],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'Gatwick',       'fee' => 200],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'Luton',         'fee' => 220],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'Stansted',      'fee' => 270],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'SOUTHAMPTON',   'fee' => 100],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'Bournemouth',   'fee' => 45],
            ['school' => 'ETC International College', 'branch' => 'Bournemouth', 'pickup_city' => 'London Central','fee' => 260],

            // Eurospeak – Southampton
            ['school' => 'Eurospeak Language School', 'branch' => 'Southampton', 'pickup_city' => 'Heathrow',   'fee' => 200],
            ['school' => 'Eurospeak Language School', 'branch' => 'Southampton', 'pickup_city' => 'Gatwick',    'fee' => 200],
            ['school' => 'Eurospeak Language School', 'branch' => 'Southampton', 'pickup_city' => 'Southampton','fee' => 85],

            // Eurospeak – Reading
            ['school' => 'Eurospeak Language School', 'branch' => 'Reading', 'pickup_city' => 'Heathrow', 'fee' => 95],
            ['school' => 'Eurospeak Language School', 'branch' => 'Reading', 'pickup_city' => 'Gatwick',  'fee' => 145],

            // Imagine English Liverpool Academy – Liverpool
            ['school' => 'Imagine English Liverpool Academy', 'branch' => 'Liverpool', 'pickup_city' => 'Liverpool', 'fee' => 60],
            ['school' => 'Imagine English Liverpool Academy', 'branch' => 'Liverpool', 'pickup_city' => 'Manchester','fee' => 95],

            // inlingua – Cheltenham
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'Heathrow',        'fee' => 205],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'Gatwick',         'fee' => 240],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'Stansted',        'fee' => 240],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'Birmingham',      'fee' => 165],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'Bristol',         'fee' => 165],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'Luton',           'fee' => 205],
            ['school' => 'inlingua', 'branch' => 'Cheltenham', 'pickup_city' => 'London Victoria', 'fee' => 240],

            // International Language Centres – Birmingham
            ['school' => 'International Language Centres', 'branch' => 'Birmingham', 'pickup_city' => 'Birmingham Airport', 'fee' => 75],
            ['school' => 'International Language Centres', 'branch' => 'Birmingham', 'pickup_city' => 'Heathrow Airport',   'fee' => 210],
            ['school' => 'International Language Centres', 'branch' => 'Birmingham', 'pickup_city' => 'Gatwick Airport',    'fee' => 240],
            ['school' => 'International Language Centres', 'branch' => 'Birmingham', 'pickup_city' => 'Stansted Airport',   'fee' => 230],

            // ILC – Bristol
            ['school' => 'International Language Centres', 'branch' => 'Bristol', 'pickup_city' => 'Bristol Airport',  'fee' => 75],
            ['school' => 'International Language Centres', 'branch' => 'Bristol', 'pickup_city' => 'Heathrow Airport', 'fee' => 260],
            ['school' => 'International Language Centres', 'branch' => 'Bristol', 'pickup_city' => 'Gatwick Airport',  'fee' => 280],
            ['school' => 'International Language Centres', 'branch' => 'Bristol', 'pickup_city' => 'Stansted Airport', 'fee' => 270],

            // ILC – Cambridge
            ['school' => 'International Language Centres', 'branch' => 'Cambridge', 'pickup_city' => 'Stansted Airport', 'fee' => 150],
            ['school' => 'International Language Centres', 'branch' => 'Cambridge', 'pickup_city' => 'Heathrow Airport', 'fee' => 210],
            ['school' => 'International Language Centres', 'branch' => 'Cambridge', 'pickup_city' => 'Gatwick Airport',  'fee' => 230],
            ['school' => 'International Language Centres', 'branch' => 'Cambridge', 'pickup_city' => 'Luton Airport',    'fee' => 150],

            // ILC – Colchester
            ['school' => 'International Language Centres', 'branch' => 'Colchester', 'pickup_city' => 'Stansted Airport', 'fee' => 120],
            ['school' => 'International Language Centres', 'branch' => 'Colchester', 'pickup_city' => 'Heathrow Airport', 'fee' => 195],
            ['school' => 'International Language Centres', 'branch' => 'Colchester', 'pickup_city' => 'Gatwick Airport',  'fee' => 225],
            ['school' => 'International Language Centres', 'branch' => 'Colchester', 'pickup_city' => 'Luton Airport',    'fee' => 145],

            // ILC – Portsmouth
            ['school' => 'International Language Centres', 'branch' => 'Portsmouth', 'pickup_city' => 'Heathrow Airport', 'fee' => 195],
            ['school' => 'International Language Centres', 'branch' => 'Portsmouth', 'pickup_city' => 'Gatwick Airport',  'fee' => 225],
            ['school' => 'International Language Centres', 'branch' => 'Portsmouth', 'pickup_city' => 'Stansted Airport', 'fee' => 245],
            ['school' => 'International Language Centres', 'branch' => 'Portsmouth', 'pickup_city' => 'Luton Airport',    'fee' => 230],

            // LSI/IH Portsmouth – Portsmouth
            ['school' => 'LSI/IH Portsmouth', 'branch' => 'Portsmouth', 'pickup_city' => 'Heathrow',   'fee' => 160],
            ['school' => 'LSI/IH Portsmouth', 'branch' => 'Portsmouth', 'pickup_city' => 'Gatwick',    'fee' => 160],
            ['school' => 'LSI/IH Portsmouth', 'branch' => 'Portsmouth', 'pickup_city' => 'Luton',      'fee' => 240],
            ['school' => 'LSI/IH Portsmouth', 'branch' => 'Portsmouth', 'pickup_city' => 'Stansted',   'fee' => 240],
            ['school' => 'LSI/IH Portsmouth', 'branch' => 'Portsmouth', 'pickup_city' => 'Southampton','fee' => 90],

            // Islington Centre for English – London
            ['school' => 'Islington Centre for English', 'branch' => 'London', 'pickup_city' => 'London Heathrow', 'fee' => 180],

            // Kensington Academy of English – London
            ['school' => 'Kensington Academy of English', 'branch' => 'London', 'pickup_city' => 'Heathrow', 'fee' => 180],
            ['school' => 'Kensington Academy of English', 'branch' => 'London', 'pickup_city' => 'Gatwick',  'fee' => 180],
            ['school' => 'Kensington Academy of English', 'branch' => 'London', 'pickup_city' => 'Stansted', 'fee' => 200],
            ['school' => 'Kensington Academy of English', 'branch' => 'London', 'pickup_city' => 'Luton',    'fee' => 200],

            // Leeds Language College Ltd – centre of Leeds
            ['school' => 'Leeds Language College Ltd', 'branch' => 'centre of Leeds', 'pickup_city' => 'Manchester', 'fee' => 200],
            ['school' => 'Leeds Language College Ltd', 'branch' => 'centre of Leeds', 'pickup_city' => 'Leeds',      'fee' => 100],

            // Lewis School of English – Southampton
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'pickup_city' => 'Southampton Airport', 'fee' => 74],
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'pickup_city' => 'Heathrow',            'fee' => 168],
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'pickup_city' => 'Gatwick',             'fee' => 183],
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'pickup_city' => 'Bournemouth',         'fee' => 116],
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'pickup_city' => 'Stansted',            'fee' => 255],
            ['school' => 'Lewis School of English', 'branch' => 'Southampton', 'pickup_city' => 'St Pancras',          'fee' => 276],

            // LILA* College – Liverpool
            ['school' => 'LILA* College', 'branch' => 'Liverpool', 'pickup_city' => 'Manchester Airport', 'fee' => 100],
            ['school' => 'LILA* College', 'branch' => 'Liverpool', 'pickup_city' => 'Liverpool Airport',  'fee' => 60],

            // MC Academy – Liverpool
            ['school' => 'MC Academy', 'branch' => 'Liverpool', 'pickup_city' => 'Liverpool Airport',  'fee' => 75],
            ['school' => 'MC Academy', 'branch' => 'Liverpool', 'pickup_city' => 'Manchester Airport', 'fee' => 135],

            // MC Academy – Manchester
            ['school' => 'MC Academy', 'branch' => 'Manchester', 'pickup_city' => 'Manchester Airport', 'fee' => 85],
            ['school' => 'MC Academy', 'branch' => 'Manchester', 'pickup_city' => 'Liverpool Airport',  'fee' => 135],

            // Nacel English School – London
            ['school' => 'Nacel English School', 'branch' => 'London', 'pickup_city' => 'Heathrow',             'fee' => 115],
            ['school' => 'Nacel English School', 'branch' => 'London', 'pickup_city' => 'Gatwick',              'fee' => 185],
            ['school' => 'Nacel English School', 'branch' => 'London', 'pickup_city' => 'Luton',                'fee' => 125],
            ['school' => 'Nacel English School', 'branch' => 'London', 'pickup_city' => 'Stansted',             'fee' => 135],
            ['school' => 'Nacel English School', 'branch' => 'London', 'pickup_city' => 'Eurostar St. Pancras', 'fee' => 95],

            // New College Group – Liverpool
            ['school' => 'New College Group (NCG)', 'branch' => 'Liverpool', 'pickup_city' => 'Liverpool Airport',  'fee' => 70],
            ['school' => 'New College Group (NCG)', 'branch' => 'Liverpool', 'pickup_city' => 'Manchester Airport', 'fee' => 150],

            // New College Group – Manchester
            ['school' => 'New College Group (NCG)', 'branch' => 'Manchester', 'pickup_city' => 'Manchester Airport', 'fee' => 100],

            // Oxford International English Schools – Brighton
            ['school' => 'Oxford International English Schools', 'branch' => 'Brighton', 'pickup_city' => 'Heathrow',   'fee' => 180],
            ['school' => 'Oxford International English Schools', 'branch' => 'Brighton', 'pickup_city' => 'Gatwick',    'fee' => 126],
            ['school' => 'Oxford International English Schools', 'branch' => 'Brighton', 'pickup_city' => 'Stansted',   'fee' => 220],
            ['school' => 'Oxford International English Schools', 'branch' => 'Brighton', 'pickup_city' => 'Luton',      'fee' => 220],
            ['school' => 'Oxford International English Schools', 'branch' => 'Brighton', 'pickup_city' => 'London city','fee' => 195],

            // Oxford International Study Centre – Oxford
            ['school' => 'Oxford International Study Centre', 'branch' => 'Oxford', 'pickup_city' => 'London Heathrow', 'fee' => 140],

            // Preston Academy of English – Preston
            ['school' => 'Preston Academy of English', 'branch' => 'Preston', 'pickup_city' => 'Manchester', 'fee' => 125],

            // Select English Cambridge – Cambridge
            ['school' => 'Select English Cambridge', 'branch' => 'Cambridge', 'pickup_city' => 'London Heathrow',    'fee' => 220],
            ['school' => 'Select English Cambridge', 'branch' => 'Cambridge', 'pickup_city' => 'London Stansted',    'fee' => 100],
            ['school' => 'Select English Cambridge', 'branch' => 'Cambridge', 'pickup_city' => 'St Pancras Station', 'fee' => 225],
            ['school' => 'Select English Cambridge', 'branch' => 'Cambridge', 'pickup_city' => 'London Gatwick',     'fee' => 225],
            ['school' => 'Select English Cambridge', 'branch' => 'Cambridge', 'pickup_city' => 'London Luton',       'fee' => 145],

            // Southbourne School of English – Bournemouth
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'Bournemouth',     'fee' => 60],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'Southampton',     'fee' => 140],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Heathrow', 'fee' => 270],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Gatwick',  'fee' => 285],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Luton',    'fee' => 285],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Central',  'fee' => 315],
            ['school' => 'Southbourne School of English', 'branch' => 'Bournemouth', 'pickup_city' => 'London Stansted', 'fee' => 330],

            // St Giles International – Brighton
            ['school' => 'St Giles International', 'branch' => 'Brighton', 'pickup_city' => 'Heathrow', 'fee' => 155],
            ['school' => 'St Giles International', 'branch' => 'Brighton', 'pickup_city' => 'Gatwick',  'fee' => 115],
            ['school' => 'St Giles International', 'branch' => 'Brighton', 'pickup_city' => 'Stansted', 'fee' => 175],
            ['school' => 'St Giles International', 'branch' => 'Brighton', 'pickup_city' => 'Luton',    'fee' => 175],

            // St Giles International – Eastbourne
            ['school' => 'St Giles International', 'branch' => 'Eastbourne', 'pickup_city' => 'Heathrow', 'fee' => 165],
            ['school' => 'St Giles International', 'branch' => 'Eastbourne', 'pickup_city' => 'Gatwick',  'fee' => 115],
            ['school' => 'St Giles International', 'branch' => 'Eastbourne', 'pickup_city' => 'Stansted', 'fee' => 185],
            ['school' => 'St Giles International', 'branch' => 'Eastbourne', 'pickup_city' => 'Luton',    'fee' => 185],

            // St Giles International – London Central
            ['school' => 'St Giles International', 'branch' => 'London Central', 'pickup_city' => 'Heathrow', 'fee' => 115],
            ['school' => 'St Giles International', 'branch' => 'London Central', 'pickup_city' => 'Gatwick',  'fee' => 125],
            ['school' => 'St Giles International', 'branch' => 'London Central', 'pickup_city' => 'Stansted', 'fee' => 135],
            ['school' => 'St Giles International', 'branch' => 'London Central', 'pickup_city' => 'Luton',    'fee' => 135],

            // St Giles International – London Highgate
            ['school' => 'St Giles International', 'branch' => 'London Highgate', 'pickup_city' => 'Heathrow', 'fee' => 115],
            ['school' => 'St Giles International', 'branch' => 'London Highgate', 'pickup_city' => 'Gatwick',  'fee' => 125],
            ['school' => 'St Giles International', 'branch' => 'London Highgate', 'pickup_city' => 'Stansted', 'fee' => 135],
            ['school' => 'St Giles International', 'branch' => 'London Highgate', 'pickup_city' => 'Luton',    'fee' => 135],

            // St Giles International – Cambridge
            ['school' => 'St Giles International', 'branch' => 'Cambridge', 'pickup_city' => 'Heathrow', 'fee' => 160],
            ['school' => 'St Giles International', 'branch' => 'Cambridge', 'pickup_city' => 'Gatwick',  'fee' => 180],
            ['school' => 'St Giles International', 'branch' => 'Cambridge', 'pickup_city' => 'Stansted', 'fee' => 95],
            ['school' => 'St Giles International', 'branch' => 'Cambridge', 'pickup_city' => 'Luton',    'fee' => 95],

            // Stafford House – Cambridge
            ['school' => 'Stafford House', 'branch' => 'Cambridge', 'pickup_city' => 'Heathrow', 'fee' => 250],
            ['school' => 'Stafford House', 'branch' => 'Cambridge', 'pickup_city' => 'Gatwick',  'fee' => 265],
            ['school' => 'Stafford House', 'branch' => 'Cambridge', 'pickup_city' => 'Stansted', 'fee' => 155],
            ['school' => 'Stafford House', 'branch' => 'Cambridge', 'pickup_city' => 'Luton',    'fee' => 170],

            // Stafford House – Canterbury
            ['school' => 'Stafford House', 'branch' => 'Canterbury', 'pickup_city' => 'Heathrow', 'fee' => 250],
            ['school' => 'Stafford House', 'branch' => 'Canterbury', 'pickup_city' => 'Gatwick',  'fee' => 200],
            ['school' => 'Stafford House', 'branch' => 'Canterbury', 'pickup_city' => 'Stansted', 'fee' => 250],
            ['school' => 'Stafford House', 'branch' => 'Canterbury', 'pickup_city' => 'Luton',    'fee' => 270],

            // Stafford House – London
            ['school' => 'Stafford House', 'branch' => 'London', 'pickup_city' => 'Heathrow', 'fee' => 170],
            ['school' => 'Stafford House', 'branch' => 'London', 'pickup_city' => 'Gatwick',  'fee' => 190],
            ['school' => 'Stafford House', 'branch' => 'London', 'pickup_city' => 'Stansted', 'fee' => 190],
            ['school' => 'Stafford House', 'branch' => 'London', 'pickup_city' => 'Luton',    'fee' => 190],

            // Wimbledon School of English – London
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'pickup_city' => 'Heathrow',    'fee' => 180],
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'pickup_city' => 'Gatwick',     'fee' => 210],
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'pickup_city' => 'Stansted',    'fee' => 300],
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'pickup_city' => 'Luton',       'fee' => 250],
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'pickup_city' => 'City Airport','fee' => 190],
            ['school' => 'Wimbledon School of English', 'branch' => 'London', 'pickup_city' => 'St Pancras',  'fee' => 175],

            // The London School of English – London
            ['school' => 'The London School of English', 'branch' => 'London', 'pickup_city' => 'London Heathrow', 'fee' => 140],
            ['school' => 'The London School of English', 'branch' => 'London', 'pickup_city' => 'London Gatwick',  'fee' => 195],
            ['school' => 'The London School of English', 'branch' => 'London', 'pickup_city' => 'London Luton',    'fee' => 195],
            ['school' => 'The London School of English', 'branch' => 'London', 'pickup_city' => 'London Stansted', 'fee' => 215],

            // Twin English Centre – London
            ['school' => 'Twin English Centre', 'branch' => 'London', 'pickup_city' => 'London Heathrow',  'fee' => 140],
            ['school' => 'Twin English Centre', 'branch' => 'London', 'pickup_city' => 'Gatwick airport',  'fee' => 160],
            ['school' => 'Twin English Centre', 'branch' => 'London', 'pickup_city' => 'Stansted airport', 'fee' => 140],
            ['school' => 'Twin English Centre', 'branch' => 'London', 'pickup_city' => 'Luton airport',    'fee' => 165],

            // LSI Education – London
            ['school' => 'LSI Education', 'branch' => 'London', 'pickup_city' => 'Heathrow', 'fee' => 155],
            ['school' => 'LSI Education', 'branch' => 'London', 'pickup_city' => 'Gatwick',  'fee' => 165],
            ['school' => 'LSI Education', 'branch' => 'London', 'pickup_city' => 'Luton',    'fee' => 165],
            ['school' => 'LSI Education', 'branch' => 'London', 'pickup_city' => 'Stansted', 'fee' => 165],

            // LSI Education – Brighton
            ['school' => 'LSI Education', 'branch' => 'Brighton', 'pickup_city' => 'Gatwick', 'fee' => 115],
            ['school' => 'LSI Education', 'branch' => 'Brighton', 'pickup_city' => 'Heathrow','fee' => 170],
            ['school' => 'LSI Education', 'branch' => 'Brighton', 'pickup_city' => 'Stansted','fee' => 205],
            ['school' => 'LSI Education', 'branch' => 'Brighton', 'pickup_city' => 'Luton',  'fee' => 205],

            // LSI Education – Cambridge
            ['school' => 'LSI Education', 'branch' => 'Cambridge', 'pickup_city' => 'Stansted', 'fee' => 125],
            ['school' => 'LSI Education', 'branch' => 'Cambridge', 'pickup_city' => 'Heathrow', 'fee' => 185],
            ['school' => 'LSI Education', 'branch' => 'Cambridge', 'pickup_city' => 'Gatwick',  'fee' => 195],
            ['school' => 'LSI Education', 'branch' => 'Cambridge', 'pickup_city' => 'Luton',    'fee' => 175],

            // LSI Education – New York
            ['school' => 'LSI Education', 'branch' => 'New York', 'pickup_city' => 'JFK',    'fee' => 210],
            ['school' => 'LSI Education', 'branch' => 'New York', 'pickup_city' => 'Newark', 'fee' => 210],

            // LSI Education – Boston
            ['school' => 'LSI Education', 'branch' => 'Boston', 'pickup_city' => 'Logan', 'fee' => 160],

            // LSI Education – Berkeley
            ['school' => 'LSI Education', 'branch' => 'Berkeley', 'pickup_city' => 'SFO',    'fee' => 210],
            ['school' => 'LSI Education', 'branch' => 'Berkeley', 'pickup_city' => 'Oakland','fee' => 120],

            // LSI Education – San Diego
            ['school' => 'LSI Education', 'branch' => 'San Diego', 'pickup_city' => 'SAN', 'fee' => 120],

            // LSI Education – Vancouver
            ['school' => 'LSI Education', 'branch' => 'Vancouver', 'pickup_city' => 'Vancouver Airport', 'fee' => 120],

            // LSI Education – Toronto
            ['school' => 'LSI Education', 'branch' => 'Toronto', 'pickup_city' => 'Toronto Airport', 'fee' => 120],

            // LSI Education – Auckland
            ['school' => 'LSI Education', 'branch' => 'Auckland', 'pickup_city' => 'Auckland Airport', 'fee' => 120],

            // LSI Education – Brisbane
            ['school' => 'LSI Education', 'branch' => 'Brisbane', 'pickup_city' => 'Brisbane Airport', 'fee' => 140],

            // LSI Education – Paris
            ['school' => 'LSI Education', 'branch' => 'Paris', 'pickup_city' => 'Paris CDG', 'fee' => 130],
            ['school' => 'LSI Education', 'branch' => 'Paris', 'pickup_city' => 'Paris Orly','fee' => 130],

            // LSI Education – Zurich
            ['school' => 'LSI Education', 'branch' => 'Zurich', 'pickup_city' => 'Zurich Airport', 'fee' => 120],

            // International House – London (extra line at bottom)
            ['school' => 'International House', 'branch' => 'London', 'pickup_city' => 'Heathrow', 'fee' => 191],
            ['school' => 'International House', 'branch' => 'London', 'pickup_city' => 'Gatwick',  'fee' => 234],
            ['school' => 'International House', 'branch' => 'London', 'pickup_city' => 'Luton',    'fee' => 234],
            ['school' => 'International House', 'branch' => 'London', 'pickup_city' => 'Stansted', 'fee' => 234],
        ];

        foreach ($rows as $row) {
            $school = School::where('name', $row['school'])->first();

            if (!$school) {
                // You can log this if you like
                // info('School not found for branch pickup', $row);
                continue;
            }

            $branchSlug = Str::slug($row['school'].'-'.$row['branch']);

            $branch = SchoolBranch::where('slug', $branchSlug)->first();

            if (!$branch) {
                // info('Branch not found for branch pickup', $row);
                continue;
            }

            $city = City::where('name', $row['pickup_city'])->first();

            if (!$city) {
                // info('City not found for branch pickup', $row);
                continue;
            }

            BranchPickup::updateOrCreate(
                [
                    'school_branch_id' => $branch->id,
                    'city_id'          => $city->id,
                ],
                [
                    'fee'  => $row['fee'],
                    'note' => null,
                ]
            );
        }
    }
}
