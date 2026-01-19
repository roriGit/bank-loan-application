# 🏦 Bank Loan Application System

A full-stack **Bank Loan Application System** built using **Laravel (REST API)** for the backend and **Angular** for the frontend.  
The system allows customers to apply for bank loans and track their application status, while administrators can review, approve, or reject loan requests.

This project was created as a **machine test / technical assessment** to demonstrate clean architecture, API design, and frontend–backend separation.

--- 

## 🧱 Tech Stack

### Backend
- Laravel 10+
- PHP 8+
- MySQL / PostgreSQL
- Laravel Sanctum / JWT (API Authentication)

### Frontend
- Angular 16+
- TypeScript
- Angular Router
- Angular HTTP Client

## 🗄️ Database Models & Relationships

The system has **three main models**:

1. **Users** – stores all users (customers and admins)  
2. **Personal Details** – stores additional info for each user (1-to-1 with Users)  
3. **Applications** – stores loan applications submitted by users (1-to-many with Users) 

---

## 🌐 API Endpoints

### Users APIs
| Method | Endpoint | Description | Notes |
|--------|---------|------------|-------|
| `GET` | `/users` | List all users | Optional pagination: `?page=1&per_page=10` |
| `GET` | `/users/{id}` | Retrieve a single user by ID | — |
| `POST` | `/users` | Create a new user | Body: `name`, `email`, `password` |
| `PUT` | `/users/{id}` | Update user details | Body: fields to update |
| `DELETE` | `/users/{id}` | Delete a user | Supports soft delete if enabled |
| `GET` | `/users/{id}/personal-info` | Get personal info of a user | — |
| `POST` | `/users/{id}/personal-info` | Create personal info | Body: `id_number`, `phone`, `address` |
| `PUT` | `/users/{id}/personal-info` | Update personal info | Body: fields to update |
| `GET` | `/users/{id}/applications` | Get all applications of a user | Optional filter: `?status=pending` |

### Applications APIs
| Method | Endpoint | Description | Notes |
|--------|---------|------------|-------|
| `GET` | `/applications` | Retrieve all applications | Optional filters: `?status=approved&loan_type=personal&min_amount=5000&max_amount=100000&min_tenure=12&max_tenure=48&page=1&per_page=10` |
| `GET` | `/applications/{id}` | Retrieve a single application | — |
| `POST` | `/applications` | Create a new application | Body: `user_id`, `loan_type`, `amount`, `tenure_months`, `status` |
| `PUT` | `/applications/{id}` | Update an application | Body: fields to update |
| `DELETE` | `/applications/{id}` | Delete an application | Supports soft delete if enabled |
| `GET` | `/applications?status={status}` | Filter applications by status | `status = pending | approved | rejected` |
| `GET` | `/applications?loan_type={type}` | Filter by loan type | `loan_type = personal | home | auto | mortgage | student` |
| `GET` | `/applications?min_amount={x}&max_amount={y}` | Filter by loan amount range | — |
| `GET` | `/applications?min_tenure={x}&max_tenure={y}` | Filter by tenure in months | — |
| `GET` | `/users/{id}/applications?status={status}` | Filter a user’s applications by status | — |

### Analytics / Misc APIs
| Method | Endpoint | Description | Notes |
|--------|---------|------------|-------|
| `GET` | `/applications/count` | Total number of applications | Optional: filter by status |
| `GET` | `/applications/stats` | Aggregated stats: avg/min/max loan amounts, per loan type | — |
| `GET` | `/users/count` | Total number of users | — |
| `GET` | `/users/{id}/summary` | Summary of a user: personal info + applications | — |

### Authentication APIs
| Method | Endpoint | Description | Notes |
|--------|---------|------------|-------|
| `POST` | `/login` | Authenticate a user | Body: `email`, `password` |
| `POST` | `/logout` | Logout current user | Requires auth |
| `POST` | `/register` | Register new user | Body: `name`, `email`, `password` |
| `GET` | `/me` | Get current logged-in user info | Requires auth |
