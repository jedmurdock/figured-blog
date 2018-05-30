## Jed Murdock's basic blog for Figured

While I have many years of experience writing PHP, this is my first Laravel app. 

I've briefly touched on an existing Laravel app while at Ravenna Solutions to add something to an API endpoint, but that was a quick one-time thing.

The following tutorial helped me quite a bit for the API auth stuff: https://www.toptal.com/laravel/restful-laravel-api-tutorial

Beyond that, I relied mostly on the official Laravel docs for guidance. 

#### Special features 
- I use a 'slug' for Post routing as a blog best-practice to help with SEO and database safety by not exposing IDs
- I use a 'visible_at' column to allow Posts to be scheduled for future release

#### Notes
- the phpunit test uses SQLite in memory, which is nice because it's fast and you don't have to worry about messing up your real data
