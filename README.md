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
cd pathtestcase/
make init sonra make up
veya
docker-compose up -d
```
> Docker containerlarımızı hazır hale getiriyoruz.
> - Laravel sanal web sunucumuz 9000 üzerinden yayın yapıyor.
> - Mysql veritabanı sunucumuz 3306 üzerinden yayın yapıyor.

### 3. Migration

Docker containerlarımız çalışınca artık laravel için veritabanını hazır hale getiriyoruz.

```
composer update
sudo docker-compose exec php sh php artisan migrate
sudo docker-compose exec php sh php artisan passport:install
```

> Migration ile tüm tablolar oluşturuluyor, "posts" , "verifies","user" ve jwt auth diğer tablolar için örnek dataları veritabanına ekliyor.


## RESTful Api

### 1. Sipariş Tümünü Listeleme

| Tip | Değer |
| --- | --- |
| Method | GET |
| Route | /api/order/lists |

##### Örnek Curl İsteği
```
curl --location --request GET 'http://127.0.0.1:8022/api/order/lists' \
--header 'Content-Type: application/json'
```

### 2. Sipariş Görüntüleme

| Tip | Değer |
| --- | --- |
| Method | GET |
| Route | /api/order/{orderId} |

##### Örnek Curl İsteği
```
curl --location --request GET 'http://127.0.0.1:8022/api/order/1' \
--header 'Content-Type: application/json'
```

### 3. Sipariş Ekleme

> Not: Ürünlerden stok bilgisini ekler.

| Tip | Değer |
| --- | --- |
| Method | POST |
| Route | /api/order |

##### Örnek Curl İsteği
```
curl --location --request POST 'http://127.0.0.1:8022/api/order' \
--header 'Authorization: Bearer 2343242' \
--form 'order_code="12345"' \
--form 'product_id="345345"' \
--form 'quantity="2"' \
--form 'address="Deneme Adres1"'
```

### 4. Sipariş Silme

> Not: Ürünlerden stok bilgisini siler.

| Tip | Değer |
| --- | --- |
| Method | DELETE |
| Route | /api/order/{orderId} |

##### Örnek Curl İsteği
```
curl --location --request DELETE 'http://127.0.0.1:8022/api/order/1' \
--header 'Content-Type: application/json'
```


### 5. Sipariş Güncelleme

> Not: Ürünlerden stok bilgisini günceller.

| Tip | Değer |
| --- | --- |
| Method | PUT |
| Route | /api/order/{orderId} |

##### Örnek Curl İsteği
```
curl --location --request PUT 'http://127.0.0.1:8022/order/1' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'quantity=1' \
--data-urlencode 'address=werewr'
```

### 6. Postman Restful API Collection

> Not: PathInternet.postman_collection.json

