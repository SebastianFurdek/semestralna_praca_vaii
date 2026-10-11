# LevelUP

Sebastián Furdek

5ZYI34

## Stručný opis projektu

Cieľom projektu je vytvoriť webovú aplikáciu na plánovanie a zaznamenávanie silových tréningov. Používateľ si bude môcť vytvoriť vlastný tréningový plán rozdelený do jednotlivých dní v týždni a opakovane ho využívať bez potreby zakaždým vytvárať nový tréning. Aplikácia umožní zaznamenávať vykonané série, počet opakovaní a použité hmotnosti.

Súčasťou aplikácie bude aj voliteľná funkcia automatického zvyšovania tréningovej hmotnosti podľa používateľom nastaveného prírastku a časového intervalu. Používateľ bude môcť navrhované zvýšenie potvrdiť, odložiť alebo hmotnosť upravovať manuálne. Cieľom je zjednodušiť organizáciu tréningov a sledovanie dlhodobého pokroku.

# Role v projekte

### 1. Návštevník
Návštevník môže zobraziť úvodnú stránku aplikácie, oboznámiť sa s jej funkciami a zaregistrovať sa alebo prihlásiť do existujúceho účtu. Nemá prístup k tréningovým plánom ani osobným údajom používateľov.

### 2. Registrovaný používateľ
Registrovaný používateľ je hlavnou rolou aplikácie. Môže vytvárať a upravovať vlastné tréningové plány, spravovať cviky, zaznamenávať absolvované tréningy a sledovať históriu svojich výsledkov. Zároveň môže nastavovať automatické zvyšovanie tréningovej hmotnosti a spravovať svoje telesné merania a osobné údaje.

### 3. Administrátor
Administrátor zodpovedá za správu používateľských účtov a základnú kontrolu fungovania aplikácie. Má oprávnenie spravovať účty používateľov a riešiť prípadné problémy so systémom. Nemal by automaticky získavať prístup k súkromným tréningovým údajom používateľov, pokiaľ to nie je nevyhnutné na konkrétnu administratívnu činnosť.

## Role v projekte

### 1. Návštevník
Návštevník si môže prezerať úvodnú stránku aplikácie a dostupné informácie o jej funkciách. Má možnosť zaregistrovať sa alebo prihlásiť do existujúceho účtu. Nemá prístup k tréningovým plánom ani osobným údajom registrovaných používateľov.

### 2. Registrovaný používateľ
Registrovaný používateľ môže vytvárať a upravovať vlastné tréningové plány, spravovať cviky a zaznamenávať absolvované tréningy vrátane sérií, opakovaní a použitých hmotností. Môže sledovať históriu tréningov, evidovať telesné merania a nastavovať voliteľné automatické zvyšovanie tréningovej hmotnosti. Zodpovedá za správu svojho účtu a vlastných tréningových údajov.

### 3. Administrátor
Administrátor zodpovedá za správu používateľských účtov a základnú správu systému. Môže zobrazovať zoznam registrovaných používateľov a podľa potreby odstraňovať ich účty. Pri odstránení účtu sa odstránia aj údaje, ktoré k nemu patria, napríklad tréningové plány, história tréningov a telesné merania. Administrátor má oprávnenia, ktoré bežný používateľ nemá.

## Plánované entity

### 1. Používateľ (User)
Predstavuje používateľa aplikácie a uchováva jeho prihlasovacie údaje a rolu v systéme.

**Hlavné atribúty:** ID používateľa, používateľské meno, e-mail, hash hesla, rola, dátum vytvorenia účtu.

**Vzťahy:** Používateľ môže vlastniť viacero tréningových plánov, vytvárať tréningové záznamy, spravovať vlastné cviky a zaznamenávať telesné merania.

### 2. Cvik (Exercise)
Predstavuje cvik, ktorý môže používateľ zaradiť do svojho tréningového plánu.

**Hlavné atribúty:** ID cviku, ID používateľa, názov, svalová skupina, popis.

**Vzťahy:** Cvik môže byť zaradený do viacerých tréningových dní a použitý vo viacerých absolvovaných tréningoch.

### 3. Tréningový plán (WorkoutPlan)
Predstavuje plán vytvorený používateľom, ktorý určuje rozdelenie tréningov do jednotlivých dní v týždni.

**Hlavné atribúty:** ID plánu, ID používateľa, názov, popis, stav aktívnosti, dátum vytvorenia.

**Vzťahy:** Jeden plán môže obsahovať viacero tréningových dní.

### 4. Tréningový deň (PlanDay)
Predstavuje konkrétny deň v rámci tréningového plánu, napríklad pondelok alebo utorok.

