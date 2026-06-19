# Aquafin - Logistiek & Magazijnier Portaal

Dit project is ontwikkeld in het kader van de opleiding Graduaat Programmeren aan de Erasmushogeschool Brussel (EHB). Het betreft een op maat gemaakte webapplicatie voor het interne beheer van materiaal, voorraden en technische interventies binnen Aquafin.

**Team:** Laure, Mohamed, Kulsoom, Sabrine en Salma

---

## 1. Voorbereiding & Voorstel (Start with Why)
Binnen grote industriële omgevingen zoals Aquafin is het materiaalbeheer vaak versnipperd. Na het verzamelen van informatie en het checken van de haalbaarheid, is dit onderbouwd voorstel tot projectplan uitgewerkt. Het doel is de cognitieve belasting voor de eindgebruikers te verlagen via intuïtieve UI/UX-design principes (Design Thinking), het reduceren van foutmarges bij bestellingen, en het vergemakkelijken van communicatie tussen techniekers en het magazijn. De planning en de uitwerking van de analyse werden nauwkeurig voorbereid.

## 2. Realisatie Softwareproject (Functionaliteiten & Roles)
De applicatie maakt gebruik van Role-Based Access Control (RBAC) en volgt de vereisten van het initiële projectplan. De database en de code zijn iteratief opgebouwd via een GIT repository met strikte version control.

* **Admin:** Het overkoepelende beheer van het systeem. Aanmaken en beheren van gebruikers (Techniekers & Magazijniers) en beheren van de verschillende depots.
* **Magazijnier:** Beheer van de materiaal catalogus. Real-time overzicht van de voorraad per depot (strikt geïsoleerd per locatie). Goedkeuren, klaarzetten en beheren van bestellingen. Registratie van uitgiftes en retours. Helpdesk management via een ingebouwd chatsysteem.
* **Technieker:** Visuele webshop voor het aanvragen van materiaal. Opvolgen van persoonlijke bestellingen en retours. Directe noodoproepen via chat met het magazijn.

## 3. Quality Assurance & Architectuur
Het project is geprogrammeerd volgens vaste standaarden en volgt het MVC (Model-View-Controller) ontwerppatroon. De deliverables zijn gerespecteerd.
* **Backend:** Laravel 11 (PHP).
* **Frontend:** Blade templates gestyled met Tailwind CSS.
* **Database:** MySQL met Eloquent ORM. Volledig uitgewerkte relaties tussen de modellen.
* **PDF Generatie:** Integratie van DomPDF voor het genereren van professionele documenten.
* **Beveiliging:** Gebruik van Laravel's ingebouwde CSRF-tokens, veilige wachtwoord-hashing (Bcrypt) en SQL-injection preventie via Eloquent ORM.

## 4. Documentatie & Installatie
Onderstaande kwaliteitsvolle documentatie beschrijft de vereiste stappen voor het opzetten van de ontwikkelomgeving. Functies en methodes zijn in de code gedocumenteerd volgens de gangbare standaarden.

```bash
# 1. Clone de repository
git clone [https://github.com/JouwGebruikersnaam/aquafin-programming-project.git](https://github.com/JouwGebruikersnaam/aquafin-programming-project.git)

# 2. Ga naar de projectmap
cd aquafin-programming-project

# 3. Installeer dependencies (PHP & Node)
composer install
npm install && npm run build

# 4. Installeer de vereiste PDF module
composer require barryvdh/laravel-dompdf

# 5. Omgevingsvariabelen instellen
cp .env.example .env
php artisan key:generate

# 6. Database configureren (vul DB gegevens in) en migraties draaien
php artisan migrate --seed

# 7. Storage linken (Essentieel voor geüploade media)
php artisan storage:link

# 8. Start de lokale server
php artisan serve
```

## 5. Deontologie, Veiligheid en Privacy
Bij de ontwikkeling is de regelgeving rondom privacy en deontologie strikt gerespecteerd:
* **GDPR & Privacy:** Er worden enkel de absoluut noodzakelijke persoonsgegevens opgeslagen in de database.
* **Datasegregatie:** Via het depot_id zien magazijniers enkel de voorraad van hun eigen locatie.
* **Richtlijnen:** De architectuur respecteert de ethische en veiligheidsrichtlijnen die gelden voor professionele bedrijfssoftware.

## 6. Testing & Usability
De software is voortdurend aangepast aan testresultaten en ontworpen voor optimale usability.
* **Testscenario's:** Unit- en feature testen zijn geconfigureerd (zie `tests/Feature/` en `tests/Unit/`) om de doeltreffendheid van de HTTP responses en de logica van de applicatie te valideren.
* Om de tests uit te voeren: `php artisan test`.

## 7. Teamwerk, Probleemoplossend Werken & Professional Skills
Constructieve samenwerking, co-creatie en een professionele attitude stonden centraal in dit project, ook bij onvoorziene uitdagingen:
* **Werkverdeling & Trello:** Taken zijn initieel logisch verdeeld. Gedurende het project is de werkverdeling echter dynamisch bijgestuurd. Vanwege technische uitdagingen met versiebeheer (Git) en uiteenlopende leercurves binnen het team, hebben bepaalde teamleden een aanzienlijk grotere rol opgenomen in de integratie, probleemoplossing en finalisatie van de codebase om de eindkwaliteit te waarborgen.
* **Communicatie & Deadlines:** Afspraken en deadlines zijn opgevolgd via Trello. Communicatie rondom technische blokkades verliep transparant, waarna de werkdruk is herverdeeld om het einddoel te halen.
* **Vaktermen:** Het team hanteerde consequent de correcte Engelse vaktermen in zowel de codebase als de communicatie.

## 8. Levenslang Leren & Digitale Innovatie
Tijdens het volledige proces is een kritische mindset gehanteerd:
* **Zelfsturend leren:** Externe bronnen (officiële Laravel documentatie, Tailwind UI documentatie) zijn actief geïntegreerd in het leerproces. Feedback is iteratief en constructief verwerkt in de applicatie.
* **Digitale Innovatie:** Generatieve AI (Copilot, ChatGPT) is op een kritische, ondersteunende manier ingezet voor het optimaliseren van ontwerppatronen en het verhogen van de productiviteit, zonder de fundamenten van de programmeerlogica uit het oog te verliezen.
