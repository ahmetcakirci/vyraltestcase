# vyraltestcase
Vyral test case

Bir sosyal feeder  RESTful Api servisidir.

## Docker

- Php: 7.4.20-fpm
- Mysql: 8.0.27

## Kurulum

### 1. İndirme

Repoyu vyraltestcase isimli klasöre klonluyoruz.

```
git clone https://github.com/ahmetcakirci/vyraltestcase.git VyralTesttCase
```

### 2. Docker

Eğer docker yoksa; https://docs.docker.com/ adresinden docker için gerekli kurulumları yapabilirsiniz.

```
cd vyraltestcase/
composer install
sudo make init
veya
sudo docker-compose up -d
```
> Docker containerlarımızı hazır hale getiriyoruz.
> - Laravel sanal web sunucumuz 9000 üzerinden yayın yapıyor.
> - Mysql veritabanı sunucumuz 3306 üzerinden yayın yapıyor.

### 3. Migration

Docker containerlarımız çalışınca artık laravel için veritabanını hazır hale getiriyoruz.

```
sudo docker-compose exec php sh php artisan migrate
sudo docker-compose exec php sh php artisan passport:install
```

> Migration ile tüm tablolar oluşturuluyor, "posts" , "verifies","user" ve jwt auth diğer tablolar için örnek dataları veritabanına ekliyor.


## RESTful Api

### 1. Register

| Tip | Değer         |
| --- |---------------|
| Method | POST          |
| Route | /api/register |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/register' \
--form 'name="ahmet"' \
--form 'email="asdw@asd.com"' \
--form 'password="aasdasda"' \
--form 'twitter="sadsadsdsa"' \
--form 'surname="eewr"' \
--form 'cep_number="5343242333"'
```

### 2. Login

| Tip | Değer      |
| --- |------------|
| Method | POST       |
| Route | /api/login |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/login' \
--form 'email="asdw@asd.com"' \
--form 'password="aasdasda"'
```

### 3. SMS Doğrulama

> Not: SMS Doğrumala işlemi yapan endpoint

