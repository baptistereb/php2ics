
# php2ics
php script to transform php into ics file

## Deployment

###### __1. copy the "php2ics.php" file in the main folder of your project__
You can copy the file in a different folder
###### __2. include the file in your code :__
```php
include("php2ics.php");
```
if you modify the folder then modify the adress in the "include".
###### __3. use it !__
## How it work

###### __1. Create a calendar :__

```php
$cal = new php2ics("your_organisation", "your_product");
```
"your_product" is not a required parameter

###### __2. Add event (you can add as many as you want):__
```php
$cal->AddEvent("title", "description", "begin_time", "end_time", "location", "url");
```
"description", "location" and "url" are not required parameters

###### __3. End file :__ 
```php
$cal->End();
```

###### __4. Download it !__
```php
$cal->DownloadICS();
```

###### __You can also get it as HTML !__
```php
$cal->GetICS();
```

## Documentation

#### __AddEvent function :__

| Input parameter  | required parameter   | type           | description                   |
| :--------------- |:--------------------:|:---------------|:------------------------------|
| title            | x                    | string         |title of the event             |
| description      |                      | string         |description of the event       |
| begin_date       | x                    | int(timestamp) |beginning datetime of the event|
| end_date         | x                    | int(timestamp) |ending datetime of the event   |
| location         |                      | string         |location of the event          |
| url              |                      | string         |url                            |

NB: if parameter is not required, then you can replace it with this argument : NULL. Example :
```
$cal->AddEvent("title", NULL, 1660568400, 1660572000, NULL, NULL);
```
