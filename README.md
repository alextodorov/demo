# demo
A simple demo project

##Installation Instructions

 1. ```git clone https://github.com/alextodorov/demo.git```
 2. ```cd demo```
 3. ```composer install```
 
 ##Run
 
 1. ```php -S localhost:8080 -t public/```
 
 ###Requests
 1. Get access token:
 ```curl -X POST http://localhost:8080/get-token -i -H 'Content-type: application/json' -H 'Authorization: Bearer c2VjcmV0X3VzZXI6JnNkam8x'```
 
 2. Make request:
 ```curl -X POST http://localhost:8080/ -i -H 'Content-type: application/json' -H 'Authorization: Bearer yourToken'  -d '{"0":"ZA", "1":"ZA"}'```
 