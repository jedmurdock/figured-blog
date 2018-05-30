## Jed Murdock's basic blog for Figured

### this is a work in progress

While I have many years of experience writing PHP, this is my first Laravel app. 

The following tutorial helped me quite a bit for the API auth stuff: https://www.toptal.com/laravel/restful-laravel-api-tutorial

Beyond that, I relied mostly on the official Laravel docs for guidance. 

#### Special features 
- I use a 'slug' for Post routing as a blog best-practice to help with SEO and database safety by not exposing IDs


#### Notes
- the phpunit test uses SQLite in memory, which is nice because it's fast and you don't have to worry about messing up your real data
