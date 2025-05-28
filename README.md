# SMB Project Documentation

## Overview

SMB is a SaaS platform built to allow administrators ("Admins") to upload, manage, and grant access to their own datasets. It operates in a multi-tenant, fully isolated environment where each Admin manages their own ecosystem without any super-admin controlling them.

---

## Technology Stack

### Backend

- PHP 8.2
- Laravel 12
- MongoDB
- MySQL
- Redis

### Frontend

- Vue 3
- InertiaJS
- TailwindCSS
- Quasar (UI components)

### Environment

- Dockerized
  - Separate `dev` and `prod` environments

### Authentication

- Laravel Breeze (basic auth)
- Socialite (Google, GitHub login)

### Authorization

- Spatie Laravel Permission (role management)

---

## Business Logic

- Each new user automatically becomes an **Admin**.
- **Admin capabilities:**
  - Upload JSON/XML datasets into MongoDB.
  - Create their own users.
  - Assign read/edit permissions to users.
- **Data Isolation:**
  - All data is isolated via `admin_id`.
  - Users can only access their own Admin's data.
- **API Access:**
  - Uploaded datasets are automatically available via API.
  - Authorized users can retrieve datasets through protected API routes based on their permissions.
- **Important:**
  - Any user can become an Admin.
  - No super-admin exists above all Admins.

---

## Data Storage Structure

SMB stores all dataset records in a single shared MongoDB collection named `records`.

Each record includes:

- `admin_id`: to isolate data per Admin.
- `dataset_id`: to associate each record with a logical collection (e.g., "employees").
- `data`: raw content of the uploaded JSON row.
- `created_at`: timestamp of the upload.

A separate `datasets` collection stores metadata about uploaded collections:

```json
{
  "_id": ObjectId("662000..."),
  "admin_id": ObjectId("abc123"),
  "name": "Employee List",
  "slug": "employees",
  "fields": ["name", "position", "salary"],
  "created_at": "2025-04-30T10:00:00Z"
}
```

Benefits:

- Efficient filtering and indexing using `admin_id` and `dataset_id`
- No need to create dynamic MongoDB collections
- Simplified API design
- Fully isolated per Admin while keeping a scalable architecture

---

## Monetization Model

**Primary Payment:**

- Admins pay SMB platform for access.

**Secondary Payment (optional):**

- Admins can collect payments from their users independently.

**Subscription Plans:**

| Plan      | Price      | Storage Limit | Users Limit | API Requests/Day | Upload Size Limit | Support                    |
| --------- | ---------- | ------------- | ----------- | ---------------- | ----------------- | -------------------------- |
| Start     | $9/mo     | 1 GB          | 5 users     | 1000             | 5 MB              | Email (48h SLA)            |
| Pro       | $29/mo    | 10 GB         | 50 users    | 10,000           | 50 MB             | Priority Email (24h SLA)   |
| Corporate | On Request | 100 GB+       | 500+ users  | 100,000+         | 500 MB            | Dedicated Manager (4h SLA) |

**Storage/Request Overages:**

- +$5 per additional GB
- +$2 per 5 additional users
- +$5 per 5000 additional API requests

---

## API & Data Protection

**Authentication & Authorization:**

- Token-based access via Laravel Sanctum or Passport
- `Authorization: Bearer <token>` required for API access

**Endpoints:**

- `GET /api/collections` — list collections user has access to
- `GET /api/collections/{id}/data` — list all records in a collection
- `GET /api/collections/{id}/data/{record_id}` — get single record

**Rate Limiting:**

- 1000 API requests/day for Start Plan.
- 429 Too Many Requests if limit exceeded.

**Storage Control:**

- MongoDB document size and count monitoring.
- Upload limits enforced at API.

**Security:**

- Strict `admin_id` checks on all API data access.
- Never trust client-side admin references.

**Logging:**

- Full request and data operation logs for auditing.

---

## Subscription Management

**Database Tables:**

1. `plans`

   - `id`
   - `name`
   - `price`
   - `storage_limit_gb`
   - `users_limit`
   - `api_requests_per_day`
   - `file_upload_limit_mb`

2. `subscriptions`

   - `id`
   - `user_id` (Admin)
   - `plan_id`
   - `status` (active, canceled, unpaid)
   - `starts_at`
   - `ends_at`
   - `storage_used_gb`
   - `api_requests_today`

3. `admins`

   - `payment_provider_name`
   - `payment_provider_link`
   - `payment_status`

---

## Planned Payment Integrations

**Admin Subscription to SMB:**

- Paddle via Laravel Cashier Paddle.

**Admin Receiving Payments from Users:**

- Phase 1: Allow admins to set their own payment link manually.
- Phase 2 (future): OAuth/API integration (e.g., Paddle Connect).

**Jurisdiction:**

- Initial operations focused on Georgia (Paysera preferred).
- Future expansion to Paddle for global compliance.

---

## Development Stages

| Stage          | Actions                                                            |
| -------------- | ------------------------------------------------------------------ |
| MVP            | Start plan only, simple payment record, fake payments allowed      |
| Initial Growth | Add Start + Pro plans, payment method required for activation      |
| Scaling        | Add Corporate plan, lead capture form for custom deals             |
| Maturity       | Dedicated servers for large customers (optional corporate scaling) |

---

## Future Enhancements

- Storage billing per GB/month.
- Automatic suspension on unpaid invoices.
- Admin dashboard for payment statistics.
- User dashboard for subscription management.
- Fine-grained access control for API endpoints (e.g., per feature limit).

---

## Final Notes

This document outlines the initial setup for the SMB project including architecture, monetization, subscription flows, and future plans. Adjustments may be made as the project grows or based on client feedback.

---

**Document version: 2025-04-30**