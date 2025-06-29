# SMB Studio – Pricing & Access Control Model

## Overview

SMB Studio is a SaaS platform that enables Admins to upload structured datasets (JSON/CSV/XML), manage user access, and interact with data using natural language via GPT-4o. Users provide their own OpenAI API key (BYOK), and subscription pricing is based on access to features, roles, and data management.

---

## Subscription Plans

| Plan           | Monthly     | Yearly         | Users | Projects | Roles     | Data Access Scope   | Support        |
|-------------   |-------------|----------------|-------|----------|-----------|---------------------|----------------|
| **Free**       | $0          | –              | 1     | 3        | Owner     | Full                | Community      |
| **Starter**    | $9/mo       | $86/yr         | 1     | 10       | Owner     | Full                | Email (48h SLA)|
| **Team**       | $29/mo      | $278/yr        | 5     | 50       | All       | Full + RBAC         | Priority Email |
| **Business**   | $99/mo      | $950/yr        | 20    | 200      | All       | RBAC + Templates    | SLA 24h        |
| **Enterprise** | Custom      | Custom         | 50+   | ∞        | All       | Full + SCIM/IAM     | SLA 4h         |

> AI queries are not billed by SMB Studio — users connect their own OpenAI API key (BYOK). Free plans include 3 GPT prompts to test the functionality.

---

## Role-Based Access Control (RBAC)

| Role     | Feature Access                           | Data Access Scope                |
|----------|------------------------------------------|----------------------------------|
| Owner    | Full: manage project, users, AI, export  | All tables, rows, columns        |
| Editor   | AI queries, visualizations, filters      | Assigned tables, partial data    |
| Viewer   | Read-only                                | Specific tables/columns only     |
| Guest    | Limited viewing                          | Minimal or demo data only        |

- Access is scoped by project.
- Data access includes control by **table**, **column**, and **row filter**.

---

## Access Templates

Templates are available in **Business** and **Enterprise** plans. They let Admins:

- Create reusable access profiles (e.g. “External Analyst”)
- Apply data access policies to multiple users/projects at once
- Centralize and manage permission consistency

### Template Example

**"External Analyst" Template**
- Role: Viewer
- Tables: `revenue`, `sales`
- Columns: only `region`, `amount`, `date`
- Row filter: `region in ['EMEA', 'APAC']`
- Features: export allowed, AI access disabled

---

## AI Model Access (BYOK)

- All AI features require user to input their own OpenAI API key.
- No AI usage is charged by SMB Studio.
- Free users receive 3 prompt credits to test functionality.

---

## Notes

- Project = isolated workspace with datasets, filters, prompts, and roles.
- All data is tenant-isolated via `admin_id`.
- RBAC and data filters are enforced at API and UI level.
- Subscription pricing covers platform access, not compute (OpenAI tokens).