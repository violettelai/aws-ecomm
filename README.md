## Simple Web App – AWS eCommerce Project (Monolithic Phase)

This repository contains a sample basic web application intended to be deployed on a **single Amazon EC2 instance**. This forms the first phase of a broader eCommerce project that will later transition into a distributed cloud architecture.

This project is for educational purpose only.

## Project Overview

- 🔹 Monolithic architecture hosted on a single EC2 instance
- 🔹 Static website with interactive asset information
- 🔹 Will be scaled and refactored in future phases into a microservices-based system

## Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Web Server**: Apache or Nginx (running on EC2)  
- **Cloud Platform**: AWS (Amazon Web Services)

## How to Deploy on Amazon EC2

1. **Launch an EC2 instance** (Amazon Linux or Ubuntu)
2. **Install a web server** (e.g., Apache):
   ```
   # For Amazon Linux
   sudo yum update -y
   sudo yum install httpd -y
   sudo systemctl start httpd
   sudo systemctl enable httpd
   ```
3. **Clone this repository to the web server directory**:
  ```
  git clone https://github.com/your-username/your-repo.git
  sudo cp -r your-repo/* /var/www/html/
  ```
4. **Access your site via the EC2 public IP**:
   ```http://<your-ec2-public-ip>```
