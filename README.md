# BookingClassroom platform
---

## Description


This project is a platform BtoB for booking classrooms.

The technologies used are:

Symfony 7
Bootstrap 5
Twig
SQLite

The packages used are : 

Dashboard Easyadmin
Fixtures FakerPHP


## Entities
---

### User

This entity represents a user of the platform. The user can be a client or a admin. They are defined by the ```role``` property.

| Property       | Type      | Description          | Relationship |
|----------------|-----------|----------------------|--------------|
| name           | string    | 50                   |              |
| corporateName  | string    | 100                  |              | 
| siret          | string    | 14                   |              |
| email          | string    | 100 NOT NULL, UNIQUE |              | 
| password       | string    | 255 NOT NULL         |              | 
| role           | string    | 50 NOT NULL          |              |
| phone          | string    | 15                   |              |
| address        | string    | 255                  |              |
| city           | string    | 50                   |              |
| zip            | string    | 20                   |              |
| country        | string    | 50                   |              |
| consent        | bool      |                      |              |
| created_at     | datetime  |                      |              |
| updated_at     | datetime  |                      |              |
| 

---

### Classroom

This entity represents a classroom for rent.

| Property    | Type       | Description          | Relationship |
|-------------|------------|----------------------|--------------|
| name        | string     | 50 NOT NULL, UNIQUE  |              | 
| description | text       |                      |              | 
| address     | string     | 255 NOT NULL         |              |
| city        | string     | 50 NOT NULL          |              |
| zip         | string     | 20 NOT NULL          |              |
| country     | string     | 50 NOT NULL          |              |
| gauge       | integer    | NOT NULL             |              |
| floor        | string     | NOT NULL             |              |
| parking     | bool       | NOT NULL             |              |
| price       | integer    | NOT NULL             |              | 
| status      | bool       | NOT NULL             |              |
| image       | string     | 255                  |              |
| admin       | ManyToOne  | NOT NULL, OrphanTrue | User         |
| equipments  | ManyToMany | NOT NULL,            | Equipment    |

---

### Booking

This entity represents a booking made by client for a classroom.

| Property   | Type      | Description          | Relationship |
|------------|-----------|----------------------|--------------|
| number     | string    | 50 NOT NULL          |              | 
| start_date | datetime  | NOT NULL             |              | 
| end_date   | datetime  | NOT NULL             |              | 
| amount     | integer   | NOT NULL             |              |
| status     | bool      | NOT NULL             |              | 
| client     | ManyToOne | NOT NULL, OrphanTrue | User         | 
| classroom  | ManyToOne | NOT NULL, OrphanTrue | Classroom    |
| created_at | datetime  | NOT NULL             |              | 
| updated_at | datetime  |                      |              |

---

### Equipment

This entity represents the equipment for a classroom.

| Property   | Type       | Description          | Relationship |
|------------|------------|----------------------|--------------|
| option     | string     | 50 NOT NULL          |              | 
| admin      | ManyToOne  | NOT NULL, OrphanTrue | User         |
| classrooms | ManyToMany | NOT NULL             | Classroom    | 
| created_at | datetime   | NOT NULL             |              |
| updated_at | datetime   |                      |              |

---

### Software

This entity represents the software for a classroom.

| Property     | Type      | Description  | Relationship |
|--------------|-----------|--------------|--------------|
| softwareName | string    | 255 NOT NULL |              | 
| version      | string    | 255          |              |
| description  | text      |              |              | 
| year         | integer   |              |              |
| equipment    | ManyToOne | NOT NULL     | Equipment    |

---

### Customer

This entity represents the customer who will use the classroom.

| Property   | Type      | Description | Relationship |
|------------|-----------|-------------|--------------|
| effective  | integer   | NOT NULL    |              | 
| booking    | ManyToOne |             | Booking      | 
| created_at | datetime  | NOT NULL    |              | 

## Pages architecture

all classrooms -- classroom -- booking -- login -- register -- account
my classrooms -- new classroom -- edit classroom -- my bookings -- booking