## INSTALL INSTRUCTIONS
1. Clone the repository
2. Create a .env file in the root directory
3. Copy the contents of .env.example into .env
4. Create a database and add the database name, username, and password to the .env file
5. Run `composer install` in the root directory
6. Run `php artisan key:generate` in the root directory
7. Run `php artisan migrate` in the root directory
8. Run `php artisan passport:install` in the root directory
9. Run `php artisan serve` in the root directory

## API DOCUMENTATION
### Authentication
#### 1. Register
##### Request
`POST /api/register`
##### Body
```
{
    "name": "John Doe",
    "email": "johndoe@gmail.com",
    "password": "password",
}

```
##### Response
```
{
    "user": {
        "name": "john doe",
        "email": "johnDoe@gmail.com",
        "updated_at": "2023-09-11T11:26:37.000000Z",
        "created_at": "2023-09-11T11:26:37.000000Z",
        "id": 2
    },
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9....."
}

```

#### 2. Login
##### Request
`POST /api/login`
##### Body
```
{
    "email": "johnDoe@gmail.com",
    "password": "password",
}
    
```

##### Response
```
    {
        "user": {
            "id": 1,
            "name": "john doe",
            "email": "johnDoe1@gmail.com",
            "email_verified_at": null,
            "created_at": "2023-09-11T11:24:02.000000Z",
            "updated_at": "2023-09-11T11:24:02.000000Z"
        },
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9....."
    }
```

### Todo
#### 1. Create Todo
##### Request
`POST /api/todo`

##### Body
```
{
    "title": "Todo 1",
    "description": "Todo 1 description",
    "category_id": 1,
    "due_date": "1/11/2023"
}
```

##### Response
```
{
    "id": 1,
    "title": "Todo 1",
    "description": "Todo 1 description",
    "category_id": 1,
    "due_date": "2023-11-01",
    "user_id": 1,
    "updated_at": "2023-09-11T11:32:37.000000Z",
    "created_at": "2023-09-11T11:32:37.000000Z"
}
```

#### 2. Update Todo
##### Request
`PUT /api/todo/{id}`
##### Body
```
{
    "title": "Todo 1",
    "description": "Todo 1 description",
    "category_id": 1,
    "due_date": "1/11/2023"
}
```

##### Response
```
{
    "id": 1,
    "title": "Todo 1",
    "description": "Todo 1 description",
    "category_id": 1,
    "due_date": "2023-11-01",
    "user_id": 1,
    "updated_at": "2023-09-11T11:32:37.000000Z",
    "created_at": "2023-09-11T11:32:37.000000Z"
}
```

#### 3. Delete Todo
##### Request
`DELETE /api/todo/{id}`
##### Response
```
{
    "message": "Todo deleted successfully"
}
```

#### 4. Get List of Todo
##### Request
`GET /api/todo/`
##### Response
```
    [
        {
            "id": 1,
            "title": "Todo 1",
            "description": "Todo 1 description",
            "category_id": 1,
            "due_date": "2023-11-01",
            "user_id": 1,
            "updated_at": "2023-09-11T11:32:37.000000Z",
            "created_at": "2023-09-11T11:32:37.000000Z"
        }
    ]
```