**Hlavné atribúty:** ID dňa, ID tréningového plánu, názov dňa, deň v týždni, poradie.

**Vzťahy:** Každý tréningový deň patrí jednému plánu a môže obsahovať viacero cvikov. Zároveň môže slúžiť ako predloha pre viacero absolvovaných tréningov.

### 5. Cvik v tréningovom pláne (PlanExercise)
Predstavuje konkrétny cvik zaradený do určitého tréningového dňa. Uchováva aj nastavenia potrebné na automatické zvyšovanie tréningovej hmotnosti.

**Hlavné atribúty:** ID položky, ID tréningového dňa, ID cviku, poradie cviku, cieľový počet sérií a opakovaní, cieľová hmotnosť, zapnutie automatického zvyšovania, veľkosť prírastku, interval zvyšovania a dátum nasledujúceho zvýšenia.

**Vzťahy:** Každá položka patrí jednému tréningovému dňu a odkazuje na jeden cvik. Môže byť použitá pri vytváraní viacerých absolvovaných tréningov.

### 6. Absolvovaný tréning (Workout)
Predstavuje konkrétny tréning, ktorý používateľ absolvoval v určitom dátume.

**Hlavné atribúty:** ID tréningu, ID používateľa, ID tréningového dňa, dátum tréningu, čas začiatku a ukončenia, poznámka.

**Vzťahy:** Každý tréning patrí jednému používateľovi a môže obsahovať viacero vykonaných cvikov. Odkaz na tréningový deň umožňuje evidovať, podľa ktorého plánu bol tréning vytvorený.

### 7. Vykonaný cvik (WorkoutExercise)
Predstavuje cvik vykonaný počas konkrétneho tréningu. Uchováva informácie potrebné na zachovanie histórie aj v prípade, že používateľ neskôr upraví svoj tréningový plán.

**Hlavné atribúty:** ID položky, ID absolvovaného tréningu, ID cviku v pláne, ID cviku, názov cviku v čase tréningu, poradie, poznámka.

**Vzťahy:** Každá položka patrí jednému absolvovanému tréningu a môže obsahovať viacero záznamov jednotlivých sérií.

### 8. Záznam série (SetRecord)
Predstavuje konkrétnu sériu vykonanú pri určitom cviku počas tréningu.

**Hlavné atribúty:** ID série, ID vykonaného cviku, poradové číslo série, počet opakovaní, skutočne použitá hmotnosť, dátum vytvorenia záznamu.

**Vzťahy:** Každá séria patrí jednému vykonanému cviku. Viacero záznamov sérií umožňuje uchovávať históriu výkonov a vyhodnocovať pokrok používateľa.

### 9. Telesné meranie (BodyMeasurement)
Predstavuje záznam telesných parametrov používateľa v konkrétnom čase.

**Hlavné atribúty:** ID merania, ID používateľa, dátum merania, telesná hmotnosť, obvod pása, krku, hrudníka, ramena a stehna, poznámka.

**Vzťahy:** Každé meranie patrí jednému používateľovi, ktorý môže mať zaznamenaných viacero meraní v rôznych dátumoch.

## Vzťahy medzi entitami
### Používateľ – Tréningový plán 1:N – Jeden používateľ môže mať viac tréningových plánov, pričom každý tréningový plán patrí jednému používateľovi.
### Používateľ – Cvik 1:N – Jeden používateľ môže vytvoriť viac cvikov, pričom každý cvik patrí jednému používateľovi.
### Tréningový plán – Tréningový deň 1:N – Jeden tréningový plán môže obsahovať viac tréningových dní, pričom každý tréningový deň patrí jednému tréningovému plánu.
### Tréningový deň – Cvik v tréningovom pláne 1:N – Jeden tréningový deň môže obsahovať viac cvikov, pričom každý záznam cviku patrí jednému tréningovému dňu.
### Používateľ – Absolvovaný tréning 1:N – Jeden používateľ môže zaznamenať viac absolvovaných tréningov, pričom každý absolvovaný tréning patrí jednému používateľovi.
### Tréningový deň – Absolvovaný tréning 1:N – Jeden tréningový deň môže byť použitý pri viacerých absolvovaných tréningoch, pričom každý absolvovaný tréning môže odkazovať najviac na jeden tréningový deň.
### Absolvovaný tréning – Vykonaný cvik 1:N – Jeden absolvovaný tréning môže obsahovať viac vykonaných cvikov, pričom každý vykonaný cvik patrí jednému absolvovanému tréningu.
### Cvik v tréningovom pláne – Vykonaný cvik 1:N – Jeden cvik v tréningovom pláne môže byť zaznamenaný vo viacerých absolvovaných tréningoch, pričom každý vykonaný cvik môže odkazovať najviac na jeden cvik v tréningovom pláne.
### Vykonaný cvik – Záznam série 1:N – Jeden vykonaný cvik môže obsahovať viac záznamov sérií, pričom každý záznam série patrí jednému vykonanému cviku.
### Používateľ – Telesné meranie 1:N – Jeden používateľ môže mať viac záznamov telesných meraní, pričom každý záznam telesného merania patrí jednému používateľovi.

