# Levelz.app
---
## About
Levelz.app is a productivity web app that gamifies the concept of a todo list or task tracking app.
We try to help you reinforce good habits and level up your life.

Founded in June 2020 (by wforbes, wforbes87).

## Development Roadmap (2020)
Here are some features and a general roadmap for their completion for the rest of the year. I'll be utilizing Github.com's project tracking features to accomplish these:
* [x] **Create Vue Project** - Get the Vue.js project set up!
	* [x] **App Runs On Local** _ Get the app running on localhost via vscode npm local web server, configure routes with history mode, and get a few pages started
	* [x] **App Hosted On Remote** - Get the app uploaded via ftp to the web host and properly serving, test for config bugs and do some prototyping. 
* [x] **Create PHP Project** - Get a core PHP project set up!
  * [x] **App Runs On Local** - Get the app serving from a XAMPP local web server, get the Vue app making successful requests to it (handle local CORS issues between localhost ports), and prototype some ideas.
  * [x] **App Runs On Remote** - Get the app uploaded via ftp to the web host and ensure the front end can make requests to the back-end!
* [ ] **User Authentication** - Allow a user to create an account on the app, confirm their account via email, view a basic dashboard, and log in to thier account later
  * [x] **Signup Form** - Create a component that allows the User to sign up for a Lvlz account by securely transmitting data to the web server.
  * [ ] **Create Database Entry** - Validate the User's new account info and store it on the database.
  * [ ] **Confirmation Emails** - Sending out a confirmation email when a new account is created that provides a link to confirm the account.
  * [ ] **Login Form** - Create a component that allows people that have made an account to log in to it securely with their password.
* [ ] **Basic User Dashboard** - This dashboard should give controls to modify their information, add a profile picture, and provide links to other features that haven't been built yet like Activity, Notifications, Messages, and Friends. It should also include some UI for 'game' features like their Level, Experience Points, Vital Points, Statistics, Abilities, Spells, and Achievements.
* [ ] **Prototype Core Features** - Create some barebones versions of the core features envisioned for the app 
  * [ ] **To-Do List Page** - Prototype a simple to-do list page that allows the user to create a list, add items to the list, keeps track of previously made lists, and explore other parameters/returns.
  * [ ] **Task Tracker Page** - Prototype a simple task tracker page that allows the user to define a task, add a description to it, create/assign To-Do lists to it, assign it to an Achievement, and explore other parameters/returns.
  * [ ] **Timer Page** - Prototype a timer page that allows the user to start and stop a timer, keep track of past timers, link timers to a task item or to-do list item, and explore other parameters/returns.
  * [ ] **Achievement Page** - Prototype an achievement page that allows the user to create a long term goal and define an achievement they may earn by completing that goal. This goal may be composed of Tasks, or be stand-alone.
  * [ ] **Attributes Page** - Prototype a page that allows the User to define their own Attributes which serve as markers of progress in the completion of Achievements, Tasks and other activities on the app. Allow the user to assign Experience points, Vital points, Stats, Skills, Abilities, Spells and other custom metrics which will be displayed on their Dashboard, in their User Profile, and elsewhere on the app.
* [ ] **Plan for Alpha Version** - Given all the lessons learned and insights gained throughout building core prototype features; Plan for the Alpha version of the app which provides a more streamlined, user friendly, enjoyable experience. This includes Activity, Notification, and Social features - among other ideas gained through the prototyping process. 


### What is this repo?
This is the source code for a web app found at [https://levelz.app](https://levelz.app) (and [https://lvlz.app](https://lvlz.app)). 
It's written with Vue.js v2, and a simple PHP v7.3 backend. We use the front-end UI library Vuetify which provides many of the UI components and we use Vue features like Vuex, Vue-Router, and others that you might find in a typical Vue app. We may use a PHP framework like Laravel in the future.

#### Directory Structure
The Vue.js source files are arranged loosely into a feature-based structure that groups together the source directories for each feature like views, components, stores, and models. Here's a simple example:
~~~
src
|_app
  |_store
    |_appModule.js
  |_model
    |_
  |_components
    |_AppBar.vue
    |_Footer.vue
  |_views
    |_App.vue
|_home
  |_store
    |_homeModule.js
  |_model
    |_NewsFeedItem.js
  |_components
    |_NewsFeed.vue
  |_views
    |_HomePage.vue
~~~
This structure is subject to change, but I'll try to keep this README updated as the project changes.

---

### Open-Source Contributions and Involvement  

**Levelz.app is licensed under the GNU Public License v3.0 which you can read about [here](http://www.gnu.org/licenses/gpl-3.0.html).**

Essentially, you are free to use, distribute, modify, or sell your own versions of this software - as long as that source remains Open! We simply restrict the closed-source use of it, and respectfully request that you notify us of where you use it by emailing [will@levelz.app](mailto:will@levelz.app).

By making this repository public I'm aware that other developers or companies may use this source code to launch their own competing projects. While I would encourage you to please contribute to this project instead and combine our efforts, we understand if you don't.

##### Free to use as a learning reference
This project has an aim to include an open source attitude toward user contributions. At any point you are free to fork or clone this project and use it as a reference to further your learning path. We strongly support young developers and creators in their career, and this project's creator is happy to discuss any details with you. Message us any time.

##### Contributing to the project
While right now our goal is to provide Levelz.app primarily as an online service, we're very interested in finding ways for our users to simply 'install' it to their web browser using Progressive Web App tech and persist their own data via IndexedDB, to make use of Levelz.app in an offline private capacity. 

That being the case, we realize that you may want to alter or change the app to your own liking if you've got the coding skills to do it. You may find a bug, or see a way to quickly improve the app in some way as well - we encourage you to make a Pull Request so we can check it out!

Equally, you may be interested in becoming a regular contributor and joining our development team. Currently, Levelz.app is not monetized so our ability to pay you for your work is extremely limited. Any Pull Requests right now should be made with the spirit of Open-Source, and if your changes are merged in they will retain an Open-Source licensing indefinitely. Contribution compensation isn't out of the question - I don't mind sending you $10 for a cup of coffee :)  

It is not our goal to benefit monetarily from the free work of others. When (or if) the time comes that we do become a monetized project/company, any open source contributors will be the first in line to benefit from this change with job interviews, job offers, or direct scaled reimbursement for your contributions. This also includes contributions of copy-writing, design concepts, or artwork - all of which can be sent to [will@levelz.app](mailto:will@levelz.app) if they aren't appropriate for a Pull Request.

Speaking as the founder of Lvlz, in the unlikely event that this project gains a following and community around it, I would like as many people to benefit as possible and let the community decide where it goes. My interest in building Lvlz is to practice my coding skills and learn new development techniques, I have a day-job where I earn my living and I would only desire to transfer that day-job over to work on Lvlz full time and work to earn my fair share in whatever company that results!

Thanks for your interest in the project!
