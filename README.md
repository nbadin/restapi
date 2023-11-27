## Гайд

Ниже вы найдете примеры с использованием Curl, но вы можете использовать это api с другой технологией.

## Пользователи

### Получение списка пользователей
```shell
curl --location --request GET 'http://localhost/api/users'
```

_Вывод_
```json
{
  "data": [
    {
      "id": 1,
      "firstname": "Bill",
      "lastname": "Doe",
      "phone_number": "+79998887761",
      "avatar": null
    },
    {
      "id": 2,
      "firstname": "Antone",
      "lastname": "Windler",
      "phone_number": "+71820378265",
      "avatar": null
    }
  ]
}
```

### Получение пользователя 
```shell
curl --location --request GET 'http://localhost/api/users/2'
```

_Вывод_
```json
{
  "data": {
    "id": 2,
    "firstname": "Antone",
    "lastname": "Windler",
    "phone_number": "+71820378265",
    "avatar": null
  }
}
```

### Создание пользователя
_При создании пользователя используйте form-data для загрузки аватара_

##### Требования к полям
1. firstname: string, min:3, max:39, required
2. lastname: string, min:3, max:39, required
3. phone_number: string, format '+7XXXXXXXXXX', unique, required
4. avatar: image, mimes:jpg or png, maxsize: 2mb

```shell
curl --location --request POST 'http://localhost/api/users' \
--header 'Accept: application/json' \
--form 'firstname="John"' \
--form 'lastname="Doe"' \
--form 'phone_number="+79998885522"' \
--form 'logo=@"path/to/avatar.png"'
```

_Вывод_
```json
{
  "data": {
    "id": 38,
    "firstname": "John",
    "lastname": "Doe",
    "phone_number": "+79998885522",
    "avatar": "http://localhost/storage/user/avatar/Jivw6ln97KQteNYHvAxErCEYPZRVvox3P5myECTZ.png"
  }
}
```

__Для создания пользователя без аватара, вы можете передать данные в формате json__

```shell
curl --location --request POST 'http://localhost/api/users' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "firstname": "John",
    "lastname": "Doe",
    "phone_number": "+79992223311"
}'
```

_Вывод_
```json
{
  "data": {
    "id": 39,
    "firstname": "John",
    "lastname": "Doe",
    "phone_number": "+79992223311",
    "avatar": null
  }
}
```

### Обновление пользователя
*Используйте метод POST и передачу аргумента _method="PUT"*

```shell
curl --location --request POST 'http://localhost/api/users/39' \
--header 'Accept: application/json' \
--form 'firstname="\"Bill\""' \
--form 'avatar=@"/path/to/avatar.png"' \
--form '_method="PUT"'
```

_Вывод_
```json
{
  "data": {
    "id": 39,
    "firstname": "Bill",
    "lastname": "Doe",
    "phone_number": "+79992223311",
    "avatar": "http://localhost/storage/user/avatar/9i1fIYaPYcoBFI2P4OllcZywWNXlEMre0E68W6fo.png"
  }
}
```

### Удаление пользователя
```shell
curl --location --request DELETE 'http://localhost/api/users/39'
```


## Компании

### Получение списка компаний
```shell
curl --location --request GET 'http://localhost/api/companies'
```

_Вывод_
```json
{
  "data": [
    {
      "id": 1,
      "name": "Gutkowski-Padberg",
      "description": "Dolorum perferendis laboriosam suscipit nemo reprehenderit.",
      "logo": null
    },
    {
      "id": 4,
      "name": "Moore-Torphy",
      "description": "Blanditiis itaque officiis deserunt consectetur aut consequatur.",
      "logo": "company/logo/92Xf4Ew3KpMh377pzeHWAcg6JNqiYCDFcAicSar8.png"
    }
  ]
}
```

### Получение компании
```shell
curl --location --request GET 'http://localhost/api/companies/1'
```

_Вывод_
```json
{
  "data": {
    "id": 12,
    "name": "Gutkowski-Padberg",
    "description": "Libero eveniet quis nobis labore ipsum.",
    "logo": "company/logo/m3PrbBnOewBxRaDHPimiA5gXCo9DotWQBFV41c0O.png"
  }
}
```

### Получение комментариев о компании
```shell
curl --location --request GET 'http://localhost/api/companies/4/comments'
```

_Вывод_
```json
{
  "data": [
    {
      "id": 5,
      "user_id": 10,
      "company_id": 4,
      "message": "Error rerum deserunt harum voluptatem veniam ex.",
      "grade": 3
    },
    {
      "id": 37,
      "user_id": 3,
      "company_id": 4,
      "message": "Cumque fuga saepe aliquid accusamus libero.",
      "grade": 5
    }
  ]
}
```

