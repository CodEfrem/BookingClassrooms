# BookingClassroom platform
---

## Description


This project is a platform for booking classrooms in a BnB.

The technologies used are:

Symfony 7
Bootstrap 5
Twig
SQLite

## Entities
---

### User

This entity represents a user of the platform. The user can be a client or a admin. They are defined by the ```role``` property.

| Property       | Type      | Description          | Relationship |
|----------------|-----------|----------------------|--------------|
| name           | string    | 50 NOT NULL          |              |
| corporate_name | string    | 100 NOT NULL         |              | 
| siret          | string    | 14 NOT NULL          |              |
| email          | string    | 100 NOT NULL, UNIQUE |              | 
| password       | string    | 255 NOT NULL         |              | 
| role           | string    | 50 NOT NULL          |              |
| phone          | string    | 15                   |              |
| address        | string    | 255 NOT NULL         |              |
| city           | string    | 50 NOT NULL          |              |
| zip            | string    | 20 NOT NULL          |              |
| country        | string    | 50 NOT NULL          |              |
| consent        | bool      |                      |              |
| created_at     | datetime  | NOT NULL             |              |
| updated_at     | datetime  |                      |              |
| 

---

### Classroom

This entity represents a classroom for rent.

| Property    | Type       | Description          | Relationship |
|-------------|------------|----------------------|--------------|
| name        | string     | 50 NOT NULL, UNIQUE  |              | 
| description | text       | NOT NULL             |              | 
| address     | string     | 255 NOT NULL         |              |
| city        | string     | 50 NOT NULL          |              |
| zip         | string     | 20 NOT NULL          |              |
| country     | string     | 50 NOT NULL          |              |
| gauge       | integer    | NOT NULL             |              |
| floor       | integer    | NOT NULL             |              |
| parking     | bool       |                      |              |
| price       | float      | NOT NULL             |              | 
| status      | bool       | NOT NULL             |              |
| image       | string     | 255                  |              |
| admin       | ManyToOne  | NOT NULL, OrphanTrue | User         |
| equipments  | ManyToMany | NOT NULL,            | Equipment    |
| created_at  | datetime   | NOT NULL             |              |
| updated_at  | datetime   |                      |              |

---

### Booking

This entity represents a booking made by client for a classroom.

| Property   | Type      | Description      | Relationship |
|------------|-----------|------------------|--------------|
| number     | string    | 50 NOT NULL      |              | 
| start_date | datetime  | NOT NULL         |              | 
| end_date   | datetime  | NOT NULL         |              | 
| amount     | float     | NOT NULL         |              |
| status     | bool      | NOT NULL         |              | 
| client     | ManyToOne | NULL, OrphanTrue | User         | 
| classroom  | ManyToOne | NULL, OrphanTrue | Classroom    |
| created_at | datetime  | NOT NULL         |              | 
| updated_at | datetime  |                  |              |

---

### Equipment

This entity represents the equipment for a classroom.

| Property   | Type       | Description          | Relationship |
|------------|------------|----------------------|--------------|
| option     | bool       | NOT NULL             |              | 
| admin      | ManyToOne  | NOT NULL, OrphanTrue |              |
| classrooms | ManyToMany | NOT NULL             | Classroom    | 
| created_at | datetime   | NOT NULL             |              |
| updated_at | datetime   |                      |              |

---

### Customer

This entity represents the customer who will use the classroom.

| Property   | Type      | Description | Relationship |
|------------|-----------|-------------|--------------|
| effective  | int       | NOT NULL    |              | 
| booking    | ManyToOne |             | Booking      | 
| created_at | datetime  | NOT NULL    |              | 

## Pages architecture

-- paris, kyoto, las vegas, sydney, hong kong -- all rooms -- room -- booking -- payment -- login -- register -- account
-- my rooms -- new room -- edit room -- my bookings -- booking -- my reviews -- review