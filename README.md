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