| Tip | Değer |
| --- | --- |
| Method | POST |
| Route | /api/sms_verify |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/sms_verify' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTliYzNlZi1lMWI5LTQ5NmYtYjlmYy1hY2ZjMjg3ZTExMjEiLCJqdGkiOiIxN2JjNGUzM2RiZmVmMDE4M2VkYjFmNjBmNjA4NGU4YjQyNzFhYTc0Yzg0MTZjMjI0MDI2NGUzZmEyNDM4MDZhMDEzNDM3ZjkxMTA1NmExMSIsImlhdCI6MTY0NTAxNDUzMy4zNTc1ODksIm5iZiI6MTY0NTAxNDUzMy4zNTc1OTMsImV4cCI6MTY3NjU1MDUzMy4zNTEwMDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.EM4jwJYh7g3hLG4vwKJt9oMDMEKqJ4AkIB7PdmGkO8BVU3icS-RAkhDTpJ-RWo8-0W5HBRibgjuUEy4a5Ga43pzoJzPs5V_XxT_QBXidO4QIaZs65ungUcHUdtnMFezOINn4OSPPRVvLZ8dvmav2xiDbzBo3moxbE2gl9LMUbgX74Fvvv75XzTOokyZgNT08CgX_pkFDkUH8iPSEBRaoqnt0OyDJX51ipXYerwWdQBbdqWCuURKeMCwwDDgogLghlwmeWV6xLA5fA-h5bAqEXKrPh6ssUedzJVVlzZxvdbyzViyIu99-S4rTVr4UXx6JvzdAWOW-WAV5bQj_hycUSP4CqF68q2SEQI4s-oo_H-hQn5H83v21nm1w7MhGC7Ac0egIbkJvPSejPGJWS6kaIRifNjL4OF7CuH6sQ6s_nyANe44bVLejTA44oEnnne3p1xH9R8kjJ_go7AKtXTP3Rg9sNbZ2aspzHfq1B7i-c_cWFXqsKoVvY382Np-jv41GV_0sgAd-GGbB8hlevZci60cD74Q7UkRj9ldH9arrZuo_z_bvWPIlyyONwdH_qsY1coL7P6poixqz-8wudbU0ylj4ZGlae4YCHDqcJ6n-I2W6lo2t7P6uIVfG4txzDZ9MJNm2GJ_gXHHiL3d3CaE7lDRMTi9R_NmYwTXJb0PyQqs' \
--header 'Accept: application/json' \
--form 'verify_code="JHP3459K"'
```

### 4. SMS Doğrulama Kod Gönderim
> Not: SMS doğrulama için kod gönderimi yapan endpoint

| Tip | Değer         |
| --- |---------------|
| Method | POST          |
| Route | /api/sms_send |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/sms_send' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTliYzNlZi1lMWI5LTQ5NmYtYjlmYy1hY2ZjMjg3ZTExMjEiLCJqdGkiOiIxN2JjNGUzM2RiZmVmMDE4M2VkYjFmNjBmNjA4NGU4YjQyNzFhYTc0Yzg0MTZjMjI0MDI2NGUzZmEyNDM4MDZhMDEzNDM3ZjkxMTA1NmExMSIsImlhdCI6MTY0NTAxNDUzMy4zNTc1ODksIm5iZiI6MTY0NTAxNDUzMy4zNTc1OTMsImV4cCI6MTY3NjU1MDUzMy4zNTEwMDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.EM4jwJYh7g3hLG4vwKJt9oMDMEKqJ4AkIB7PdmGkO8BVU3icS-RAkhDTpJ-RWo8-0W5HBRibgjuUEy4a5Ga43pzoJzPs5V_XxT_QBXidO4QIaZs65ungUcHUdtnMFezOINn4OSPPRVvLZ8dvmav2xiDbzBo3moxbE2gl9LMUbgX74Fvvv75XzTOokyZgNT08CgX_pkFDkUH8iPSEBRaoqnt0OyDJX51ipXYerwWdQBbdqWCuURKeMCwwDDgogLghlwmeWV6xLA5fA-h5bAqEXKrPh6ssUedzJVVlzZxvdbyzViyIu99-S4rTVr4UXx6JvzdAWOW-WAV5bQj_hycUSP4CqF68q2SEQI4s-oo_H-hQn5H83v21nm1w7MhGC7Ac0egIbkJvPSejPGJWS6kaIRifNjL4OF7CuH6sQ6s_nyANe44bVLejTA44oEnnne3p1xH9R8kjJ_go7AKtXTP3Rg9sNbZ2aspzHfq1B7i-c_cWFXqsKoVvY382Np-jv41GV_0sgAd-GGbB8hlevZci60cD74Q7UkRj9ldH9arrZuo_z_bvWPIlyyONwdH_qsY1coL7P6poixqz-8wudbU0ylj4ZGlae4YCHDqcJ6n-I2W6lo2t7P6uIVfG4txzDZ9MJNm2GJ_gXHHiL3d3CaE7lDRMTi9R_NmYwTXJb0PyQqs' \
--header 'Accept: application/json'
```

### 5. EMail Doğrulama kod gönderim

> Not: EMail doğrulama için kod gönderimi yapan endpoint.

