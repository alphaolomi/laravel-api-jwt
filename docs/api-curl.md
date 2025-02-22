# API Curl Commands

## Setup Variables
```bash
TOKEN="your_jwt_token_here"
```

## Authentication Endpoints

### Login
```bash
curl -X POST "http://localhost:8000/api/auth/login" \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password"}'
```
Expected Response:
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

### Logout
```bash
curl -X POST "http://localhost:8000/api/auth/logout" \
  -H "Authorization: Bearer ${TOKEN}" \
  -H "Content-Type: application/json"
```
Expected Response:
```json
{
  "message": "Successfully logged out"
}
```

### Get User Profile
```bash
curl -X POST "http://localhost:8000/api/auth/me" \
  -H "Authorization: Bearer ${TOKEN}" \
  -H "Content-Type: application/json"
```
Expected Response:
```json
{
  "id": 1,
  "name": "John Doe",
  "email": "john@example.com"
}
```

### Refresh Token
```bash
curl -X POST "http://localhost:8000/api/auth/refresh" \
  -H "Authorization: Bearer ${TOKEN}" \
  -H "Content-Type: application/json"
```
Expected Response:
```json
{
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "token_type": "bearer",
  "expires_in": 3600
}
```

### Webhook Handler
```bash
curl -X GET "http://localhost:8000/api/auth/webhook" \
  -H "Content-Type: application/json"
```
Expected Response:
```json
{
  "status": "received"
}
```

## System Endpoints

### Health Check
```bash
curl -X GET "http://localhost:8000/up"
```
Expected Response:
```json
{
  "status": "up"
}
```

### API Root
```bash
curl -X GET "http://localhost:8000/api" \
  -H "Content-Type: application/json"
```
Expected Response:
```json
{
  "version": "1.0",
  "status": "operational"
}
```

### CSRF Cookie
```bash
curl -X GET "http://localhost:8000/sanctum/csrf-cookie" \
  -c "cookies.txt"
```
Expected Response:
```
< Set-Cookie: XSRF-TOKEN=eyJpdiI6....; expires=...; path=/
```