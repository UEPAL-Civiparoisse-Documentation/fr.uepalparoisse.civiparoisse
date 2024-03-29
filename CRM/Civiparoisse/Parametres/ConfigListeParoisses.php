<?php

class CRM_Civiparoisse_Parametres_ConfigListeParoisses
{

    public static function createOrGetListeParoisse()
    {

// récupération du numéro d'ID de la liste des paroisses
        $getOptionGroupIdParoisses = \Civi\Api4\OptionGroup::get()
            ->setCheckPermissions(false)
            ->addSelect('id')
            ->addWhere('name', '=', 'liste_paroisses')
            ->execute()
            ->first();

        if (!(is_array($getOptionGroupIdParoisses)
            && array_key_exists('id', $getOptionGroupIdParoisses)
            && is_numeric($getOptionGroupIdParoisses['id'])
        )) {
            throw new UnexpectedValueException("Error on the selected ID");
        }

// récupération de la liste totale des paroisses
        $listeParoissesACreer = self::listeDesParoisses();

// récupération de la liste des paroisses déjà existantes
        $getListeParoissesExistantes = \Civi\Api4\OptionValue::get()
            ->setCheckPermissions(false)
            ->addSelect('label')
            ->addWhere('option_group_id', '=', $getOptionGroupIdParoisses['id'])
            ->execute()
            ->getArrayCopy();

        $listeParoissesExistantes = array_column($getListeParoissesExistantes, 'label');

// création des paroisses manquantes
        foreach ($listeParoissesACreer as $key => $value) {

            if (!in_array($value, $listeParoissesExistantes, true)) {
                \Civi\Api4\OptionValue::create()
                    ->setCheckPermissions(false)
                    ->addValue('option_group_id', $getOptionGroupIdParoisses['id'])
                    ->addValue('label', $value)
                    ->addValue('name', CRM_Utils_String::munge($value, '_', 64))
                    ->execute();

            }
        }

// modification de l'ordre de chaque paroisse (weight)
        sort($listeParoissesACreer);

        foreach ($listeParoissesACreer as $key => $value) {
            \Civi\Api4\OptionValue::update()
                ->setCheckPermissions(false)
                ->addValue('weight', $key + 1)
                ->addWhere('option_group_id:name', '=', 'liste_paroisses')
                ->addWhere('label', '=', $value)
                ->execute();
        }

// pour l'entrée Autres, modification de la Value pour la fixer à 999
        \Civi\Api4\OptionValue::update()
            ->setCheckPermissions(false)
            ->addValue('value', 999)
            ->addWhere('option_group_id:name', '=', 'liste_paroisses')
            ->addWhere('label', '=', 'Autres')
            ->execute();

    }


// Liste des paroisses de l'UEPAL. Liste modifiée au 1er décembre 2022.
    public static function listeDesParoisses()
    {
        // Pas besoin de trier la liste par ordre alphabétique. Le programme le fait tout seul.
        $listeParoisses = array(
            /* Paroisses créés dans la v1.0 */
            'Bischwiller',
            'Illkirch',
            'Keskastel',
			'Riquewihr',
            'Strasbourg - Le Bouclier',
            'Strasbourg - Saint Guillaume',
			'Autres',
            /* Paroisses créés dans la v1.41 */
            'Abreschviller',
            'Adamswiller',
            'Algolsheim',
            'Algrange',
            'Allenwiller',
            'Alteckendorf',
            'Altkirch',
            'Altwiller',
            'Amnéville',
            'Andolsheim',
            'Appenwihr',
            'Ars-sur-Moselle',
            'Asswiller',
            'Aubure',
            'Audun-le-Tiche',
            'Auenheim',
            'Avricourt',
            'Baerenthal',
            'Balbronn',
            'Baldenheim',
            'Barr',
            'Beblenheim',
            'Behren-lès-Forbach',
            'Bellefosse',
            'Belmont',
            'Benfeld',
            'Berg',
            'Berling',
            'Berstett',
            'Betschdorf',
            'Bettwiller',
            'Bietlenheim',
            'Birlenbach',
            'Bischheim',
            'Bischholtz',
            'Bischwihr',
            'Bissert',
            'Bistroff-sur-Sarre',
            'Bitche',
            'Blaesheim',
            'Boofzheim',
            'Bosselshausen',
            'Boulay',
            'Bourgheim',
            'Bouxwiller',
            'Bouzonville',
            'Breitenbach',
            'Breuschwickersheim',
            'Bruch',
            'Brumath',
            'Buhl',
            'Burbach',
            'Bust',
            'Buswiller',
            'Butten',
            'Cernay',
            'Cleebourg',
            'Climbach',
            'Climont',
            'Clouange',
            'Colmar',
            'Cosswiller',
            'Courcelles-Chaussy',
            'Créhange',
            'Creutzwald',
            'Croettwiller',
            'Dalhunden',
            'Daubensand',
            'Dehlingen',
            'Dettwiller',
            'Diedendorf',
            'Diemeringen',
            'Dieuze',
            'Domfessel',
            'Dorlisheim',
            'Dossenheim-sur-Zinsel',
            'Drachenbronn',
            'Drulingen',
            'Drussenheim',
            'Duntzenheim',
            'Durrenentzen',
            'Durstel',
            'Echery',
            'Eckbolsheim',
            'Eckwersheim',
            'Engwiller',
            'Ensisheim',
            'Entzheim',
            'Erckartswiller',
            'Ernolsheim-lès-Saverne',
            'Erstein',
            'Eschbourg',
            'Eywiller',
            'Falck',
            'Farébersviller',
            'Faulquemont',
            'Fegersheim',
            'Fellering',
            'Fénétrange',
            'Fertrupt',
            'Folschviller',
            'Forbach',
            'Forstfeld',
            'Fortschwihr',
            'Fouday',
            'Freyming-Merlebach',
            'Froeschwiller',
            'Furchhausen',
            'Furdenheim',
            'Geispolsheim-Gare',
            'Geiswiller',
            'Gerstheim',
            'Gertwiller',
            'Geudertheim',
            'Gimbrett',
            'Goersdorf',
            'Gottesheim',
            'Goxwiller',
            'Graffenstaden',
            'Graufthal',
            'Gries',
            'Griesbach',
            'Griesbach-au-Val',
            'Griesbach-le-Bastberg',
            'Guebwiller',
            'Gumbrechtshoffen',
            'Gundershoffen',
            'Gungwiller',
            'Gunsbach',
            'Hagondange',
            'Haguenau',
            'Handschuheim',
            'Hangenbieten',
            'Hangviller',
            'Harskirchen',
            'Hatten',
            'Hattmatt',
            'Hayange',
            'Heiligenstein',
            'Herbitzheim',
            'Hermeswiller',
            'Herrlisheim',
            'Hinsbourg',
            'Hinsingen',
            'Hirschland',
            'Hochfelden',
            'Hoelschloch',
            'Hoenheim',
            'Hoerdt',
            'Hoffen',
            'Hohfrankenheim',
            'Hohwiller',
            'Hombourg-Haut',
            'Horbourg-Wihr',
            'Hunawihr',
            'Huningue',
            'Hunspach',
            'Hurtigheim',
            'Illhaeusern',
            'Illzach-Jeune-Bois',
            'Imbsheim',
            'Ingenheim',
            'Ingolsheim',
            'Ingwiller',
            'Issenhausen',
            'Ittenheim',
            'Jebsheim',
            'Kauffenheim',
            'Kaysersberg',
            'Keffenach',
            'Kingersheim',
            'Kirrwiller',
            'Klingenthal',
            'Kochersberg',
            'Kolbsheim',
            'Krautwiller',
            'Kuhlendorf',
            'Kunheim',
            'Kurtzenhouse',
            'Kutzenhausen',
            'La Petite-Pierre',
            'La Wantzenau',
            'Labroque-Schirmeck',
            'Lafrimbolle',
            'Lampertheim',
            'Lampertsloch',
            'Langensoultzbach',
            'Lauterbourg-Seltz',
            'Le Hohwald',
            'Leiterswiller',
            'Lembach',
            'L\'Hôpital - Cité Jeanne d\'Arc',
            'L\'Hôpital',
            'Lichtenberg',
            'Lingolsheim',
            'Lipsheim',
            'Lixheim',
            'Lobsann',
            'Lohr',
            'Longeville-lès-Metz',
            'Lorentzen',
            'Lutzelbourg',
            'Mackwiller',
            'Maizieres-lès-Metz',
            'Marckolsheim',
            'Marlenheim',
            'Masevaux',
            'Mattstall',
            'Melsheim',
            'Menchhoffen',
            'Merckwiller',
            'Mertzwiller',
            'Metting',
            'Metz',
            'Metzeral',
            'Metz-Queuleu',
            'Metz-Temple Neuf',
            'Mietesheim',
            'Mitschdorf',
            'Mittelbergheim',
            'Mittelhausbergen',
            'Mittelhausen',
            'Mittelwihr',
            'Mittersheim',
            'Mittlach',
            'Molsheim',
            'Monswiller',
            'Montigny-Sablon',
            'Montreux-Vieux',
            'Morhange',
            'Morsbronn-lès-Bains',
            'Mouterhouse',
            'Moyeuvre-Grande',
            'Muhlbach-sur-Munster',
            'Mulhausen',
            'Mulhouse-Dornach',
            'Mulhouse-Illberg Cotaux Terre Nouvelle',
            'Mulhouse-Saint-Étienne',
            'Mulhouse-Saint-Jean',
            'Mulhouse-Saint-Marc',
            'Mulhouse-Saint-Martin',
            'Mulhouse-Saint-Paul',
            'Mundolsheim',
            'Munster',
            'Muntzenheim',
            'Muttersholtz',
            'Mutzig',
            'Nehwiller',
            'Neuf Brisach',
            'Neuviller-la-Roche',
            'Neuwiller-lès-Saverne',
            'Niederbronn-les-Bains',
            'Niederhausbergen',
            'Niedermodern',
            'Niederroedern',
            'Niedersoultzbach',
            'Niedersteinbach',
            'Niederstinzel',
            'Nilvange Fontoy',
            'Nordheim',
            'Obenheim',
            'Oberbronn',
            'Oberdorf',
            'Oberhausbergen',
            'Oberhoffen-sur-Moder',
            'Obermodern',
            'Obernai',
            'Obersoultzbach',
            'Obersteinbach',
            'Oermingen',
            'Offendorf',
            'Offwiller',
            'Ohnheim',
            'Olwisheim',
            'Ostheim',
            'Ostwald',
            'Ottwiller',
            'Petersbach',
            'Petite Rosselle',
            'Pfaffenbronn',
            'Pfaffenhoffen',
            'Pfalzweyer',
            'Pfulgriesheim',
            'Phalsbourg',
            'Philippsbourg',
            'Pierrevillers',
            'Plobsheim-Eschau',
            'Postroff',
            'Preuschdorf',
            'Printzheim',
            'Puberg',
            'Quatzenheim',
            'Ratzwiller',
            'Rauwiller',
            'Reichshoffen',
            'Reichstett',
            'Reimerswiller',
            'Reipertswiller',
            'Reitwiller',
            'Rexingen',
            'Ribeauvillé',
            'Riedheim',
            'Riedisheim',
            'Rimsdorf',
            'Ringendorf',
            'Rittershoffen',
            'Rixheim',
            'Rohrbach-lès-Bitche',
            'Romanswiller',
            'Rombas',
            'Roppenheim',
            'Rosheim',
            'Rosteig',
            'Rothau',
            'Rothbach',
            'Rott',
            'Rouhling',
            'Saâles',
            'Saint-Avold',
            'Saint-Blaise',
            'Sainte-Marie-aux-Mines',
            'Saint-Louis',
            'Sarralbe',
            'Sarrebourg',
            'Sarreguemines',
            'Sarre-Union',
            'Sarrewerden',
            'Saverne',
            'Schalbach',
            'Schalkendorf',
            'Scharrachbergheim',
            'Schillersdorf',
            'Schiltigheim',
            'Schoenbourg',
            'Schoeneck',
            'Schopperten',
            'Schwabwiller',
            'Schweighouse-sur-Moder',
            'Schwindratzheim',
            'Seebach',
            'Seiwiller',
            'Sélestat',
            'Sessenheim',
            'Solbach',
            'Sondernach',
            'Souffelweyersheim',
            'Soufflenheim',
            'Soultzeren',
            'Soultz-sous-Forêts',
            'Spachbach',
            'Sparsbach',
            'Stattmatten',
            'Steinseltz',
            'Stiring-Wendel',
            'Stosswihr',
            'Strasbourg Saint-Pierre-le-Jeune',
            'Strasbourg-Canardière',
            'Strasbourg-Cité de l\'Ill',
            'Strasbourg-Cronenbourg-Centre',
            'Strasbourg-Cronenbourg-Cité',
            'Strasbourg-Elsau',
            'Strasbourg-Hautepierre',
            'Strasbourg-Hohwart',
            'Strasbourg-Koenigshoffen',
            'Strasbourg-Meinau',
            'Strasbourg-Montagne-Verte',
            'Strasbourg-Neudorf',
            'Strasbourg-Neuhof-Résurrection',
            'Strasbourg-Neuhof-Stockfeld',
            'Strasbourg-Port du Rhin',
            'Strasbourg-Robertsau',
            'Strasbourg-Sainte-Aurélie',
            'Strasbourg-Saint-Matthieu',
            'Strasbourg-Saint-Nicolas',
            'Strasbourg-Saint-Paul',
            'Strasbourg-Saint-Pierre-le-Vieux',
            'Strasbourg-Saint-Thomas',
            'Strasbourg-Temple-Neuf',
            'Struth',
            'Sundhoffen',
            'Sundhouse',
            'Thal-Drulingen',
            'Thann',
            'Thionville',
            'Tieffenbach',
            'Traenheim',
            'Trimbach',
            'Uhrwiller',
            'Uttenhoffen',
            'Uttwiller',
            'Vendenheim',
            'Vibersviller',
            'Villé',
            'Vitry-sur-Orne',
            'Voellerdingen',
            'Volksberg',
            'Waldersbach',
            'Waldhambach',
            'Waltenheim-sur-Zorn',
            'Wangen',
            'Wasselonne',
            'Weiler',
            'Weinbourg',
            'Weislingen',
            'Weitbruch',
            'Weiterswiller',
            'Westhoffen',
            'Weyer',
            'Weyersheim',
            'Wickersheim',
            'Wihr-en-Plaine',
            'Wildersbach',
            'Wilshausen',
            'Wimmenau',
            'Windstein',
            'Wingen',
            'Wingen-sur-Moder',
            'Wintersbourg',
            'Wintzenbach',
            'Wintzenheim',
            'Wissembourg',
            'Wittenheim',
            'Woerth',
            'Wolfgantzen',
            'Wolfisheim',
            'Wolfskirchen',
            'Wolschheim',
            'Yutz',
            'Zehnacker',
            'Zilling',
            'Zinswiller',
            'Zittessheim',
            'Zoebersdorf',
            'Zollingen',
            'Zutzendorf',
            /* Paroisses créés dans la v1.42 */
            'Strasbourg',
            'Mulhouse'
        );

        ksort($listeParoisses);

        return $listeParoisses;

    }

}