| Tip | Değer           |
| --- |-----------------|
| Method | POST            |
| Route | /api/email_send |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/email_send' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTliYzNlZi1lMWI5LTQ5NmYtYjlmYy1hY2ZjMjg3ZTExMjEiLCJqdGkiOiIxN2JjNGUzM2RiZmVmMDE4M2VkYjFmNjBmNjA4NGU4YjQyNzFhYTc0Yzg0MTZjMjI0MDI2NGUzZmEyNDM4MDZhMDEzNDM3ZjkxMTA1NmExMSIsImlhdCI6MTY0NTAxNDUzMy4zNTc1ODksIm5iZiI6MTY0NTAxNDUzMy4zNTc1OTMsImV4cCI6MTY3NjU1MDUzMy4zNTEwMDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.EM4jwJYh7g3hLG4vwKJt9oMDMEKqJ4AkIB7PdmGkO8BVU3icS-RAkhDTpJ-RWo8-0W5HBRibgjuUEy4a5Ga43pzoJzPs5V_XxT_QBXidO4QIaZs65ungUcHUdtnMFezOINn4OSPPRVvLZ8dvmav2xiDbzBo3moxbE2gl9LMUbgX74Fvvv75XzTOokyZgNT08CgX_pkFDkUH8iPSEBRaoqnt0OyDJX51ipXYerwWdQBbdqWCuURKeMCwwDDgogLghlwmeWV6xLA5fA-h5bAqEXKrPh6ssUedzJVVlzZxvdbyzViyIu99-S4rTVr4UXx6JvzdAWOW-WAV5bQj_hycUSP4CqF68q2SEQI4s-oo_H-hQn5H83v21nm1w7MhGC7Ac0egIbkJvPSejPGJWS6kaIRifNjL4OF7CuH6sQ6s_nyANe44bVLejTA44oEnnne3p1xH9R8kjJ_go7AKtXTP3Rg9sNbZ2aspzHfq1B7i-c_cWFXqsKoVvY382Np-jv41GV_0sgAd-GGbB8hlevZci60cD74Q7UkRj9ldH9arrZuo_z_bvWPIlyyONwdH_qsY1coL7P6poixqz-8wudbU0ylj4ZGlae4YCHDqcJ6n-I2W6lo2t7P6uIVfG4txzDZ9MJNm2GJ_gXHHiL3d3CaE7lDRMTi9R_NmYwTXJb0PyQqs' \
--header 'Accept: application/json'
```

### 6. EMail Doğrulama 
> Not: EMail doğrulama  yapan endpoint.

| Tip | Değer             |
| --- |-------------------|
| Method | POST              |
| Route | /api/email_verify |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/email_verify' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTliYzNlZi1lMWI5LTQ5NmYtYjlmYy1hY2ZjMjg3ZTExMjEiLCJqdGkiOiIxN2JjNGUzM2RiZmVmMDE4M2VkYjFmNjBmNjA4NGU4YjQyNzFhYTc0Yzg0MTZjMjI0MDI2NGUzZmEyNDM4MDZhMDEzNDM3ZjkxMTA1NmExMSIsImlhdCI6MTY0NTAxNDUzMy4zNTc1ODksIm5iZiI6MTY0NTAxNDUzMy4zNTc1OTMsImV4cCI6MTY3NjU1MDUzMy4zNTEwMDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.EM4jwJYh7g3hLG4vwKJt9oMDMEKqJ4AkIB7PdmGkO8BVU3icS-RAkhDTpJ-RWo8-0W5HBRibgjuUEy4a5Ga43pzoJzPs5V_XxT_QBXidO4QIaZs65ungUcHUdtnMFezOINn4OSPPRVvLZ8dvmav2xiDbzBo3moxbE2gl9LMUbgX74Fvvv75XzTOokyZgNT08CgX_pkFDkUH8iPSEBRaoqnt0OyDJX51ipXYerwWdQBbdqWCuURKeMCwwDDgogLghlwmeWV6xLA5fA-h5bAqEXKrPh6ssUedzJVVlzZxvdbyzViyIu99-S4rTVr4UXx6JvzdAWOW-WAV5bQj_hycUSP4CqF68q2SEQI4s-oo_H-hQn5H83v21nm1w7MhGC7Ac0egIbkJvPSejPGJWS6kaIRifNjL4OF7CuH6sQ6s_nyANe44bVLejTA44oEnnne3p1xH9R8kjJ_go7AKtXTP3Rg9sNbZ2aspzHfq1B7i-c_cWFXqsKoVvY382Np-jv41GV_0sgAd-GGbB8hlevZci60cD74Q7UkRj9ldH9arrZuo_z_bvWPIlyyONwdH_qsY1coL7P6poixqz-8wudbU0ylj4ZGlae4YCHDqcJ6n-I2W6lo2t7P6uIVfG4txzDZ9MJNm2GJ_gXHHiL3d3CaE7lDRMTi9R_NmYwTXJb0PyQqs' \
--header 'Accept: application/json' \
--form 'verify_code="CBO96ZHJ"'
```
### 7. Twitter kullanıcı feed okuma
> Not: İlgili user idli userin twitter feedlerini okur endpoint.

