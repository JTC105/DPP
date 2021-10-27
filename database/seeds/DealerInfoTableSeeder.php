<?php

use Illuminate\Database\Seeder;

use App\Model\DealerInfo;

class DealerInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [

['party_id' => 82, 'party_no' => 10080, 'dealer_name' => 'TOYOTA DAGUPAN', 'reference' => 'T0010015', 'address' => 'Diversion Road, Brgy. San Miguel Calasiao DAGUPAN CITY Pangasinan', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 69, 'party_no' => 10067, 'dealer_name' => 'TOYOTA PASONG TAMO, INC.', 'reference' => 'T0010002', 'address' => '2292 Pasong Tamo Extension Magallanes MAKATI METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 47060, 'party_no' => 57523, 'dealer_name' => 'TOYOTA SHAW INC.', 'reference' => 'T0010011', 'address' => '304 SHAW BOULEVARD PLEASANT HILLS MANDALUYONG METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 47247, 'party_no' => 57710, 'dealer_name' => 'TOYOTA OTIS INC.', 'reference' => 'T0010005', 'address' => '1770 P. M.  GUANZON ST., BRGY., 831 PACO MANILA METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 48716, 'party_no' => 59182, 'dealer_name' => 'TOYOTA ABAD SANTOS, MANILA', 'reference' => 'T0010028', 'address' => '2210 JOSE ABAD SANTOS AVENUE BRGY., 224, ZONE 21 DISTRICT 2 STA. CRUZ MANILA METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 67, 'party_no' => 10065, 'dealer_name' => 'TOYOTA MARIKINA', 'reference' => 'T0010013', 'address' => 'SUMULONG HIGHWAY COR., TOYOTA AVENUE SANTO NINO MARIKINA METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 62, 'party_no' => 10060, 'dealer_name' => 'TOYOTA BICUTAN PARANAQUE, INC.', 'reference' => 'T0010026', 'address' => 'KM. 15, WEST SERVICE ROAD, SUN VALLEY PARANAQUE METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 66, 'party_no' => 10064, 'dealer_name' => 'TOYOTA MANILA BAY CORP.', 'reference' => 'T0010004', 'address' => 'ROXAS BLVD., COR., EDSA EXTN. BOULEVARD 2000 PASAY METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 73, 'party_no' => 10071, 'dealer_name' => 'TOYOTA PASIG', 'reference' => 'T0010012', 'address' => '124 E. Rodriguez Jr. Ave., Bo. Ugong PASIG METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 70, 'party_no' => 10068, 'dealer_name' => 'TOYOTA QUEZON AVENUE, INC.', 'reference' => 'T0010006', 'address' => '728 Quezon Avenue Tatalon QUEZON CITY METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 63, 'party_no' => 10061, 'dealer_name' => 'TOYOTA COMMONWEALTH INC.', 'reference' => 'T0010009', 'address' => 'LOT 5B COMMONWEALTH AVE. MATANDANG BALARA QUEZON CITY METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 61, 'party_no' => 10059, 'dealer_name' => 'TOYOTA NORTH EDSA', 'reference' => 'T0010007', 'address' => '1010 EDSA BAGO BANTAY R. MAGSAYSAY QUEZON CITY METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 863925, 'party_no' => 875105, 'dealer_name' => 'TOYOTA FAIRVIEW, INC.', 'reference' => 'T0010048', 'address' => 'BLOCK 1 LOT 2, 3, 4 & 5 BELFAST CORNER MINDANAO AVENUE GREATER LAGRO 2 NOVALICHES QUEZON CITY METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 64, 'party_no' => 10062, 'dealer_name' => 'TOYOTA CUBAO', 'reference' => 'T0010010', 'address' => '926 Aurora Blvd. San Roque QUEZON CITY METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 47830, 'party_no' => 58293, 'dealer_name' => 'LEXUS MANILA INC', 'reference' => 'T0010098', 'address' => '3402 8TH AVENUE COR. 34TH ST., FORT BONIFACIO GLOBAL CITY TAGUIG METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 48790, 'party_no' => 59256, 'dealer_name' => 'TOYOTA GLOBAL CITY', 'reference' => 'T0010029', 'address' => '11TH AVENUE AND 38TH STREET, UPTOWN FORT, FORT BONIFACIO TAGUIG METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 15, 'party_no' => 10013, 'dealer_name' => 'TOYOTA ALABANG INC', 'reference' => 'T0010001', 'address' => 'ALABANG ZAPOTE ROAD COR.  FILINVEST AVE., ALABANG MUNTINLUPA METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 47257, 'party_no' => 57720, 'dealer_name' => 'TOYOTA BALINTAWAK MAIN, INC.', 'reference' => 'T0010008', 'address' => 'EDSA CORNER V. ANG & GEN. EVANGELISTA ST. CALOOCAN METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 65, 'party_no' => 10063, 'dealer_name' => 'TOYOTA MAKATI INC', 'reference' => 'T0010003', 'address' => 'AYALA COR. METROPOLITAN AVENUE, BEL-AIR MAKATI METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],
['party_id' => 469062, 'party_no' => 479959, 'dealer_name' => 'TOYOTA TAYTAY, RIZAL, INC.', 'reference' => 'T0010043', 'address' => '15A, MANILA EAST ROAD, BRGY. DOLORES TAYTAY RIZAL', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1776349, 'party_no' => 1788239, 'dealer_name' => 'TOYOTA SILANG CAVITE, INC', 'reference' => 'T0010062', 'address' => 'Emilio Aguinaldo Highway, Luksuhin Silang, Cavite City', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 84, 'party_no' => 10082, 'dealer_name' => 'TOYOTA DASMARINAS-CAVITE', 'reference' => 'T0110020', 'address' => 'Gen. Emilio Aguinaldo Highway, Salitran, Dasmariñas DASMARINAS CAVITE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 995413, 'party_no' => 1006682, 'dealer_name' => 'TOYOTA BACOOR, CAVITE INC.', 'reference' => 'T0010051', 'address' => 'MOLINO BLVD., MAMBOG IV BACOOR CAVITE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 199572, 'party_no' => 210089, 'dealer_name' => 'TOYOTA SAN PABLO LAGUNA, INC.', 'reference' => 'T0010031', 'address' => 'MAHARLIKA HIGHWAY  SAN BENITO ALAMINOS LAGUNA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 285035, 'party_no' => 295627, 'dealer_name' => 'TOYOTA CALAMBA, LAGUNA INC.', 'reference' => 'T0010032', 'address' => 'NATIONAL HIGHWAY BRGY., TURBINA CALAMBA CITY CALAMBA LAGUNA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1581192, 'party_no' => 1592915, 'dealer_name' => 'TOYOTA SANTA ROSA LAGUNA INC.', 'reference' => 'T0010058', 'address' => 'Lot 1968-D, Santa Rosa-Tagaytay Road, Brgy. Pulong Sta. Cruz  SANTA ROSA LAGUNA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 76, 'party_no' => 10074, 'dealer_name' => 'TOYOTA BATANGAS', 'reference' => 'T0010014', 'address' => 'SITIO 6 DIVERSION ROAD, BALAGTAS BATANGAS CITY BATANGAS', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 917785, 'party_no' => 929000, 'dealer_name' => 'TOYOTA LIPA, BATANGAS, INC.', 'reference' => 'T0010049', 'address' => 'LOT 1-A-2 MAGNIFICAT COMPLEX, PRES. J.P.LAUREL HIGHWAY, BRGY. BANAY-BANAY LIPA CITY BATANGAS', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1801466, 'party_no' => 1813404, 'dealer_name' => 'TOYOTA CALAPAN CITY, INC.', 'reference' => 'T0010064', 'address' => 'National Highway, Bigacalapan City CALAPAN ORIENTAL MINDORO', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 399289, 'party_no' => 410094, 'dealer_name' => 'TOYOTA CAMARINES SUR, INC.', 'reference' => 'T0010039', 'address' => 'NATIONAL HIGHWAY, CADLAN PILI CAMARINES SUR', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 290143, 'party_no' => 300743, 'dealer_name' => 'TOYOTA MARILAO, BULACAN, INC.', 'reference' => 'T0010033', 'address' => 'LOT 1505 MC ARTHUR HIGHWAY, ABANGAN SUR MARILAO BULACAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 356028, 'party_no' => 366737, 'dealer_name' => 'TOYOTA PLARIDEL, BULACAN', 'reference' => 'T0010037', 'address' => '9001 PUROK 1, PARULAN ST. PLARIDEL BULACAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1964519, 'party_no' => 1976639, 'dealer_name' => 'TOYOTA SAN JOSE DEL MONTE, BULACAN', 'reference' => 'T0010069', 'address' => 'Quirino Hi-way cor. Pleasant Hills Road SAN JOSE DEL MONTE BULACAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 78, 'party_no' => 10076, 'dealer_name' => 'TOYOTA SAN FERNANDO, INC.', 'reference' => 'T0010025', 'address' => 'OLONGAPO-GAPAN ROAD, SAN JOSE SAN FERNANDO PAMPANGA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1456034, 'party_no' => 1467615, 'dealer_name' => 'TOYOTA ANGELES, PAMPANGA, INC.', 'reference' => 'T0010053', 'address' => 'Angeles-Magalang Road, Pulung Maragul ANGELES CITY PAMPANGA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 984763, 'party_no' => 996019, 'dealer_name' => 'TOYOTA BATAAN INC.', 'reference' => 'T0010050', 'address' => 'ROMAN SUPER HIGHWAY, BRGY. TUYO BALANGA BATAAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 2066917, 'party_no' => 2079205, 'dealer_name' => 'TOYOTA SUBIC, INC.', 'reference' => 'T0010072', 'address' => 'Marshalling Yard along Rizal Highway Subic Gateway District Subic Bay Freeport Zone SUBIC ZAMBALES', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 995445, 'party_no' => 1006714, 'dealer_name' => 'TOYOTA TARLAC CITY', 'reference' => 'T0010052', 'address' => 'PLAZA LUISITA CENTER SAN MIGUEL TARLAC', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 2067310, 'party_no' => 2079599, 'dealer_name' => 'TOYOTA NUEVA ECIJA, INC.', 'reference' => 'T0010071', 'address' => 'Km 106 Maharlika Highway Brgy., Gomez Sta. Rosa Nueva Ecija SANTA ROSA NUEVA ECIJA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 77, 'party_no' => 10075, 'dealer_name' => 'TOYOTA CABANATUAN', 'reference' => 'T0010016', 'address' => 'Km. 118 Maharlika Highway, Daang Sarile CABANATUAN CITY NUEVA ECIJA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 185339, 'party_no' => 195810, 'dealer_name' => 'TOYOTA LA UNION', 'reference' => 'T0010030', 'address' => 'MANILA NORTH ROAD, DISSO-OR BAUANG LA UNION', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1592922, 'party_no' => 1604652, 'dealer_name' => 'TOYOTA ILOCOS NORTE', 'reference' => 'T0010059', 'address' => 'MANILA NORTH ROAD SAN MARCOS (PAYAS) SAN NICOLAS ILOCOS NORTE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1856374, 'party_no' => 1868376, 'dealer_name' => 'TOYOTA TUGUEGARAO CITY', 'reference' => 'T0010067', 'address' => 'ENRILE BOULEVARD, BRGY. CAGGAY TUGUEGARAO CITY, TUGUEGARAO CAGAYAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 339440, 'party_no' => 350129, 'dealer_name' => 'TOYOTA SANTIAGO ISABELA, INC.', 'reference' => 'T0010036', 'address' => 'KM 321 MAHARLIKA HIGHWAY MALAPAT CORDON ISABELA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 75, 'party_no' => 10073, 'dealer_name' => 'TOYOTA BAGUIO', 'reference' => 'T0010017', 'address' => 'PUROK 6, BOKAWKAN ROAD, PADRE BURGOS BAGUIO CITY BENGUET', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 703697, 'party_no' => 714805, 'dealer_name' => 'TOYOTA TAGBILARAN CITY', 'reference' => 'T0010042', 'address' => '0930 TOYOTA BLDG., C.P.G NORTH AVENUE, TALOTO  TAGBILARAN CITY BOHOL', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1654938, 'party_no' => 1666715, 'dealer_name' => 'TOYOTA MABOLO CEBU INC.', 'reference' => 'T0010060', 'address' => '53 Pope John Paul II Ave. Brgy. Mabolo CEBU CITY CEBU', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1609012, 'party_no' => 1620752, 'dealer_name' => 'TOYOTA TALISAY CEBU', 'reference' => 'T0010056', 'address' => 'SRP ROAD, LAWAAN I TALISAY CEBU', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 81, 'party_no' => 10079, 'dealer_name' => 'TOYOTA MANDAUE', 'reference' => 'T0210018', 'address' => 'PSO 15, JOSE RIZAL STREET, TABOK MANDAUE CITY CEBU', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 300230, 'party_no' => 310833, 'dealer_name' => 'TOYOTA MANDAUE SOUTH, CEBU', 'reference' => 'T0010035', 'address' => 'OUANO AVE., NORTH RECLAMATION AREA SUBANGDAKU MANDAUE CITY CEBU', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 80, 'party_no' => 10078, 'dealer_name' => 'TOYOTA CEBU CITY', 'reference' => 'T0210019', 'address' => '34 M. J. CUENCO AVENUE, SAN ROQUE (CIUDAD) CEBU CITY CEBU', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1772076, 'party_no' => 1783963, 'dealer_name' => 'TOYOTA LAPU-LAPU, CEBU', 'reference' => 'T0010061', 'address' => 'Sitio Hawaiian 1, Marigondon, Lapu Lapu City LAPU-LAPU CITY CEBU', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 296399, 'party_no' => 307001, 'dealer_name' => 'TOYOTA TACLOBAN, LEYTE, INC.', 'reference' => 'T0010034', 'address' => 'BARANGAY 71, MAHARLIKA NAGA NAGA TACLOBAN CITY LEYTE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 79, 'party_no' => 10077, 'dealer_name' => 'TOYOTA CAGAYAN DE ORO', 'reference' => 'T0210022', 'address' => 'Km. 3 Kauswagan National Highway, Kauswagan CAGAYAN DE ORO CITY SOUTHERN LEYTE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1565355, 'party_no' => 1577062, 'dealer_name' => 'TOYOTA CALBAYOG SAMAR', 'reference' => 'T0010055', 'address' => 'Maharlika Highway Brgy. Bagacay CALBAYOG CITY WESTERN SAMAR', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1591773, 'party_no' => 1603502, 'dealer_name' => 'TOYOTA AKLAN INC.', 'reference' => 'T0010057', 'address' => 'Laguinbanua East, Numancia LIBACAO AKLAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 779812, 'party_no' => 790949, 'dealer_name' => 'TOYOTA ROXAS CITY', 'reference' => 'T0010047', 'address' => 'NATIONAL HIGHWAY, BOLO ROXAS CITY CAPIZ', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 86, 'party_no' => 10084, 'dealer_name' => 'TOYOTA ILOILO', 'reference' => 'T0210024', 'address' => 'GRAN PLAINS HIGHWAY, M.V. HECHANOVA ILOILO CITY ILOILO', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1916802, 'party_no' => 1928890, 'dealer_name' => 'TOYOTA NEGROS OCCIDENTAL', 'reference' => 'T0010068', 'address' => 'Lot 2A-1, Zone 15 (Pob), City of Talisay, Negros Occidental TALISAY NEGROS OCCIDENTAL', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 74, 'party_no' => 10072, 'dealer_name' => 'TOYOTA BACOLOD CITY', 'reference' => 'T0210023', 'address' => 'Araneta St. Tangub Bacolod NEGROS OCCIDENTAL', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 434699, 'party_no' => 445560, 'dealer_name' => 'TOYOTA DUMAGUETE CITY', 'reference' => 'T0010041', 'address' => '4741 TUBTUBON, SIBULAN DUMAGUETE CITY NEGROS ORIENTAL', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 501221, 'party_no' => 512162, 'dealer_name' => 'TOYOTA PUERTO PRINCESA CITY, INC.', 'reference' => 'T0010045', 'address' => 'NATIONAL HIGHWAY, BRGY. TAGBUROS PUERTO PRINCESA CITY PALAWAN', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1793929, 'party_no' => 1805839, 'dealer_name' => 'TOYOTA ILIGAN CITY, INC.', 'reference' => 'T0010063', 'address' => 'PUROK VANDA, BRGY. ACMAC, ILIGAN CITY ILIGAN CITY LANAO DEL NORTE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 779828, 'party_no' => 790965, 'dealer_name' => 'TOYOTA ZAMBOANGA CITY', 'reference' => 'T0010046', 'address' => 'MCLL HIGHWAY, BOALAN ZAMBOANGA CITY ZAMBOANGA DEL SUR', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 393904, 'party_no' => 404701, 'dealer_name' => 'TOYOTA BUTUAN CITY', 'reference' => 'T0010038', 'address' => '5 KM LIBERTAD BUTUAN CITY AGUSAN DEL NORTE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1830254, 'party_no' => 1842221, 'dealer_name' => 'TOYOTA VALENCIA CITY INC.', 'reference' => 'T0010065', 'address' => 'PUROK 17A, SAYRE HIGHWAY, HAGKOLPOBLACION VALENCIA CITY, BUKIDNON VALENCIA BUKIDNON', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1826572, 'party_no' => 1838533, 'dealer_name' => 'TOYOTA KIDAPAWAN CITY', 'reference' => 'T0010066', 'address' => 'LOT 7, BLK. 18, BRGY. BALINDOG KIDAPAWAN NORTH COTABATO', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 48422, 'party_no' => 58885, 'dealer_name' => 'TOYOTA GENERAL SANTOS', 'reference' => 'T0010027', 'address' => 'NATIONAL HI-WAY, CITY HEIGHTS GENERAL SANTOS CITY SOUTH COTABATO', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 408799, 'party_no' => 419626, 'dealer_name' => 'TOYOTA TAGUM CITY', 'reference' => 'T0010040', 'address' => 'SITIO LIBERTAD CANOCOTAN TAGUM CITY DAVAO DEL NORTE', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 1827004, 'party_no' => 1838966, 'dealer_name' => 'TOYOTA MATINA DAVAO', 'reference' => 'T0010054', 'address' => 'Mc. Arthur Highway Brgy., Matina Crossing Talomo District, DAVAO CITY DAVAO DEL SUR', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 85, 'party_no' => 10083, 'dealer_name' => 'TOYOTA DAVAO CITY', 'reference' => 'T0210021', 'address' => 'Km. 6 Lanang DAVAO CITY DAVAO ORIENTAL', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'FALSE'],
['party_id' => 2059078, 'party_no' => 2071350, 'dealer_name' => 'MOTORMALL NCR, INC.', 'reference' => 'T00100201', 'address' => '100 E. Rodriguez Jr. Ave., C-5, Ugong, Pasig City PASIG METRO MANILA', 'dealer_tin' => 'DEALERTINX', 'is_metro' => 'TRUE'],



        ];

        foreach ($data as $d) {
            $model = new DealerInfo($d);
            $model->save();
        }

    }
}

