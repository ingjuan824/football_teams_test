<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Desarrollo de la prueba de registro y clasificación de equipo
La prueba se desarrollo en base a la imagen proporcionada por el entrevistador , tomando como base la tecnologia laravel y su motor de plantillas blade.

![Inkedimagen_prueba_LI](https://user-images.githubusercontent.com/68650185/140445062-d871ad5f-9b1f-4521-b6fa-83d70d50290d.jpg)

## Modelo entidad relación propuesto
![football_teams_mer](https://user-images.githubusercontent.com/68650185/140444769-c03b31c8-4b6d-45eb-b71d-610bc6ef5b71.png)

## Clonar el repositorio
$ git clone https://github.com/ingjuan824/football_teams_test.git


## Instalación de dependencias
$ composer install

## Correr migraciones
Crear la respectiva base de datos con el motor MySql, configurarlo en las variables de entorno en el arhivo .env
y ejecutar el siguiente comando
$ php artisan migrate

## Ejecutar seeders incluyendo los factories
Nota : El proyecto genera por defecto 5 equipos con nombres aleatorios haciendo uso de los factories
$ php artisan db:seed

## Generar el secret key del proyecto 
$ php artisan key:generate

## Iniciando el servidor 
$ php artisan serve

## Ruta principal
http://127.0.0.1:8000/

## Screenshots
![image](https://user-images.githubusercontent.com/68650185/140445573-0ac8b844-b9e6-408c-9f7e-eca06312ad45.png)

![image](https://user-images.githubusercontent.com/68650185/140445774-e50f7177-5161-49f1-9c2a-e66079eb0c5d.png)

![image](https://user-images.githubusercontent.com/68650185/140445798-6762e43d-c848-423a-b5e4-7e02204324a2.png)

![image](https://user-images.githubusercontent.com/68650185/140445821-35473e2b-5762-4e37-a9f0-7c8ce6db1fbf.png)


## Gracias por su revisión!