| Tip | Değer             |
| --- |-------------------|
| Method | POST              |
| Route | /api/post_read |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/post_read' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTliYzNlZi1lMWI5LTQ5NmYtYjlmYy1hY2ZjMjg3ZTExMjEiLCJqdGkiOiIxN2JjNGUzM2RiZmVmMDE4M2VkYjFmNjBmNjA4NGU4YjQyNzFhYTc0Yzg0MTZjMjI0MDI2NGUzZmEyNDM4MDZhMDEzNDM3ZjkxMTA1NmExMSIsImlhdCI6MTY0NTAxNDUzMy4zNTc1ODksIm5iZiI6MTY0NTAxNDUzMy4zNTc1OTMsImV4cCI6MTY3NjU1MDUzMy4zNTEwMDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.EM4jwJYh7g3hLG4vwKJt9oMDMEKqJ4AkIB7PdmGkO8BVU3icS-RAkhDTpJ-RWo8-0W5HBRibgjuUEy4a5Ga43pzoJzPs5V_XxT_QBXidO4QIaZs65ungUcHUdtnMFezOINn4OSPPRVvLZ8dvmav2xiDbzBo3moxbE2gl9LMUbgX74Fvvv75XzTOokyZgNT08CgX_pkFDkUH8iPSEBRaoqnt0OyDJX51ipXYerwWdQBbdqWCuURKeMCwwDDgogLghlwmeWV6xLA5fA-h5bAqEXKrPh6ssUedzJVVlzZxvdbyzViyIu99-S4rTVr4UXx6JvzdAWOW-WAV5bQj_hycUSP4CqF68q2SEQI4s-oo_H-hQn5H83v21nm1w7MhGC7Ac0egIbkJvPSejPGJWS6kaIRifNjL4OF7CuH6sQ6s_nyANe44bVLejTA44oEnnne3p1xH9R8kjJ_go7AKtXTP3Rg9sNbZ2aspzHfq1B7i-c_cWFXqsKoVvY382Np-jv41GV_0sgAd-GGbB8hlevZci60cD74Q7UkRj9ldH9arrZuo_z_bvWPIlyyONwdH_qsY1coL7P6poixqz-8wudbU0ylj4ZGlae4YCHDqcJ6n-I2W6lo2t7P6uIVfG4txzDZ9MJNm2GJ_gXHHiL3d3CaE7lDRMTi9R_NmYwTXJb0PyQqs' \
--form 'user_id="1"'
```

### 8. Tüm kullanıcıların feedlerini okur
> Not: Tüm userların twitter feedlerini okur endpoint.

| Tip | Değer             |
| --- |-------------------|
| Method | POST              |
| Route | /api/post_read_all |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:9000/api/post_read_all' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTliYzNlZi1lMWI5LTQ5NmYtYjlmYy1hY2ZjMjg3ZTExMjEiLCJqdGkiOiIxN2JjNGUzM2RiZmVmMDE4M2VkYjFmNjBmNjA4NGU4YjQyNzFhYTc0Yzg0MTZjMjI0MDI2NGUzZmEyNDM4MDZhMDEzNDM3ZjkxMTA1NmExMSIsImlhdCI6MTY0NTAxNDUzMy4zNTc1ODksIm5iZiI6MTY0NTAxNDUzMy4zNTc1OTMsImV4cCI6MTY3NjU1MDUzMy4zNTEwMDgsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.EM4jwJYh7g3hLG4vwKJt9oMDMEKqJ4AkIB7PdmGkO8BVU3icS-RAkhDTpJ-RWo8-0W5HBRibgjuUEy4a5Ga43pzoJzPs5V_XxT_QBXidO4QIaZs65ungUcHUdtnMFezOINn4OSPPRVvLZ8dvmav2xiDbzBo3moxbE2gl9LMUbgX74Fvvv75XzTOokyZgNT08CgX_pkFDkUH8iPSEBRaoqnt0OyDJX51ipXYerwWdQBbdqWCuURKeMCwwDDgogLghlwmeWV6xLA5fA-h5bAqEXKrPh6ssUedzJVVlzZxvdbyzViyIu99-S4rTVr4UXx6JvzdAWOW-WAV5bQj_hycUSP4CqF68q2SEQI4s-oo_H-hQn5H83v21nm1w7MhGC7Ac0egIbkJvPSejPGJWS6kaIRifNjL4OF7CuH6sQ6s_nyANe44bVLejTA44oEnnne3p1xH9R8kjJ_go7AKtXTP3Rg9sNbZ2aspzHfq1B7i-c_cWFXqsKoVvY382Np-jv41GV_0sgAd-GGbB8hlevZci60cD74Q7UkRj9ldH9arrZuo_z_bvWPIlyyONwdH_qsY1coL7P6poixqz-8wudbU0ylj4ZGlae4YCHDqcJ6n-I2W6lo2t7P6uIVfG4txzDZ9MJNm2GJ_gXHHiL3d3CaE7lDRMTi9R_NmYwTXJb0PyQqs'
```

### 9. Fake Twitter Mock API 
> Not: Twitter simule etmek için Nodejs ile oluşturulmuştur endpoint.

| Tip    | Değer                       |
|--------|-----------------------------|
| URL    | http://127.0.0.1:3000/posts |
| Method | GET                         |
| Route  | /api/post_read_all          |

##### Örnek Curl İsteği
```
curl --location --request GET 'http://localhost:3000/posts'
```

### 9. Postman Restful API Collection

> Not: Vyral.postman_collection.json

