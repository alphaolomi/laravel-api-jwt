# API Documentation

## Table of Contents
- [Authentication Endpoints](#authentication-endpoints)
- [System Endpoints](#system-endpoints)

## Authentication Endpoints

### Login
- **URL:** `POST /api/auth/login`
- **Description:** Authenticates user and returns JWT token
- **Request Body:**
  ```json
  {
    "email": "user@example.com",
    "password": "password"
  }
  ```
- **Success Response:**
  ```json
  {
    "access_token": "<jwt_token>",
    "token_type": "bearer",
    "expires_in": 3600
  }
  ```

### Logout
- **URL:** `POST /api/auth/logout`
- **Description:** Invalidates the current JWT token
- **Authentication:** Bearer Token required
- **Success Response:**
  ```json
  {
    "message": "Successfully logged out"
  }
  ```

### Get User Profile
- **URL:** `POST /api/auth/me`
- **Description:** Returns authenticated user's profile
- **Authentication:** Bearer Token required
- **Success Response:**
  ```json
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com"
  }
  ```

### Refresh Token
- **URL:** `POST /api/auth/refresh`
- **Description:** Issues a new JWT token
- **Authentication:** Bearer Token required
- **Success Response:**
  ```json
  {
    "access_token": "<new_jwt_token>",
    "token_type": "bearer",
    "expires_in": 3600
  }
  ```

### Webhook Handler
- **URL:** `GET /api/auth/webhook`
- **Description:** Handles incoming webhook requests
- **Authentication:** API middleware
- **Response:** Varies based on webhook type

## System Endpoints

### Health Check
- **URL:** `GET /up`
- **Description:** Simple health check endpoint
- **Success Response:**
  ```json
  {
    "status": "up"
  }
  ```

### API Root
- **URL:** `GET /api`
- **Description:** API information endpoint
- **Middleware:** api
- **Success Response:**
  ```json
  {
    "version": "1.0",
    "status": "operational"
  }
  ```

### CSRF Cookie
- **URL:** `GET /sanctum/csrf-cookie`
- **Description:** Returns CSRF cookie for web security
- **Middleware:** web
- **Response:** Sets CSRF cookie in response headers