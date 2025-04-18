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
- Poga, lai "iegādātos" grāmatu jeb celtu tās popularitāti

### Grāmatu pirkšana
- Poga "Pirkt" pie katras grāmatas
- Pirkumi tiek reģistrēti datubāzē (`purchases` tabulā)
- Automātiski tiek atjaunots grāmatu saraksts

### API Endpoints
- `/api/top10` – atgriež šī mēneša **top 10 populārākās grāmatas**
- Atgriež JSON ar grāmatas nosaukumu, autoru sarakstu un pirkumu skaitu šajā mēnesī

---

## 🔓 Autentifikācija

Lai sistēmu vienkāršotu, **esmu noņēmis Laravel autentifikāciju** (`laravel/breeze`, `laravel/sanctum`, utt.), lai lietotājam nav jāreģistrējas.