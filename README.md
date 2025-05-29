# SMB Project Documentation

## Overview

SMB is a hybrid Web2/Web3 SaaS platform that allows administrators ("Admins") to upload, manage, and grant access to their own datasets. It operates in a multi-tenant, fully isolated environment where each Admin manages their own ecosystem independently. Payments can be made in both fiat and SMB tokens.

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
  - Create and manage their own users.
  - Assign read/edit permissions.
- **Data Isolation:**
  - All data is isolated via `admin_id`.
- **API Access:**
  - Uploaded datasets are available via protected API.
- **Important:**
  - No super-admin exists. All Admins are equal.

---

## Data Storage Structure

All dataset records are stored in a single MongoDB collection `records`.

Each record includes:

- `admin_id`: to isolate data.
- `dataset_id`: to group records logically.
- `data`: uploaded row content.
- `created_at`: timestamp.

Metadata is stored in the `datasets` collection:

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
- Unified schema
- Simplified API
- Isolation through `admin_id`

---

## Monetization Model

**Fiat Payment:**
- Admins pay SMB directly in USD via Paysera or Paddle.

**Token Payment (SMB token):**
- Admins or users may unlock advanced features via holding or spending SMB tokens.
- **Discounts apply when paying in SMB tokens.**

> ⚠️ *Note: Token-based pricing assumes internal rates. Without a DEX market, the value of SMB token is fixed and controlled within the platform. Token payments are not always cheaper in absolute terms but incentivized via fixed discounts.*

### Subscription Plans:

| Plan      | Price (USD) | Price (SMB)* | Storage Limit | Users Limit | API Requests/Day | Upload Size Limit | Support                    |
| --------- | ------------|--------------| --------------| ------------| ------------------| -------------------| ---------------------------|
| Start     | $9/mo       | 90 SMB/mo    | 1 GB          | 5 users     | 1000              | 5 MB               | Email (48h SLA)            |
| Pro       | $29/mo      | 270 SMB/mo   | 10 GB         | 50 users    | 10,000            | 50 MB              | Priority Email (24h SLA)   |
| Corporate | On Request  | On Request   | 100 GB+       | 500+ users  | 100,000+          | 500 MB             | Dedicated Manager (4h SLA) |

**Overages:**
- +$5 or 50 SMB per extra GB
- +$2 or 20 SMB per 5 users
- +$5 or 50 SMB per 5000 API requests

---

## Web3 Enhancements via SMB Token

**Features unlocked by holding or spending SMB tokens:**

- CSV export
- Increased API rate limits
- Custom branding
- Access to premium datasets
- DAO-style feature voting

Token usage is flexible:
- Holding model: access while balance ≥ threshold
- Spending model: pay SMB to activate features
- **SMB token provides access to premium features at discounted cost compared to fiat.**

---

## API & Security

**Auth:**
- Laravel Sanctum / Passport
- `Authorization: Bearer <token>` required

**Endpoints:**
- `GET /api/collections`
- `GET /api/collections/{id}/data`
- `GET /api/collections/{id}/data/{record_id}`

**Limits:**
- Enforced per subscription
- Exceeding limits returns 429

**Security:**
- All queries filtered by `admin_id`
- Full audit logging

---

## Subscription Management

**Key tables:**

1. `plans`
2. `subscriptions`
3. `admins` (stores fiat/token payment method)

---

## Payment Integrations

- Admin payments: via Paddle or Paysera
- Admins collecting payments from their users:
  - Phase 1: manual link
  - Phase 2: API integration (e.g., Paddle Connect)

---

## Development Phases

| Phase         | Goals                                                                 |
|---------------|-----------------------------------------------------------------------|
| MVP           | Start plan, fiat/token hybrid, minimal token-based features           |
| Initial Growth| Add Pro plan, token-exclusive features                                |
| Scaling       | Corporate plan, lead form                                             |
| Maturity      | White-label deployments, staking, full token utility & DEX listing    |

---

## Future Plans

- Granular API access per token
- Public DEX listing of SMB
- Staking for platform benefits
- Reputation layer stored on-chain
- **Smart contract-based access rules for token-only operations**

---

## Technical Implementation (Token Access)

- Token stored on Solana (SPL standard)
- No smart contract needed at MVP stage
- Laravel will verify token balance using JSON-RPC:
  - `getTokenAccountsByOwner`
  - `getTokenAccountBalance`
- Access features will be gated via middleware:
  - Check wallet address linked to user
  - Validate balance ≥ feature threshold
- **Optional:** expose balance via `/me/token-status` endpoint

---

**Document version: 2025-05-28**