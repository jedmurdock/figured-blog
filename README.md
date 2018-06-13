## Jed Murdock's basic blog for Figured

While I have many years of experience writing PHP, this is my first Laravel app. This is also my first attempt at Vue.js. I'm sure I'm making all sorts of rookie mistakes on this project that given a month or two of best-practice guidance for these specific frameworks I could clean up. I've experience with Rails / React which is just similar enough to get me in trouble. 

I designed this as an API first / javascript frontend app because that's generally how I think now. I decided to handle login/logout and registration
as normal thanks to the built-in Laravel views, although the api routes exist and are tested.


## Setup

I looked at the Valet and Homestead environment shortcuts but they didn't seem well suited for my setup.

You should be able to clone this repo and then, given you've got MySQL, php, composer and npm installed:

'''
composer install
php artisan migrate
phpunit
php artisan db:seed  #optional
npm run dev
php artisan serve
'''

and then navigate to http://127.0.0.1:8000

if you've seeded the db, you'll see some random posts display newest to oldest by 'visible_at' date field. 

In hindsight, I shouldn't have messed around with dates because there are so many issues going between database to php to javascript and back,
with timezones and formatting. As it is I know the dates are not handled correctly at this point.
 
You'll need to register a user in order to create, edit and delete posts.


#### Special features 
- I use a 'slug' for Post routing as a blog best-practice (helps with SEO and permalinks, hides db IDs from public)


#### Notes
- the phpunit test uses SQLite in memory, which is nice because it's fast and you don't have to worry about messing up your real data


#### Things to improve given time
- obviously with a real blog you wouldn't allow just anyone to register themselves and then start editing whatever they wanted
- Handle graphics in Posts
- wysiwyg editor for Posts
- better error handling for Post editing
- Better styling (of course!)
- Deleting a Post doesn't play well with paging
- Tie Posts to Users, limit edit/delete to authoring User or admin Users
- better application flow after edits etc
- the visible_at dates do not handle timezones properly, and the date picker doesn't allow time-of-day
- if you set the visible_at date to the future, you won't be able to see it in order to edit or delete it until that date passes!!! Should make future posts visible in special view when in edit mode. 
- more comprehensive test suites