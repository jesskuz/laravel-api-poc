### Project
A simple team-to-member-to-project tracking API.



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

✅ API Endpoints to: Create/Update/Delete/Index/Show teams
```
GET /api/teams/
GET /api/teams/{id}
POST /api/teams/{id} (include above field values)
PUT /api/teams/{id} (update any of the above field values)
DELETE /api/teams/{id}
``````

✅ API Endpoints to: Create/Update/Delete/Index/Show members
```
GET /api/members/
GET /api/members/{id}
POST /api/members/{id} (include above field values)
PUT /api/members/{id} (update any of the above field values)
DELETE /api/members/{id}
```

✅ API Endpoints to: Create/Update/Delete/Index/Show projects
```
GET /api/projects/
GET /api/projects/{id}
POST /api/projects/{id} (include above field values)
PUT /api/projects/{id} (update any of the above field values)
DELETE /api/projects/{id}
```

✅ API Endpoint to: Update the team of a member
```
PUT /api/members/{id}/update-team

param - 
    int `team_id`
```

✅ API Endpoint to: Get the members of a specific team
```
GET /api/teams/{id}/get-members
```

✅ API Endpoint to: Get the members of a specific project
```
GET /api/projects/{id}/get-members
```

✅ API Endpoint to: Add a member to a project
```
PUT /api/projects/{id}/add-member

param - 
    int `member_id`
```

✅ API Endpoint to: Remove a member from a project
```
PUT /api/projects/{id}/remove-member

param - 
    int `member_id`
```

####Notes####


```
prep: 
artisan migrate:fresh --seed
```

