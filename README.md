# Levelz.app

---

## About

Levelz.app is a productivity web app that gamifies the concept of a todo list or task tracking app.
We try to help you reinforce good habits and level up your life!

Started in 2020 by Will Forbes - github.com/wforbes, @wforbes87 or @wforbes on most networks and platforms.

This project will be used for my Computer Science capstone project for [Western Governor's University](https://wgu.edu)

### What is this repo?

This is the source code for a web app found at [https://levelz.app](https://levelz.app) (and [https://lvlz.app](https://lvlz.app)).
It's written with Vue.js v2, and a simple PHP v7.3 backend.
The front end uses Vuetify for it's UI components. The back end doesn't use a framework at this time.

---

## Development Roadmap

These are some features I'm working on and a general roadmap for the direction of the project.

* [x] **Create Vue Project** - Get the Vue.js project set up!
  * [x] **App Runs On Local** _ Get the app running on localhost via vscode npm local web server, configure routes with history mode, and get a few pages started
  * [x] **App Hosted On Remote** - Get the app uploaded via ftp to the web host and properly serving, test for config bugs and do some prototyping. 
* [x] **Create PHP Project** - Get a core PHP project set up!
  * [x] **App Runs On Local** - Get the app serving from a XAMPP local web server, get the Vue app making successful requests to it (handle local CORS issues between localhost ports), and prototype some ideas.
  * [x] **App Runs On Remote** - Get the app uploaded via ftp to the web host and ensure the front end can make requests to the back-end!
* [X] **User Authentication** - Allow a user to create an account on the app, confirm their account via email, view a basic dashboard, and log in to thier account later
  * [x] **Signup Form** - Create a component that allows the User to sign up for a Lvlz account by securely transmitting data to the web server.
  * [X] **Create Database Entry** - Validate the User's new account info and store it on the database.
  * [X] **Confirmation Emails** - Sending out a confirmation email when a new account is created that provides a link to confirm the account.
  * [X] **Login Form** - Create a component that allows people that have made an account to log in to it securely with their password.
* [X] **Basic User Dashboard** - This dashboard should give controls to modify their information, add a profile picture, and provide links to other features that haven't been built yet like Activity, Notifications, Messages, and Friends. It should also include some UI for 'game' features like their Level, Experience Points, Vital Points, Statistics, Abilities, Spells, and Achievements.
  * [X] **Features Menu** - Create a component that provides links to all the Core Features of the app.
  * [ ] **Profile Picture Uploads** - Create a component that allows users to upload, change, and delete their profile picture, and another component that displays their profile picture throughout the app.
  * [ ] **Profile Information** - Create a component that allows users to add and update their basic profile information.
* [ ] **Prototype Core Features** - Create some barebones versions of the core features envisioned for the app.
  * [ ] **Activites Page/Component** - Prototype a simple Activities page that allows the user to create a simple Activity, add Actions to it, keeps track of previously made lists, and explore other parameters/returns.
  * [ ] **Task Page/Component** - Prototype a simple task tracker page that allows the user to define a task, add a description to it, create/assign Activities to it, and explore other associated features.
  * [ ] **Inventory Page** - Prototype a simple inventory management system which provides some tools for tracking a user's physical real world equipment and possessions, then coordinating their use with tasks and activities on the app.
  * [ ] **Achievement Page/Component** - Prototype an achievement page that allows the user to see the Rewards they've earned and are working on, define their own Rewards, and explore creating a Rewards component that can be displayed throughout the app.
  * [ ] **User Profile Page** - Prototype a User Profile page that displays information about the User to any visitor of the app, with the option to make some or all of it private. Information would include Profile Picture, Basic Profile Data, Tasks/Activities, Attributes, Achievements. Links to message or add as friend visible to other Users.
  * [ ] **Attributes Page** - Prototype a page that allows the User to define their own Attributes which serve as markers of progress in the completion of Achievements, Tasks and other activities on the app. Allow the user to assign Experience points, Vital points, Stats, Skills, Abilities, Spells and other custom metrics which will be displayed on their Dashboard, in their User Profile, and elsewhere on the app.
* [ ] **Additional Prototype** - Create some optional features and pages which bolster the core features and provide further post alpha possibilities.
  * [ ] **Friends Page/Components** - Prototype a Friends page that allows Users to add each other as friends, see a list of their current friends, remove friendships, block other Users.
  * [ ] **Messages Page/Components** - Prototype a Messages page that allows Users to send messages to each other, see a list of the message conversations with each friend with consideration to Friendships (list messages from friends seperately from non-friends), and explore associated features.
  * [ ] **Financials Page** - Prototype a simple budget management system which can assist the user with their spending and savings habits, providing savings goals, task budgets and an example of linking up to a bank API for real time account balance information.
  * [ ] **Travel Page** - Prototype a simple travel and explorating page which allows the user to plan and record their adventures into the big wide world out there.
  * [ ] **User Configuration Page** - Prototype a user accessible configuration page which provides controls for various settings across the app
  * [ ] **UI / UX Redesign** - Redesign the user interface of the app and give it an attractive, easy to use, user experience with multiple visual styles that can be chosen by the User
* [ ] **Release Alpha Version** - Given all the lessons learned and insights gained throughout building core prototype features; Plan for the Alpha version of the app which provides a more streamlined, user friendly, enjoyable experience. This includes improving Activity, Rewards, and Social features - among other ideas gained through the prototyping process.
  * [ ] **Prototype Test Program** - Advertise the app a little, recruit people to test the app, get their bug reports and feedback, then work through coding all the issues and ideas they find.
  * [ ] **Forums** - Add a forum to the Levelz.app website which allows users to share their ideas, connect with each other outside of the app, and report bugs in a community setting.
* [ ] **Templates** - Add a templating feature to the app which allows users to share pre-made Quests, Tasks, and Activities. Users should be able to browse through lists of templates, add them to their account and use them.

---

### Directory Structure

#### Vue structure

The Vue.js source files are arranged loosely into a feature-based structure that groups the directories for each feature together. For instance, the App directory contains all the code needed for the core features of the app, the home directory contains the publicly available 'Home' page and related components, and the auth directory contains the code needed for Authorization and Authentication related components (signup, login, etc.). Each feature directory typically contains a Views directory which contains full pages, Components directory which contains individual components that are displayed on the views, and a Model directory which contains vuex store modules and/or Model files which provide interface to the data access interface.

~~~
src
|_app
  |_models
    |_appModule.js
  |_components
    |_AppBar.vue
    |_Footer.vue
    |_NavMenu.vue
    |_SnackBar.vue
  |_views
    |_App.vue
    |_Error404.vue
    |_NotLoggedIn.vue
|_home
  |_components
    |_ProjectUpdates.vue
  |_views
    |_HomePage.vue
|_auth
  |_components
    |_AuthDialog.vue
    |_DataStatementDialog.vue
    |_LoginForm.vue
    |_SignupForm.vue
  |_model
    |_authModule.js
  |_views
    |_AuthPage.vue
~~~

##### PHP Structure

The PHP source files are arranged into namespace folders as described by the [PSR-4: Autoloader](https://www.php-fig.org/psr/psr-4/) spec. The autoload() function in */api/src/Core/App.php* registers the composer autoloader from the */api/vendor* directory which is generated by the */api/composer.json* file's autoload object. At this time sub-namespaces aren't used.

Simple example:

~~~
src
|_Auth
  |_SignupController.php
  |_LoginController.php
|_Data
  |_MySQL.php
|_User
  |_User.php
  |_UserProfile.php
~~~

Then allows you to:

```
<?php
namespace Auth;
use User\User;
class Auth {
  public function __construct() {
    $this->user = new User();
...
```

#### PHP Data strategy

The goal here is to reduce the amount of time spent doing manual database admin tasks and writing sql statements.

* Dynamic DB/Tables - The MySQL class creates the database and it's tables up if they don't exist. If the database or any tables are dropped, the next time they're used they will be recreated. That's made for a faster process developing, prototyping, and releasing new features. Just add the proper mysql/db credentials and the app will spin up tables as it needs them.
* Models are Tables - The Model class is inherited by classes that represent each table on the app. Model\Model provides the functions that enable this 'dynamic' table creation. Each inheriting class has a 'getModelData' function that describes the Model's table fields.
* Generic Database Calls - The MySQL class has a number of functions to make database calls that build their own sql statements. This removes the need to directly write sql code for trivial SELECT, INSERT, or UPDATE calls. The SELECT function is "gbi(these, that, there)" which is shorthand for "Get these By that In there". The 'these' parameter are the fields you need, use '*' for all fields; the 'that' parameter is an associative array to be used for the WHERE clause; and the 'there' parameter is the name of the table to select from.

---

### Open-Source Contributions and Involvement  

**Levelz.app is licensed under the GNU Public License v3.0 which you can read about [here](http://www.gnu.org/licenses/gpl-3.0.html).**
