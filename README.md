
## Installation: Please download the repo to your server directory, then run

```bash
php artisan migrate:fresh --seed
```

## cURL commands for project

### CREATE ###
```bash
curl -X POST -H 'Content-Type: application/json' -d '{ "user_id": "1", "title" : "test title", "note": "test note"}' localhost/api/notes -i
```

### READ -- Replace the 1 with any valid ID number of a post already in the Database ###
```bash
curl localhost:8000/api/notes/1 -i
````

### UPDATE ###
```bash
curl -X PUT -H 'Content-Type: application/json' -d '{"user_id": "1","title": "Change my title","note" : "Updated Note"}' localhost/api/notes/1 -i
```

### DELETE ###
```bash
curl -X DELETE localhost/api/notes/1 -i
```