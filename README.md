# MailerLite Test Application | Danial Hayati
Note: This is a temporary repository to upload the test project of MailerLite and has no other use!


## Documentation
Although the project's files have been well commented, But I prefer to talk about some points here.

#### Project Aspects/Details
1. This project has been written with PHP/Laravel 8.4 and VueJs 2.6.12.
2. No external library has been used alongside Laravel (not even Horizon, Telescope, etc.).
3. I used VueRouter and Vuex to create a SPA. Maybe Vuex was unnecessary (because the app is small), but It makes the coding clean and regular.
4. I used Vuetify as UI library (and rewrite all the front-end code again) because, in a full Vue-based project, It is better than Bootstrap/jQuery combination.
5. I used Docker to convey the services I needed. Laradock is a good option while you want a fast setup.
6. I used Nginx/MySQL/PHPMyAdmin/PHP-fpm/workspace services of Laradock.
7. on an excellent SPA, you have to use a service like Redis to handle Queues, Notifications, Broadcasts, etc. and on client-side Laravel Echo and SocketJs. But here I didn't use any because the scope of application was too small and straightforward.
8. As supposed, I used neither an authentication system nor an authorization system. But if it was a concern JWT (Api Auth) can be used for the first one and Laravel Policies/Gates for the second one.

#### Project Tests/Security
1. Project code has been rewritten in a TRUE MVC format, and the security of codes has been improved.
2. I have created so dummy files; however, they may be empty, but I had to emphasize their importance (like Observers, Notifications, etc.).
3. I have used PHPUnit to write tests for project features. The scope of the project was not so significant to write units and features at the same time. The tests examine every route and controller method that exists.

#### Project Logic
1. I have commented and explained the project logic in every piece of code.
2. I also have commented on some rarely used files that need configurations sometimes.
3. As the concept of currency was not clear for me. I had an assumption about the currency system, so please read the Currency Model comments.