### Получение рейтинга компании
```shell
curl --location --request GET 'http://localhost/api/companies/1/grade'
```

_Вывод_
```json
{
    "data": {
        "grade": 7.4
    }
}
```

### Получение top 10 компаний по рейтингу
```shell
curl --location --request GET 'http://localhost/api/companies/top'
```

```json
{
  "data": [
    {
      "id": 6,
      "name": "Wilkinson, Bernhard and Kerluke",
      "description": "Voluptatem sit corrupti recusandae omnis vel quos.",
      "logo": null
    },
    {
      "id": 9,
      "name": "Beier-Predovic",
      "description": "Et quo qui qui ut in ex vitae modi.",
      "logo": null
    },
    ...  
  ]
}
```

### Создание компании
_При создании компании используйте form-data для загрузки лого_

##### Требования к полям
1. name: string, min:3, max:39, required
2. description: string, min:150, max:400, required
3. logo: image, mimes:png, maxsize: 3mb


```shell
curl --location --request POST 'http://localhost/api/companies' \
--header 'Accept: application/json' \
--form 'name="Apple"' \
--form 'logo=@"/path/to/logo.png"' \
--form 'description="Lorem ipsum dolor sit amet..."'
```

_Вывод_
```json
{
  "data": {
    "id": 34,
    "name": "Apple",
    "description": "Lorem ipsum dolor sit amet...",
    "logo": "http://localhost/storage/company/logo/yi9CO2fyIRtT4Pp7vSI5oqRE68PJG26SepDxhrrf.png"
  }
}
```

__Для создания компании без лого, вы можете передать данные в формате json__

```shell
curl --location --request POST 'http://localhost/api/companies' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "name": "Microsoft",
    "description": "Lorem ipsum dolor sit amet..."
}'
```

_Вывод_
```json
{
  "data": {
    "id": 35,
    "name": "Microsoft",
    "description": "Lorem ipsum dolor sit amet...",
    "logo": null
  }
}
```

### Обновление компании

*Используйте метод POST и передачу аргумента _method="PUT"*

```shell
curl --location --request POST 'http://localhost/api/companies/4' \
--header 'Accept: application/json' \
--form 'name="Samsung"' \
--form 'logo=@"/path/to/logo.png"' \
--form '_method="put"'
```

_Вывод_
```json
{
  "data": {
    "id": 39,
    "firstname": "Bill",
    "lastname": "Doe",
    "phone_number": "+79992223311",
    "avatar": "http://localhost/storage/user/avatar/9i1fIYaPYcoBFI2P4OllcZywWNXlEMre0E68W6fo.png"
  }
}
```

### Удаление пользователя
```shell
curl --location --request DELETE 'http://localhost/api/companies/4'
```


## Комментарии

### Получение списка комментариев
```shell
curl --location --request GET 'http://localhost/api/comments'
```

_Вывод_
```json
{
  "data": [
    {
      "id": 1,
      "user_id": 1,
      "company_id": 8,
      "message": "Doloribus qui delectus quo qui.",
      "grade": 4
    },
    {
      "id": 2,
      "user_id": 7,
      "company_id": 6,
      "message": "Dolorem iste et ut eos.",
      "grade": 1
    }
  ]
}
```

### Получение комментария
```shell
curl --location --request GET 'http://localhost/api/comments/4'
```

_Вывод_
```json
{
  "data": {
    "id": 4,
    "user_id": 3,
    "company_id": 6,
    "message": "Asperiores ab beatae ut dignissimos beatae dolorem rerum architecto.",
    "grade": 4
  }
}
```

### Создание комментария

##### Требования к полям
1. user_id: exists: users_id, required
2. company_id: exists: company_id, required
3. message: string, min:150, max:550, required
4. grade: integer, between:1,10, required

```shell
curl --location --request POST 'http://localhost/api/comments' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
   "user_id": 6,
   "company_id": 8,
   "message": "Lorem ipsum dolor sit amet...",
   "grade": 7
}'
```

_Вывод_
```json
{
  "data": {
    "id": 102,
    "user_id": 6,
    "company_id": 8,
    "message": "Lorem ipsum dolor sit amet...",
    "grade": 7
  }
}
```

### Обновление комментария
```shell
curl --location --request PATCH 'http://localhost/api/comments/102' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
   "user_id": 3,
   "grade": 10
}'
```

_Вывод_
```json
{
  "data": {
    "id": 102,
    "user_id": 3,
    "company_id": 8,
    "message": "Lorem ipsum dolor sit amet...",
    "grade": 10
  }
}
```

### Удаление комментария
```shell
curl --location --request DELETE 'http://localhost/api/comments/102'
```
