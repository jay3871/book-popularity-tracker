# 📚 Grāmatu popularitātes sistēma

Šis projekts ir veidots kā praktiskais uzdevums darba vakances atlases procesā. Sistēmas mērķis ir attēlot grāmatas, to autorus un popularitāti, kā arī nodrošināt pirkšanas iespēju. 

## 🔧 Izmantotās tehnoloģijas

- **Laravel 12** – priekš backend
- **Vue 3** – priekš frontend
- **Inertia.js** – savienojums starp Laravel un Vue bez API
- **Tailwind CSS** – dizainam un stilizācijai
- **Toastification** – toast paziņojumu sistēma
- **Lodash (debounce)** – meklēšanas optimizācijai

---

## 🧩 Funkcionalitāte

### Grāmatu saraksts
- Meklēšana pēc nosaukuma vai autora
- Kārtošana pēc mēneša popularitātes
- Kopējais un šī mēneša pirkumu skaits
- Poga, lai iegādātos grāmatu jeb celtu tās popularitāti

### Grāmatu pirkšana
- Poga "Pirkt" pie katras grāmatas
- Pirkumi tiek reģistrēti datubāzē (`purchases` tabulā)
- Grāmatu saraksts tiek atjaunots automātiski

### API Endpoints
- `/api/books/top10` – atgriež šī mēneša **top 10 populārākās grāmatas**
- Atgriež JSON ar grāmatu nosaukumiem, autoru sarakstu un pirkumu skaitu šajā mēnesī

---

## 🔓 Autentifikācija

Lai vienkāršotu sistēmas demonstrāciju, **esmu noņēmis jeb atspējojis Laravel autentifikāciju** (`laravel/breeze`, `laravel/sanctum`, utt.), lai lietotājam nav jāreģistrējas.

---

## 🚀 Uzstādīšana (lokāli)

Lai uzstādītu un palaistu šo projektu lokāli, veic šādas darbības:

### 1. Klonē projektu
Klonē šo repo savā datorā:
```bash
git clone https://github.com/jay3871/book-popularity-tracker
cd book-popularity-tracker
```

### 2. Ieinstalē PHP dependencies
Pārliecinies, ka tev ir uzstādīts PHP (>=8.2) un Composer, tad palaiž:
```bash
composer install
```

### 3. Ieinstalē JavaScript dependencies
Pārliecinies, ka tev ir uzstādīts Node.js (ieteicams >=18.x) un NPM, tad palaiž:
```bash
npm install
```

### 4. Izveido .env failu
Kopē .env.example uz .env un nepieciešamības gadījumā pielāgo datubāzes vai citu konfigurāciju:
```bash
cp .env.example .env
```

### 5. Saģenerē key priekš Laravel
```bash
php artisan key:generate
```

### 6. Uzstādi datubāzi
Pārliecinies, ka datubāze ir izveidota. Tad palaiž migrācijas:
```bash
php artisan migrate
```
Ja vēlies arī testa datus:
```bash
php artisan db:seed
```

### 7. Laravel servera palaišana
```bash
php artisan serve
```

### 8. Kompilē frontendu
Lai palaistu Vue ar Inertia un redzētu rezultātu pārlūkā:
```bash
npm run dev
```

### ✅ Gatavs!
Tagad atver pārlūkā:
```bash
http://127.0.0.1:8000/books
```