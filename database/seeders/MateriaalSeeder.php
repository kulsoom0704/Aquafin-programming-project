<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriaalSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('materiaal')->insert([
            // Bevestigingsmateriaal
            ['artikelnummer' => 'BEV-001', 'omschrijving' => 'Bouten M6', 'locatie' => 'A-Rij 01', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-002', 'omschrijving' => 'Bouten M8', 'locatie' => 'A-Rij 01', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-003', 'omschrijving' => 'Bouten M10', 'locatie' => 'A-Rij 01', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-004', 'omschrijving' => 'Bouten M12', 'locatie' => 'A-Rij 01', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-005', 'omschrijving' => 'Bouten M16 inox A2/A4 verzinkt', 'locatie' => 'A-Rij 01', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-006', 'omschrijving' => 'Moeren zeskantmoeren', 'locatie' => 'A-Rij 02', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-007', 'omschrijving' => 'Borgmoeren', 'locatie' => 'A-Rij 02', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-008', 'omschrijving' => 'Flensmoeren', 'locatie' => 'A-Rij 02', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-009', 'omschrijving' => 'Sluitringen', 'locatie' => 'A-Rij 02', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-010', 'omschrijving' => 'Veerringen', 'locatie' => 'A-Rij 02', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-011', 'omschrijving' => 'Tandringen', 'locatie' => 'A-Rij 02', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-012', 'omschrijving' => 'Ankerbouten', 'locatie' => 'A-Rij 03', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-013', 'omschrijving' => 'Chemische ankers Hilti HIT', 'locatie' => 'A-Rij 03', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-014', 'omschrijving' => 'Keilbouten', 'locatie' => 'A-Rij 03', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-015', 'omschrijving' => 'Draadstangen M6 t.e.m. M16', 'locatie' => 'A-Rij 03', 'beschikbaar' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-016', 'omschrijving' => 'Inslagmoeren', 'locatie' => 'A-Rij 03', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-017', 'omschrijving' => 'Tapbouten', 'locatie' => 'A-Rij 03', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-018', 'omschrijving' => 'Zeskantkop- en inbusbouten', 'locatie' => 'A-Rij 03', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-019', 'omschrijving' => 'Torx- en kruiskopschroeven', 'locatie' => 'A-Rij 04', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-020', 'omschrijving' => 'Zelftappende vijzen', 'locatie' => 'A-Rij 04', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-021', 'omschrijving' => 'Parkervijzen', 'locatie' => 'A-Rij 04', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-022', 'omschrijving' => 'Spaanplaatschroeven', 'locatie' => 'A-Rij 04', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'BEV-023', 'omschrijving' => 'Slangklemmen div. diameters', 'locatie' => 'A-Rij 04', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],

            // PBM
            ['artikelnummer' => 'PBM-001', 'omschrijving' => 'Veiligheidshelm met kinband', 'locatie' => 'B-Rij 01', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-002', 'omschrijving' => 'Oordoppen / gehoorkappen', 'locatie' => 'B-Rij 01', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-003', 'omschrijving' => 'Veiligheidsbril / gelaatsscherm', 'locatie' => 'B-Rij 01', 'beschikbaar' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-004', 'omschrijving' => 'Stofmaskers FFP2 FFP3', 'locatie' => 'B-Rij 01', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-005', 'omschrijving' => 'Werkhandschoenen snijvast chemisch resistent', 'locatie' => 'B-Rij 01', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-006', 'omschrijving' => 'Veiligheidsschoenen S3 antistatisch', 'locatie' => 'B-Rij 02', 'beschikbaar' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-007', 'omschrijving' => 'Werklaarzen PVC nitril met stalen zool', 'locatie' => 'B-Rij 02', 'beschikbaar' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-008', 'omschrijving' => 'Regenkledij jassen broeken capes', 'locatie' => 'B-Rij 02', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-009', 'omschrijving' => 'Fluovesten EN ISO 20471', 'locatie' => 'B-Rij 02', 'beschikbaar' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-010', 'omschrijving' => 'Overall brandvertragend antistatisch', 'locatie' => 'B-Rij 02', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-011', 'omschrijving' => 'Valharnas en lijn', 'locatie' => 'B-Rij 03', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-012', 'omschrijving' => 'Gasdetectiemeter O2 CH4 H2S CO', 'locatie' => 'B-Rij 03', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-013', 'omschrijving' => 'Handontsmetting / EHBO-kit', 'locatie' => 'B-Rij 03', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'PBM-014', 'omschrijving' => 'Klim- en valbeveiligingsmateriaal', 'locatie' => 'B-Rij 03', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],

            // Gereedschap
            ['artikelnummer' => 'GER-001', 'omschrijving' => 'Dopsleutelsets metrisch en inch', 'locatie' => 'C-Rij 01', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-002', 'omschrijving' => 'Ringsleutels steeksleutels', 'locatie' => 'C-Rij 01', 'beschikbaar' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-003', 'omschrijving' => 'Momentsleutels', 'locatie' => 'C-Rij 01', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-004', 'omschrijving' => 'Inbussleutels los en in set', 'locatie' => 'C-Rij 01', 'beschikbaar' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-005', 'omschrijving' => 'Schroevendraaiers plat kruiskop Torx', 'locatie' => 'C-Rij 01', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-006', 'omschrijving' => 'Tangen combinatie waterpomptang kniptang', 'locatie' => 'C-Rij 02', 'beschikbaar' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-007', 'omschrijving' => 'Krimptang / kabelschoentang', 'locatie' => 'C-Rij 02', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-008', 'omschrijving' => 'Kabelstripper', 'locatie' => 'C-Rij 02', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-009', 'omschrijving' => 'Hamer kunststofhamer moker', 'locatie' => 'C-Rij 02', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-010', 'omschrijving' => 'Breekijzer', 'locatie' => 'C-Rij 02', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-011', 'omschrijving' => 'Slijpmachine haakse slijper', 'locatie' => 'C-Rij 03', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-012', 'omschrijving' => 'Accuboormachine / klopboormachine', 'locatie' => 'C-Rij 03', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-013', 'omschrijving' => 'Schroefmachine', 'locatie' => 'C-Rij 03', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-014', 'omschrijving' => 'Slagmoersleutel pneumatisch of accu', 'locatie' => 'C-Rij 03', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-015', 'omschrijving' => 'Waterpas / laserwaterpas', 'locatie' => 'C-Rij 03', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-016', 'omschrijving' => 'Meetlint rolmeter', 'locatie' => 'C-Rij 03', 'beschikbaar' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-017', 'omschrijving' => 'Spanningstester / multimeter', 'locatie' => 'C-Rij 04', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'GER-018', 'omschrijving' => 'Laskist en lasmateriaal', 'locatie' => 'C-Rij 04', 'beschikbaar' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Technische onderhoudsmaterialen
            ['artikelnummer' => 'TEC-001', 'omschrijving' => 'Smeervet foodgrade EP2 lithium', 'locatie' => 'D-Rij 01', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-002', 'omschrijving' => 'O-ringen div. maten en types', 'locatie' => 'D-Rij 01', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-003', 'omschrijving' => 'Pakkingen papier rubber EPDM', 'locatie' => 'D-Rij 01', 'beschikbaar' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-004', 'omschrijving' => 'PTFE tape / Loctite', 'locatie' => 'D-Rij 01', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-005', 'omschrijving' => 'Slangen PVC PE persslangen', 'locatie' => 'D-Rij 02', 'beschikbaar' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-006', 'omschrijving' => 'PVC-fittingen bochten T-stukken', 'locatie' => 'D-Rij 02', 'beschikbaar' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-007', 'omschrijving' => 'Koppelingen Geka Gardena Camlock', 'locatie' => 'D-Rij 02', 'beschikbaar' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-008', 'omschrijving' => 'V-snaren / kettingen', 'locatie' => 'D-Rij 02', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-009', 'omschrijving' => 'Kabels en wartels M16-M32', 'locatie' => 'D-Rij 03', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-010', 'omschrijving' => 'Aansluitdozen', 'locatie' => 'D-Rij 03', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-011', 'omschrijving' => 'Leidingsystemen druk/afvoer', 'locatie' => 'D-Rij 03', 'beschikbaar' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-012', 'omschrijving' => 'Pneumatische koppelingen', 'locatie' => 'D-Rij 03', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'TEC-013', 'omschrijving' => 'Trillingsdempers', 'locatie' => 'D-Rij 03', 'beschikbaar' => 8, 'created_at' => now(), 'updated_at' => now()],

            // Aquafin tools
            ['artikelnummer' => 'AQF-001', 'omschrijving' => 'Putdekselhaak / mangatopener', 'locatie' => 'E-Rij 01', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-002', 'omschrijving' => 'Rioolcamera / inspectiecamera', 'locatie' => 'E-Rij 01', 'beschikbaar' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-003', 'omschrijving' => 'Gasdetectietoestellen H2S CO O2', 'locatie' => 'E-Rij 01', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-004', 'omschrijving' => 'Ontstoppingsveer / hogedrukreiniger', 'locatie' => 'E-Rij 01', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-005', 'omschrijving' => 'Slangenwagens', 'locatie' => 'E-Rij 02', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-006', 'omschrijving' => 'Dompelpompen', 'locatie' => 'E-Rij 02', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-007', 'omschrijving' => 'Rioolstoppen', 'locatie' => 'E-Rij 02', 'beschikbaar' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-008', 'omschrijving' => 'Vlotterschakelaars', 'locatie' => 'E-Rij 02', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-009', 'omschrijving' => 'Niveaumeting ultrasoon radar', 'locatie' => 'E-Rij 03', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-010', 'omschrijving' => 'Staalnamepotten', 'locatie' => 'E-Rij 03', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'AQF-011', 'omschrijving' => 'Monsternameapparatuur', 'locatie' => 'E-Rij 03', 'beschikbaar' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Diversen
            ['artikelnummer' => 'DIV-001', 'omschrijving' => 'Tie-wraps', 'locatie' => 'F-Rij 01', 'beschikbaar' => 200, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-002', 'omschrijving' => 'Kabelschoenen', 'locatie' => 'F-Rij 01', 'beschikbaar' => 100, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-003', 'omschrijving' => 'Markeringstape', 'locatie' => 'F-Rij 01', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-004', 'omschrijving' => 'Siliconenkit / lijm', 'locatie' => 'F-Rij 01', 'beschikbaar' => 15, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-005', 'omschrijving' => 'Rags reinigingsdoekjes', 'locatie' => 'F-Rij 02', 'beschikbaar' => 50, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-006', 'omschrijving' => 'Spray WD-40 contactspray kettingspray', 'locatie' => 'F-Rij 02', 'beschikbaar' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-007', 'omschrijving' => 'Plakband duct tape isolatietape', 'locatie' => 'F-Rij 02', 'beschikbaar' => 20, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-008', 'omschrijving' => 'Batterijen / accu\'s', 'locatie' => 'F-Rij 02', 'beschikbaar' => 30, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-009', 'omschrijving' => 'Reserveonderdelen motoren PLC-onderdelen relais', 'locatie' => 'F-Rij 03', 'beschikbaar' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['artikelnummer' => 'DIV-010', 'omschrijving' => 'Flessen met perslucht / gas', 'locatie' => 'F-Rij 03', 'beschikbaar' => 4, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}