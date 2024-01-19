# E-clearance
The e-clearance application simplifies and accelerates student clearance by providing a digital platform for streamlined submission and verification of academic, financial, and administrative requirements.

![home page](https://raw.githubusercontent.com/jaslup16/public-image/main/image_2024-01-19_140935119.png)

## POSTMAN
![postman](https://raw.githubusercontent.com/jaslup16/public-image/main/postman.png)

Using Postman, you can send a request to an endpoint, retrieve data from a data source, or test an API's functionality.

## API USAGE
```
http://localhost:8000/api/sample
```
Using the api to test if the system work and up running
### RESULT
```
{"message":"Hello World"}
```

 ## LOGIN
 ![login](https://raw.githubusercontent.com/jaslup16/public-image/main/Login.png)

API token is a unique identifier used to authenticate a user or application to access an API. This commonly used when user login it and recieve the token. 
Token was generated using JWT. 

 ## SHOW LIST OF STUDENT
 ![show](https://raw.githubusercontent.com/jaslup16/public-image/main/Show.png)

 ## UI COMPARISON
 ![ui](https://raw.githubusercontent.com/jaslup16/public-image/main/image_2024-01-19_144441928.png)

```
        {
            "email": "chanelle.koelpin@gmail.com",
            "name": "Michele Dietrich",
            "course": "BSED",
            "year": "1",
            "divisionName": "CEDAS",
            "login": "0",
            "userId": "34",
            "studentId": "18"
        },
        {
            "email": "marcus.wiegand@yahoo.com",
            "name": "Ciara Dickens",
            "course": "BSED",
            "year": "4",
            "divisionName": "CEDAS",
            "login": "0",
            "userId": "35",
            "studentId": "19"
        },
```
As you can see **Michele Dietrich** and **Ciara Dickens** are present in both api and web ui
 
