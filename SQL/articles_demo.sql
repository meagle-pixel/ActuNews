
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Un trou noir supermassif photographié avec une précision inédite',
  'Les astronomes ont obtenu l''image la plus détaillée à ce jour d''un trou noir supermassif, confirmant plusieurs prédictions de la relativité générale.',
  'Grâce à un réseau de radiotélescopes répartis sur plusieurs continents, une équipe internationale a produit l''image la plus nette jamais obtenue d''un trou noir supermassif situé au centre d''une galaxie voisine.\n\nCette prouesse technique repose sur la technique de l''interférométrie à très longue base, qui permet de combiner les observations de plusieurs télescopes pour obtenir une résolution équivalente à celle d''un télescope de la taille de la Terre.\n\nLes chercheurs espèrent que ces données permettront d''affiner les modèles théoriques sur la façon dont la matière se comporte à proximité de l''horizon des événements, cette frontière au-delà de laquelle rien, pas même la lumière, ne peut s''échapper.',
  'images/trounoir.png',
  DATE_SUB(NOW(), INTERVAL 3 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Trous noirs'));


-- 2) Nébuleuses
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'La nébuleuse du Crabe, vestige d''une explosion stellaire',
  'Née de l''explosion d''une étoile massive observée par des astronomes chinois en l''an 1054, la nébuleuse du Crabe continue de fasciner les scientifiques.',
  'La nébuleuse du Crabe est le résultat d''une supernova, l''explosion cataclysmique d''une étoile en fin de vie, dont la lumière a atteint la Terre en 1054 et a été consignée par des astronomes chinois et arabes de l''époque.\n\nAu cœur de ce nuage de gaz et de poussière en expansion se trouve un pulsar : une étoile à neutrons extrêmement dense qui tourne sur elle-même plusieurs dizaines de fois par seconde, émettant des faisceaux de rayonnement à intervalles réguliers.\n\nCette nébuleuse est aujourd''hui l''un des objets les plus étudiés du ciel, car elle permet d''observer en direct les conséquences de la mort d''une étoile massive et la formation d''un des objets les plus extrêmes de l''Univers.',
  'images/crabe.png',
  DATE_SUB(NOW(), INTERVAL 7 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Nébuleuses'));


-- 3) Satellites
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Comment les satellites artificiels façonnent notre quotidien',
  'GPS, météo, télécommunications : les satellites artificiels sont devenus indispensables, bien au-delà de la seule exploration spatiale.',
  'On compte aujourd''hui plusieurs milliers de satellites actifs en orbite autour de la Terre, utilisés pour la navigation, les prévisions météorologiques, les télécommunications ou encore l''observation de la planète.\n\nCertains évoluent en orbite basse, à quelques centaines de kilomètres d''altitude, pour offrir une connexion internet ou photographier la surface terrestre avec une grande précision. D''autres sont placés en orbite géostationnaire, à plus de 36 000 kilomètres, où ils restent fixes au-dessus d''un même point du globe.\n\nAvec la multiplication des constellations de satellites destinées à l''accès à internet, la question de la gestion du trafic spatial et des débris devient un enjeu majeur pour les prochaines décennies.',
  'images/satellites.png',
  DATE_SUB(NOW(), INTERVAL 10 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Satellites'));


-- 4) Premières missions spatiales
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Spoutnik 1, le satellite qui a lancé la conquête spatiale',
  'Le 4 octobre 1957, l''URSS met en orbite Spoutnik 1, premier objet artificiel envoyé dans l''espace et point de départ de la course à l''espace.',
  'Spoutnik 1 était une simple sphère métallique d''un peu plus de 80 kilogrammes, équipée de quatre antennes et d''un émetteur radio. Sa mise en orbite par l''Union soviétique a pourtant marqué un tournant dans l''histoire des sciences et des relations internationales.\n\nSon signal radio, capté par des radioamateurs du monde entier, a démontré qu''il était possible de placer un objet artificiel en orbite autour de la Terre, ouvrant la voie à ce qu''on appellera la course à l''espace entre les États-Unis et l''URSS.\n\nCet événement a directement conduit à la création de la NASA aux États-Unis l''année suivante, et a posé les bases de plus de soixante ans d''exploration spatiale.',
  'images/spoutnik.jpg',
  DATE_SUB(NOW(), INTERVAL 14 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Premières missions spatiales'));


-- 5) Planètes
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Mars, la planète rouge qui fascine les scientifiques',
  'Avec ses calottes glaciaires, ses anciens lits de rivières et son volcan géant, Mars reste la destination privilégiée pour la recherche de vie passée.',
  'Mars doit sa couleur caractéristique à l''oxyde de fer qui recouvre sa surface. Plus petite que la Terre, elle possède néanmoins le plus grand volcan connu du système solaire, Olympus Mons, ainsi qu''un vaste système de canyons, Valles Marineris.\n\nLes multiples rovers envoyés à sa surface ont mis en évidence des traces d''eau liquide dans son passé, ce qui en fait une cible de choix dans la recherche d''une éventuelle vie microbienne ancienne.\n\nAvec deux petites lunes, Phobos et Deimos, et une atmosphère ténue composée essentiellement de dioxyde de carbone, Mars continue d''alimenter les projets de missions habitées pour les prochaines décennies.',
  'images/mars.jpg',
  DATE_SUB(NOW(), INTERVAL 18 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Planètes'));


-- 6) Exoplanètes
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'À la recherche des exoplanètes potentiellement habitables',
  'Plus de 5 000 exoplanètes ont déjà été détectées hors de notre système solaire, et certaines se trouvent dans la zone où l''eau liquide pourrait exister.',
  'Une exoplanète est une planète qui orbite autour d''une étoile autre que le Soleil. Leur détection, souvent indirecte, repose principalement sur deux méthodes : la mesure de la légère diminution de luminosité d''une étoile lorsqu''une planète passe devant elle, et l''observation des infimes oscillations de l''étoile causées par l''attraction gravitationnelle de la planète.\n\nParmi les milliers d''exoplanètes recensées, certaines se situent dans la "zone habitable" de leur étoile, une distance où la température pourrait permettre à l''eau d''exister à l''état liquide.\n\nLes futurs télescopes spatiaux devraient permettre d''analyser la composition chimique de l''atmosphère de ces mondes lointains, dans l''espoir d''y détecter des signes indirects de vie.',
  'images/espace.jpg',
  DATE_SUB(NOW(), INTERVAL 22 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Exoplanètes'));


-- 7) Étoiles
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Le cycle de vie des étoiles, de leur naissance à leur mort',
  'Des nuages de gaz aux étoiles à neutrons en passant par les géantes rouges, le destin d''une étoile dépend avant tout de sa masse initiale.',
  'Une étoile naît de l''effondrement d''un nuage de gaz et de poussière sous l''effet de la gravité, jusqu''à ce que la température en son cœur soit suffisante pour déclencher des réactions de fusion nucléaire.\n\nPendant l''essentiel de sa vie, une étoile comme le Soleil fusionne de l''hydrogène en hélium, un équilibre qui peut durer plusieurs milliards d''années. Lorsque le combustible s''épuise, l''étoile évolue en géante rouge avant de terminer sa vie en naine blanche.\n\nLes étoiles beaucoup plus massives connaissent une fin bien plus spectaculaire : elles explosent en supernova, un phénomène qui peut donner naissance à une étoile à neutrons ou, dans les cas les plus extrêmes, à un trou noir.',
  'images/etoilee.jpg',
  DATE_SUB(NOW(), INTERVAL 26 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Étoiles'));


-- 8) Galaxies
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Notre galaxie, la Voie lactée, sous un nouveau jour',
  'Composée de plusieurs centaines de milliards d''étoiles, la Voie lactée continue de livrer ses secrets grâce aux relevés cartographiques récents.',
  'La Voie lactée est une galaxie spirale barrée d''environ 100 000 années-lumière de diamètre, qui abrite entre 100 et 400 milliards d''étoiles, dont notre Soleil, situé sur l''un de ses bras spiraux.\n\nAu centre de la galaxie se trouve Sagittarius A*, un trou noir supermassif dont la masse est estimée à plusieurs millions de fois celle du Soleil.\n\nGrâce aux missions de cartographie spatiale récentes, les astronomes ont pu établir une carte en trois dimensions de plus d''un milliard d''étoiles, révélant la structure fine des bras spiraux et l''historique des collisions passées avec d''autres galaxies.',
  'images/galaxy.jpg',
  DATE_SUB(NOW(), INTERVAL 30 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Galaxies'));


-- 9) Télescopes
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Le télescope spatial James Webb repousse les limites de l''observation',
  'Successeur de Hubble, le télescope James Webb observe l''Univers dans l''infrarouge et révèle des galaxies parmi les plus anciennes jamais détectées.',
  'Lancé fin 2021, le télescope spatial James Webb est aujourd''hui le plus puissant jamais envoyé dans l''espace. Contrairement à Hubble, qui observe principalement dans le visible, Webb est optimisé pour l''infrarouge, ce qui lui permet de voir à travers les nuages de poussière et de détecter la lumière de galaxies extrêmement lointaines.\n\nPlacé à 1,5 million de kilomètres de la Terre, au point de Lagrange L2, il est protégé du Soleil par un immense bouclier thermique qui lui permet de fonctionner à une température proche du zéro absolu.\n\nSes observations ont déjà permis de repousser les records de distance et donc d''ancienneté des galaxies observées, offrant un aperçu inédit de l''Univers primordial, quelques centaines de millions d''années seulement après le Big Bang.',
  'images/orion.webp',
  DATE_SUB(NOW(), INTERVAL 34 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Télescopes'));


-- 10) Exploration spatiale
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Apollo 11, le jour où l''humanité a marché sur la Lune',
  'Le 20 juillet 1969, Neil Armstrong et Buzz Aldrin deviennent les premiers humains à fouler le sol lunaire, sous le regard de millions de téléspectateurs.',
  'La mission Apollo 11 a été l''aboutissement d''un programme spatial américain lancé quelques années plus tôt pour répondre au défi posé par le président Kennedy : envoyer un homme sur la Lune avant la fin des années 1960.\n\nAprès un voyage de plusieurs jours, le module lunaire Eagle s''est posé sur la mer de la Tranquillité, avant que Neil Armstrong ne descende l''échelle et prononce sa célèbre phrase sur "un petit pas pour l''homme, un bond de géant pour l''humanité".\n\nCet exploit technique et humain reste, plus de cinquante ans après, l''un des moments les plus marquants de l''histoire de l''exploration spatiale, et continue d''inspirer les projets actuels de retour sur la Lune.',
  'images/apollo.jpg',
  DATE_SUB(NOW(), INTERVAL 38 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Exploration spatiale'));


-- 11) Technologies spatiales
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Les nouvelles technologies au service de la conquête spatiale',
  'Fusées réutilisables, propulsion électrique, impression 3D : les innovations technologiques transforment en profondeur le coût et la fréquence des lancements.',
  'Pendant longtemps, chaque lancement spatial nécessitait la construction d''une fusée entièrement neuve, à usage unique. Le développement d''étages de fusée capables de revenir se poser et d''être réutilisés a considérablement réduit le coût d''accès à l''espace.\n\nD''autres innovations, comme la propulsion électrique ou l''impression 3D de pièces de moteur, permettent de concevoir des engins spatiaux plus légers, plus efficaces et plus rapides à fabriquer.\n\nCes avancées technologiques ouvrent la voie à une multiplication des missions, qu''il s''agisse de satellites, de sondes scientifiques ou, à terme, de vols habités vers la Lune et au-delà.',
  'images/lancementfusee.png',
  DATE_SUB(NOW(), INTERVAL 42 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Technologies spatiales'));


-- 12) Vie extraterrestre
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'La recherche de vie extraterrestre : où en est-on ?',
  'Des lunes glacées de Jupiter aux exoplanètes lointaines, plusieurs pistes sérieuses guident aujourd''hui la recherche d''une vie ailleurs que sur Terre.',
  'La question de savoir si la vie existe ailleurs que sur Terre reste l''une des plus grandes interrogations de la science. Plusieurs lunes du système solaire, comme Europe autour de Jupiter ou Encelade autour de Saturne, sont particulièrement étudiées car elles abritent un océan d''eau liquide sous leur surface glacée.\n\nDes missions spatiales sont en préparation pour aller analyser directement la composition de ces océans souterrains, à la recherche de traces chimiques compatibles avec une activité biologique.\n\nParallèlement, l''étude de l''atmosphère des exoplanètes pourrait un jour révéler des déséquilibres chimiques difficilement explicables sans la présence d''une forme de vie, sans toutefois constituer une preuve définitive.',
  'images/europe.jpg',
  DATE_SUB(NOW(), INTERVAL 46 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Vie extraterrestre'));


-- 13) Cosmologie
INSERT INTO articles (article_title, article_resume, article_content, article_image_path, article_published_date, article_status, article_user_id)
VALUES (
  'Le Big Bang et les origines de l''Univers',
  'Il y a environ 13,8 milliards d''années, l''Univers observable est né d''une expansion extrêmement rapide à partir d''un état incroyablement dense et chaud.',
  'La théorie du Big Bang décrit l''évolution de l''Univers depuis un état initial extrêmement dense et chaud, il y a environ 13,8 milliards d''années, suivi d''une expansion qui se poursuit encore aujourd''hui.\n\nL''une des preuves majeures de cette théorie est le fond diffus cosmologique, un rayonnement fossile détectable dans toutes les directions du ciel, qui constitue en quelque sorte l''écho lumineux des premiers instants de l''Univers.\n\nDepuis, l''Univers s''est structuré progressivement : formation des premiers atomes, puis des étoiles, des galaxies, et enfin des amas de galaxies que l''on observe aujourd''hui, dans un Univers en expansion accélérée dont les causes profondes restent encore débattues.',
  'images/abstraitx.jpg',
  DATE_SUB(NOW(), INTERVAL 50 DAY),
  'published',
  (SELECT user_id FROM users WHERE user_email = 'm.eagle@hotmail.fr')
);
INSERT INTO article_categories (article_id, category_id)
VALUES (LAST_INSERT_ID(), (SELECT category_id FROM categories WHERE category_name = 'Cosmologie'));
