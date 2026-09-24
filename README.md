# Koyonzo Family Care Clinic — Clinic Management System

A web-based clinic management system built with **Laravel 13** and **MySQL**. It digitises the daily patient flow for a small clinic with two user roles: **Staff** (who handle registration, triage and lab work) and **Doctor** (who consult and prescribe).

> Clinic brand name: **Koyonzo Family Care Clinic**

---

## Current status

The simplified "two-form" workflow is **implemented, tested and pushed** to GitHub:

1. **Staff entry form** — patient registration, visits, chief complaint, triage vitals (auto-BMI), and lab tests.
2. **Doctor's form** — consultation (history, examination, diagnosis, treatment, referral, next appointment) plus free-form prescriptions, opened from the **Waiting List**.

This is the first delivery of the full handover blueprint. Billing/receipts, appointments, reports, pharmacy queue, and admin screens are planned for later rounds (see [Roadmap](#roadmap)).

---

## How the system works (workflow)

```
Patient arrives
   │
   ▼
1. STAFF logs in  ──►  Register patient (auto serial PAT-YYYY-#### ⇒ creates Visit #1)
   │                    or search existing patient ⇒ "New Visit" (Visit #2, #3…)
   ▼
2. STAFF entry form  ──►  1. Chief Complaint
                           2. Triage vitals (BP, Temp, Pulse, Resp, Weight, Height → auto BMI)
                           3. Lab Tests (+ Lab status)
   │                    Save = triage_done  ⇒  patient joins the Waiting List
   ▼
3. DOCTOR logs in  ──►  Dashboard shows Waiting List (triaged, not yet consulted)
   │                    Clicks a patient ⇒ sees the staff summary (complaint, vitals, lab)
   │                    Blinking yellow Visit ID confirms the correct record
   ▼
4. DOCTOR's form  ──►  Part 1 — Consultation: History · Examination · Diagnosis · Treatment
   │                    Part 2 — Prescription: add multiple drug lines (name, dosage,
   │                    frequency, duration, quantity) + optional next appointment
   │                    "Complete Visit" ⇒ consultation_done = true
   ▼
5. STAFF  ──►  Opens the patient record ⇒ reads the doctor's consultation + prescription,
               and can toggle each drug's status to **Dispensed** (pharmacy)
```

### Key business rules implemented
- **Serial number** — `PAT-YYYY-####`, generated automatically on first save (e.g. `PAT-2026-0001`).
- **Visit numbering** — each patient's visits are counted (Visit #1, #2, …).
- **Age** — calculated from date of birth.
- **BMI** — `weight(kg) / height(m)²`, auto-calculated and shown live on the triage form.
- **Ghost record prevention** — a consultation is only saved when History or Examination is filled in.
- **Waiting List** — patients with `triage_done = true` and `consultation_done = false`.
- **Role-based access** — `staff` vs `doctor` menus are gated by middleware.

---

## Roles & logins

Two accounts are created by the seeder (`php artisan db:seed`):

| Role                | Username | Password  | Responsibilities |
|---------------------|----------|-----------|------------------|
| Staff (pharmacy + lab) | `staff`  | `password` | Register patients, open visits, triage + lab entry, dispense prescriptions |
| Doctor              | `doctor` | `password` | View waiting list, consultation, prescription |

> ⚠️ **Demo credentials — change the passwords before real use.**

---

## Using the system (end-user quick guide)

1. **Open the clinic system** — visit `http://<server>/` (you are redirected to the login screen).
2. **Log in** — Staff use username `staff`, Doctor uses username `doctor` (or the seeded email).
3. **Staff — register / open a visit:** *Patients → Search Patients → Register Patient*. The serial number `PAT-YYYY-####` is generated automatically and a first visit is created.
4. **Staff — existing patient:** *Patients → search → open the record → New Visit* (Visit #2, #3, …).
5. **Staff — triage + lab:** from the patient's record click *Triage Entry* → enter Chief Complaint, vitals (BMI auto-calculates) and Lab Tests → *Save Triage*. The patient now appears on the doctor's **Waiting List**.
6. **Doctor — consult:** Doctor dashboard → *Waiting List* → pick a patient (the blinking **Visit ID** confirms the right record) → enter History, Examination, Diagnosis, Treatment, add prescription drug lines and an optional follow-up date → *Complete Visit*.
7. **Staff — dispense:** reopen the patient's record → the doctor's consultation and prescription are visible → *Toggle* each drug to **Dispensed** when handed out.
8. **Log out** — user menu → *Log Out*.

---

## Public website (frontend)

The clinic also ships a public marketing website at **`/home`**:

| Page | URL |
|------|-----|
| Home (hero, stats, services, departments, doctors) | `/home` |
| Doctors list & profile | `/home/doctors`, `/home/doctors/1` |
| Department | `/home/department/1` |
| About Us | `/home/about_us` |
| Book Appointment | `/home/appointment` |
| Blog | `/home/blog` |
| Contact Us | `/home/contact_us` |

The public pages feature a **responsive mobile menu (hamburger)**, scroll-triggered **entrance animations**, **count-up stat numbers** (fed by real database totals: patients, visits, prescriptions, doctors) and modern hover effects (card lifts, button shine, nav underlines) — all disabled automatically for users with `prefers-reduced-motion`.

> **Note:** "Book Appointment" on the public site is a booking-request form placeholder for now; the clinic-side appointment scheduling module is on the roadmap below.

---

## Pages / screens

| Screen | Route | Role |
|--------|-------|------|
| Login | `/login` | all |
| Dashboard (role-aware) | `/dashboard` | all |
| Patient search | `/patients` | staff |
| Register patient | `/patients/create` | staff |
| Patient record + visit history | `/patients/{id}` | staff |
| Staff entry form (triage + lab) | `/visits/{id}/triage` | staff |
| Doctor consultation + prescription | `/consultations/{id}` | doctor |
| Prescription dispense | `POST /prescriptions/{id}/dispense` | staff |

---

## Tech stack

- **Backend:** PHP 8.4 / Laravel 13
- **Frontend:** Blade + Bootstrap 5 (CDN), custom `public/css/clinic.css`
- **Database:** MySQL (Laravel configured; tests run on in-memory SQLite)
- **Build tooling:** Vite + Tailwind (default assets), Composer
- **Testing:** PHPUnit feature tests (`tests/Feature/ClinicWorkflowTest.php`)

### Frontend touches
- Eased **count-up** stat numbers on both dashboards (IntersectionObserver + requestAnimationFrame — no library)
- Staggered **fade-up** entrance animations for cards, buttons and tables
- Hover transitions on cards, buttons and table rows; animated nav underline
- Login card entrance animation
- Fully **responsive** for phones/tablets; honors `prefers-reduced-motion`

---

## Installation (local)

```bash
git clone https://github.com/JimmyBiverson/Clinic-Management-System.git
cd Clinic-Management-System
composer install

cp .env.example .env
# set DB_* to your MySQL database, e.g. DB_DATABASE=hospital

php artisan key:generate
php artisan migrate --seed    # creates tables + staff/doctor users
php artisan serve

# open http://127.0.0.1:8000  → redirected to /login
```

Optional frontend build (default pages use CDN assets):
```bash
npm install
npm run build
```

---

## Testing the backend

```bash
php artisan test        # 16 feature tests (workflow, auth, roles, business rules)
vendor/bin/pint         # code style
```

The feature suite covers:
- staff registration + first visit
- triage → patient joins waiting list, BMI auto-calculation
- doctor sees only triaged patients on the waiting list
- consultation + prescription save, complete visit flags
- ghost-record prevention (empty consultation not saved)
- staff dispensing a prescription
- role gating (staff blocked from doctor form, doctor blocked from registration)
- username login + guest redirects

---

## Roadmap (from the handover blueprint)

- [ ] Pharmacy dispense queue screen
- [ ] Billing & receipts (cash / M-PESA / card / insurance), VAT at 16%
- [ ] Appointments & reminders (upcoming/attended/missed, 2-day popup)
- [ ] Management reports (10 CEO reports, clipboard / Excel export)
- [ ] Admin panel — users, drugs, services, prices
- [ ] Drug master list with pricing & stock
- [ ] No-cost prescription slip and cost receipt printing (thermal printer)
- [ ] Audit log + daily automated backup
- [ ] Change-password / password reset

---

## License

Intended for the clinic's internal use and demonstration purposes.