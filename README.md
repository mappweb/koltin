## About Blog

Registration of content related to an author and comments related to the content and the content creator. Includes content management by user account and public access to view content.

* ~/documents/Design%doc.docx
* ~/documents/relational-model.png

## Experience

The requirements were analyzed. The model related to the blog and the entities identified as users, posts and comments was designed. Laravel's set of utilities was leveraged to make the process flow simple, scalable and readable. Some of the SOLID principles were applied. I was able to work out some details of the flow, starting from the results thrown by the unit test suite.

## External Libraries

* [Yajra Datatables](https://yajrabox.com/docs/laravel-datatables/9.0): Laravel DataTables is a package that handles the server-side works of DataTables using Laravel.
* [laravel-google-sheets](https://github.com/kawax/laravel-google-sheets): Laravel google sheets integration.

## Contributing

Thanks to God for his wisdom and to my wife for believing that I could.
## Api

Documentations: ~/documents/Koltin.postman_collection.json

### Login [POST]
* uri
> POST /api/v1/login
> 
* Params
>{
"email": "diego.toscanof@gmail.com",
"password": "12345678"
}
### Logout [POST]
* uri
> POST /api/v1/logout
>
* Headers
> { "authorization": "bearer {token}" }


## Command

Export to google sheets the comments in a date range.

> php artisan data-export:comment --startDate="2023-11-01" --endDate="2023-11-01"
> 


## Compile asset

> npm run build
> 
