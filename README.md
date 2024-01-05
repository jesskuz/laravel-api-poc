### Project
A simple team, member, and project tracking API.



### Entities

**Member(s)**
- First Name (required)
- Last Name (required)
- City
- State
- Country

**Team(s)**
- Name (required)

**Project(s)**
- Name (required)



### Endpoints

✅ Create/Update/Delete/Index/Show teams
```
GET /api/teams/
GET /api/teams/{id}
POST /api/teams/{id} (include above field values)
PUT /api/teams/{id} (update any of the above field values)
DELETE /api/teams/{id}
``````

✅ Create/Update/Delete/Index/Show members
```
GET /api/members/
GET /api/members/{id}
POST /api/members/{id} (include above field values)
PUT /api/members/{id} (update any of the above field values)
DELETE /api/members/{id}
```

✅ Create/Update/Delete/Index/Show projects
```
GET /api/projects/
GET /api/projects/{id}
POST /api/projects/{id} (include above field values)
PUT /api/projects/{id} (update any of the above field values)
DELETE /api/projects/{id}
```

✅ Update the team of a member
```
PUT /api/members/{id}/update-team

param - 
    int `team_id`
```

✅ Get the members of a specific team
```
GET /api/teams/{id}/get-members
```

✅ Get the members of a specific project
```
GET /api/projects/{id}/get-members
```

✅ Add a member to a project
```
PUT /api/projects/{id}/add-member

param - 
    int `member_id`
```

✅ Remove a member from a project
```
PUT /api/projects/{id}/remove-member

param - 
    int `member_id`
```
#### Unit Tests

A suite of 20 Pest-based unit tests has been added ...

![image](https://github.com/jesskuz/laravel-projects-api-poc/assets/2702323/5351fa5b-7270-4efa-b0ae-9262bba201b7)

#### Notes


Applicable modifications are made primarily in the following folders:

```
/routes/api.php
/app/Models
/app/Http
/database/factories
/database/migrations
/database/seeders
/tests

```

```
prep: 
artisan migrate:fresh --seed
```