## Hlavné stránky aplikácie

1. **Úvodná stránka** – Slúži na predstavenie aplikácie a jej hlavných funkcií. Návštevník tu nájde základné informácie o aplikácii a možnosti registrácie alebo prihlásenia.

2. **Prihlásenie a registrácia** – Umožňuje používateľovi vytvoriť si účet alebo prihlásiť sa do existujúceho účtu. Po prihlásení získa prístup k svojim tréningovým plánom a osobným údajom.

3. **Prehľad používateľa** – Poskytuje rýchly prehľad o tréningových plánoch, posledných absolvovaných tréningoch a posledných zaznamenaných telesných meraniach. Slúži ako hlavná stránka po prihlásení.

4. **Tréningové plány** – Umožňuje vytvárať, zobrazovať, upravovať a mazať tréningové plány. Používateľ môže jednotlivé plány rozdeliť na tréningové dni a priraďovať k nim cviky vrátane cieľového počtu sérií, opakovaní a tréningovej hmotnosti.

5. **Záznam tréningu** – Slúži na zaznamenávanie práve vykonávaného tréningu. Používateľ môže pri jednotlivých cvikoch evidovať počet sérií, opakovaní a použitú hmotnosť. Záznam sa uloží do histórie absolvovaných tréningov.

6. **História tréningov** – Zobrazuje zoznam absolvovaných tréningov a umožňuje prezerať podrobnosti jednotlivých tréningov vrátane vykonaných cvikov a zaznamenaných sérií. Používateľ tak môže porovnávať svoje predchádzajúce výkony.

7. **Telesné merania a nastavenia** – Umožňuje zaznamenávať a upravovať telesné merania, napríklad telesnú hmotnosť a obvody jednotlivých častí tela. Zároveň poskytuje možnosť nastaviť voliteľné automatické zvyšovanie tréningovej hmotnosti vrátane veľkosti prírastku a časového intervalu.

8. **Administrácia** – Je určená administrátorovi aplikácie. Umožňuje prezerať registrovaných používateľov, spravovať ich účty a v prípade potreby odstraňovať účty spolu s príslušnými údajmi.

## Rozdelenie funkcionality

### Základné funkcie

- **Registrácia a prihlásenie používateľa** – vytvorenie používateľského účtu, prihlásenie a zabezpečenie prístupu k osobným údajom.
- **Správa tréningových plánov** – vytváranie, zobrazovanie, úprava a mazanie tréningových plánov.
- **Správa cvikov** – pridávanie, zobrazovanie, úprava a mazanie cvikov.
- **Organizácia tréningov** – rozdelenie tréningových plánov na jednotlivé dni a priraďovanie cvikov ku konkrétnym dňom.
- **Zaznamenávanie absolvovaných tréningov** – evidencia vykonaných cvikov, počtu sérií, opakovaní a použitých hmotností.
- **História tréningov** – zobrazovanie predchádzajúcich tréningov a podrobností o zaznamenaných výkonoch.
- **Evidencia telesných meraní** – zaznamenávanie telesnej hmotnosti a vybraných obvodov tela.
- **Administrácia používateľov** – základná správa používateľských účtov administrátorom.
- **Inicializácia aplikácie a databázy** – možnosť spustenia aplikácie v prostredí Docker a príprava ukážkových údajov pri prvom spustení.

### Rozširujúce funkcie

- **Automatické zvyšovanie tréningovej hmotnosti** – voliteľné navrhovanie zvýšenia hmotnosti podľa používateľom nastaveného prírastku a časového intervalu.
- **Potvrdzovanie alebo odkladanie navrhovaného zvýšenia** – používateľ môže navrhovanú hmotnosť prijať, odložiť alebo ju upraviť manuálne.
- **Pokročilé štatistiky tréningov** – zobrazovanie grafov a štatistík vývoja tréningových výkonov v čase.
- **Rozšírené sledovanie telesných meraní** – porovnávanie nameraných hodnôt v rôznych časových obdobiach.
- **Export tréningových záznamov** – možnosť exportovať históriu tréningov a telesné merania do súboru.
