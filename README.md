# Flebocenter - Medical Clinic Management System

[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com/)
[![PHP](https://img.shields.io/badge/PHP-8.3%2B-blue.svg)](https://php.net/)
[![MySQL](https://img.shields.io/badge/MySQL-8.0%2B-orange.svg)](https://mysql.com)
[![PHPUnit](https://img.shields.io/badge/PHPUnit-11-green.svg)](https://phpunit.de/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

**Flebocenter** is a secure medical clinic management system built with **Laravel 12**, designed to digitize patient records, automate appointment scheduling, and streamline clinical workflows. It follows healthcare data handling best practices to ensure patient data privacy and operational efficiency.

## Key Features

- **Patient Records Management** — Comprehensive digital patient profiles with medical history, treatments, and clinical notes.
- **Appointment Scheduling** — Calendar-based booking system with automated reminders to reduce patient no-shows.
- **Treatment Tracking** — End-to-end tracking of medical procedures, follow-ups, and treatment plans.
- **Clinical Reporting** — Automated generation of medical reports and clinic performance analytics.
- **Document Generation** — PDF export for patient records, prescriptions, and clinical reports using DomPDF.
- **Data Export** — Excel exports for patient lists, appointments, and clinic metrics (Maatwebsite/Excel).
- **Multi-Language Support** — Full English/Spanish localization (laravel-lang).
- **Role-Based Access Control** — Secure access levels for Administrators, Doctors, and Reception staff.
- **Audit Trail** — Complete logging of all data access and modifications for compliance.

## Technical Architecture

### Tech Stack
| Layer | Technology |
|---|---|
| **Backend** | PHP 8.3+, Laravel 12 |
| **Database** | MySQL 8.0+ (Normalized Schema, Indexed Queries) |
| **Frontend** | Blade Templates, Bootstrap 5, jQuery |
| **PDF Engine** | DomPDF 3.0 |
| **Excel Export** | Maatwebsite/Excel 3.1 |
| **Authentication** | Laravel Sanctum 4.0 + Laravel UI |
| **Localization** | laravel-lang 14.0 |
| **Testing** | PHPUnit 11 |

### Architecture Highlights
- **Data Privacy by Design** — Sensitive patient data is handled with strict access controls and encrypted storage following healthcare industry standards.
- **Form Request Validation** — All input is validated through dedicated Form Request classes, ensuring data integrity before it reaches the database.
- **Eloquent Relationships** — Complex medical data relationships (Patient → Appointments → Treatments → Follow-ups) modeled with Laravel's ORM for clean, maintainable queries.
- **Middleware Authorization** — Route-level middleware ensuring role-based access to sensitive medical records.
- **Optimized Queries** — Eager loading and query scopes to prevent N+1 problems when fetching patient histories with related records.
- **Helper Functions** — Global helper utilities autoloaded via Composer for consistent formatting and utility functions.

### Database Design
The system uses a normalized relational schema covering:
- Patients (demographics, contact info, medical history)
- Appointments (scheduling, status lifecycle, reminders)
- Treatments (procedures, medications, clinical notes)
- Users & Roles (doctors, admins, reception with granular permissions)
- Audit Logs (data access and modification tracking)

## Getting Started

### Requirements
- PHP 8.3+
- Composer 2.0+
- Node.js 16+
- MySQL 8.0+ or MariaDB 10.5+

### Installation
```bash
git clone https://github.com/szystems/flebocenter.git
cd flebocenter
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Business Impact

- Digitized **100% of patient records**, completely eliminating physical paper dependencies.
- Automated appointment reminders, significantly reducing patient no-shows.
- Streamlined clinical workflows, allowing staff to focus on patient care instead of administrative tasks.

## Testing

```bash
php artisan test
php artisan test --filter SpecificTestName
```

## License

This project is licensed under the MIT License. See [LICENSE](LICENSE) for details.

---

**Built by [Otto Szarata](https://github.com/szystems)** — Senior Full-Stack Developer | Victoria, BC, Canada
