# SMB MVP Development Timeline (Solo Developer)

Estimated total duration: **4–6 weeks** (based on full-time commitment)

---

## Week 1: Project Setup & Auth

- [ ] Set up Docker environment (dev + prod)
- [ ] Configure Laravel project (Breeze + Socialite)
- [ ] Create user model and role logic (Spatie Permission)
- [ ] First login/register tests working

---

## Week 2: Data Upload & Storage

- [ ] Build file upload (JSON only)
- [ ] Validate and parse JSON into `records`
- [ ] Store metadata into `datasets`
- [ ] Create index for `admin_id` and `dataset_id`
- [ ] Ensure admin_id isolation is enforced

---

## Week 3: User Management & Viewer

- [ ] Admin can create internal users
- [ ] Assign roles: viewer / editor
- [ ] Create recursive Vue JSON viewer (Quasar)
- [ ] Add basic UI pages (dashboard, upload, table)

---

## Week 4: API Layer & Rate Limiting

- [ ] Enable Laravel Sanctum or Passport
- [ ] `GET /api/collections` + `GET /data/{id}`
- [ ] Enforce access via policy or middleware
- [ ] Rate limiting (429) based on plan
- [ ] Logging of user/API activity

---

## Week 5: Subscriptions & UI Polishing

- [ ] Add plans and fake payment logic
- [ ] Create `subscriptions` table logic
- [ ] Show plan status in dashboard
- [ ] Basic error handling and UI improvements

---

## Week 6: Testing & Launch

- [ ] Manual testing all flows
- [ ] Bug fixing and edge-case cleanup
- [ ] Polish README and deploy production build

---

> Note: Tasks may overlap or shift depending on availability, bugs, or feature changes.