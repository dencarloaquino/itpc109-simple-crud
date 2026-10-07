# ITPC 109 Simple CRUD Application

## Project Description

A simple Student Records Management web application built using PHP and MySQL. It demonstrates Create, Read, Update, and Delete (CRUD) operations using Docker for the web server and database environment.

## Technologies

- PHP
- MySQL
- Apache
- Docker
- Git / GitHub

## Run the Application

Start the Docker containers:

```bash
docker compose up -d --build

Application

http://localhost:8080

phpMyAdmin

http://localhost:8081

phpMyAdmin Login
Server: db
Username: student_user
Password: student_pass
Stop the Containers
docker compose down
Project Structure
itpc109-simple-crud/
├── docker/
│   └── php/
│       └── Dockerfile
├── src/
│   ├── index.php
│   ├── db.php
│   ├── create.php
│   ├── edit.php
│   ├── update.php
│   └── delete.php
├── db/
│   └── init.sql
├── compose.yaml
├── .gitignore
└── README.md

### Important

The activity's required README specifically asks it to explain:

- what the app does
- technologies used
- how to start Docker
- application URL
- phpMyAdmin URL
- how to stop the containers. :contentReference[oaicite:0]{index=0}

### Step 2 — Save and push the README

In PowerShell:

```powershell
cd C:\itpc109-simple-crud