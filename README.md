## Jed Murdock's basic blog for Figured

### this is a work in progress




While I have many years of experience writing PHP, this is my first Laravel app. 

The following tutorial helped me quite a bit for the API auth stuff: https://www.toptal.com/laravel/restful-laravel-api-tutorial

Beyond that, I relied mostly on the official Laravel docs for guidance. 

#### Special features 
- I use a 'slug' for Post routing as a blog best-practice to help with SEO 


#### Notes
- the phpunit test uses SQLite in memory, which is nice because it's fast and you don't have to worry about messing up your real data


#### Things to improve given time
- Handle graphics in Posts
- wysiwyg editor for Posts
- error handling for Post editing
- Better styling (of course!)
- Deleting Post doesn't play well with paging
- Tie Posts to Users, limit edit/delete to authoring User or admin Users
- Change log, rollback