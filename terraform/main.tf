terraform {
  required_providers {
    docker = {
      source  = "kreuzwerker/docker"
      version = "~> 2.21.0"
    }
  }
}

provider "docker" {}

# Nginx container
resource "docker_image" "nginx" {
  name         = "nginx:latest"
  keep_locally = false
}
resource "docker_container" "nginx" {
  image = docker_image.nginx.image_id
  name  = "fit-tracker-api-nginx-container"
  ports {
    internal = 80
    external = 8080
  }
}

# MySQL container
resource "docker_image" "mysql" {
  name         = "mysql:latest"
  keep_locally = false
}
resource "docker_container" "mysql" {
  name  = "fit-tracker-api-mysql-container"
  image = docker_image.mysql.image_id
  ports {
    internal = 3306
    external = 3306
  }
  env = [
    "MYSQL_ROOT_PASSWORD=${var.mysql_root_password}",
    "MYSQL_PASSWORD=${var.mysql_password}",
    "MYSQL_USER=${var.mysql_user}",
    "MYSQL_DATABASE=${var.mysql_database}"
  ]
  volumes {
    volume_name    = docker_volume.mysql_data_volume.name
    container_path = "/var/lib/mysql"
  }
}

# MySQL Volume
resource "docker_volume" "mysql_data_volume" {
  name = "mysql_data_volume"
}
