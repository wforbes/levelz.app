<template>
	<div>
		<h1>The Lvlz Thesis</h1>
		<br />
		<br />
		<h5>Table of Contents</h5>
		<ul>
			<li>
				<strong>
					<a @click="scrollTo('intro')">
						Introduction
					</a>
				</strong>
				<ul>
					<li>
						<a @click="scrollTo('what-is')">
							What is Levelz? (The 'Elevator Pitch')
						</a>
					</li>
					<li>
						<a @click="scrollTo('concepts')">
							Concepts and Initial Thoughts
						</a>
					</li>
				</ul>
			</li>
			<li>
				<strong>
					<a @click="scrollTo('phase-one')">
						Phase One: Core Feature Set
					</a>
				</strong>
				<ul>
					<li>
						<a @click="scrollTo('activities')">
							Activities
						</a>
						<ul>
							<li>
								<a @click="scrollTo('actions')">
									Actions
								</a>
							</li>
							<li>
								<a @click="scrollTo('reminders')">
									Reminders and Scheduling
								</a>
							</li>
							<li>
								<a @click="scrollTo('metrics')">
									Metrics
								</a>
								<ul>
									<li>
										<a @click="scrollTo('gradable-actions')">
											Gradable Actions
										</a>
									</li>
									<li>
										<a @click="scrollTo('incremental-actions')">
											Incremental Actions
										</a>
									</li>
									<li>
										<a @click="scrollTo('timed-actions')">
											Timed Actions
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a @click="scrollTo('activities-test-cases')">
									Activities and Actions Test Cases
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a @click="scrollTo('tasks-quests')">
							Tasks and Quests
						</a>
					</li>
					<li>
						<a @click="scrollTo('exp-pts-levels')">
							Experience Points and Levels
						</a>
						<ul>
							<li>
								<a @click="scrollTo('problem-of-equivalence')">
									The Problem of Equivalence
								</a>
							</li>
							<li>
								<a @click="scrollTo('rate-exp-gain')">
									Rate of Experience Gain
								</a>
							</li>
							<li>
								<a @click="scrollTo('effort-value-unit')">
									Effort Value Unit
								</a>
							</li>
							<li>
								<a @click="scrollTo('effort-degradation')">
									Degradation of Activity Effort Value
								</a>
							</li>
							<li>
								<a @click="scrollTo('effort-to-exp')">
									Effort to Experience
								</a>
							</li>
							<li>
								<a @click="scrollTo('max-lvl')">
									Maximum Level: 100
								</a>
							</li>
							<li>
								<a @click="scrollTo('user-skill-lvl')">
									User Level and Skill Levels
								</a>
							</li>
							<li>
								<a @click="scrollTo('exp-per-lvl')">
									Experience Required per Level
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li>
				<strong>
					<a @click="scrollTo('phase-two')">
						Phase Two: Communication and Sharing
					</a>
				</strong>
				<ul>
					<li>
						...
					</li>
				</ul>
			</li>
		</ul>
		<br />
		<br />
		<h2 id="intro">Introduction</h2>
		<h3 id="what-is">What is Levelz? (The 'Elevator Pitch')</h3>
		<p>
			Lvlz or Levelz, pronounced 'Levels', is a productivity web app that helps
			gameify your life. It's a task tracking app that gives you the tools to
			plan your to-do lists, help you monitor or share your progress as you get
			better at what you do, and awards you with 'experience points' as you
			complete them. It's loosely modeled on the leveling and progression
			mechanics found in modern video games.
		</p>
		<p>
			These video game mechanics are based on incremental progression tracking.
			As the player completes challenges in the game, they provide the player
			with gradual rewards through incremental positive reinforcement queues and
			metrics-based feedback. Lvlz does this by giving the user the tools to
			define, plan, and record the individual activities and actions required to
			build a habit or master a skill; give real-time metrics to chart their
			progress and improvement in those habits or skills; and gives the user the
			tools to define and plan larger goals that the individual actions are
			meant to work toward.
		</p>
		<h3 id="concepts">Concepts and Initial Thoughts</h3>
		<p>
			I always found it interesting that it was so easy to spend hundreds of
			hours playing video games, yet for some, doing more productive things in
			life can be much less appealing. In many popular modern games your goal is
			to level up your character or earn new virtual items, but it takes time.
			It takes alot of time. Whether you realize it or not, it also takes alot
			of work, even if that work is fun.
		</p>
		<p>
			Meanwhile, we have things in our lives that we need to level up, too. We
			have skills we'd like to improve. Like learning a new career skill or
			getting better at a hobby. We may want to work out more to stay in shape,
			or focus our efforts into accomplishing something meaningful like writing
			a book or composing a song. We also have more meanial tasks to do like
			studying for school, doing chores around our home regularly, and loads of
			other things that keep our lives moving forward in positive direction.
		</p>
		<p>
			Levelz is meant to bridge that gap between the fun we have in video games
			and the fun we can have while doing our simple everyday tasks, picking up
			a new habit, or working toward a goal.
		</p>
		<p>
			You'll add the things you want to do into Lvlz, or pick from one of our
			pre-made templates of common things to do. Then as you complete those
			things you'll mark them off in Lvlz to track your progress. In doing so,
			you'll earn Experience Points and other bonuses. Over time, the Experience
			Points that you earn will cause you to Level Up! Those other bonuses might
			be things like increasing your statistics, improving your skill levels,
			and earning new in-app rewards.
		</p>
		<p>
			Track what you want, how you want. Go out and practice your skills with
			Levelz - like your skateboard tricks, tennis swing, guitar scales, oil
			painting, or virtually any other skill/hobby. Use Lvlz to record each
			individual action or each practice session. Watch your practice counts add
			up as you earn experience and skill points. Become a level 100 painter as
			you refine your craft.
		</p>
		<p>
			Rate or time your practice to get insight into how well you're doing. Work
			toward getting better and improving your ratings or your time. Want to
			become a faster reader? Use Lvlz to track the time you spend on each page
			while reading a book. Want to get more consistent with your skateboarding?
			Use Lvlz to track how many kickflips you can land in each a practice
			session. Want to improve your baseball swing? Have a friend or coach rate
			your performance at the batting cages. This can help make you more aware
			of how you're doing and work toward improvements!
		</p>
		<p>
			You can share your progress with your friends and compete with them toward
			shared goals. Your profile on Lvlz can publicly You can create activity
			templates you found helpful and share them with the community on Lvlz
		</p>
		<p>
			The same game systems that keep gamers hooked, having fun and playing
			their video games, can be leveraged to get people hooked on the new habits
			and skills they desire to pick up in their day-to-day lives.
		</p>
		<h2 id="phase-one">Phase One: Core Feature Set</h2>
		<p>
			This first phase of development on Levelz revolves almost exclusively
			around building out and testing the prototype for the core features of the
			app. The goal is to build something really easy to use and useful in the
			real world for multiple types of people. We expect to learn alot and
			revise this plan every chance we get along the way. Here's what we're
			starting with.
		</p>
		<h2 id="activities">Activities</h2>
		<p>
			An <strong>Activity</strong> can be thought of as a single set of work
			that can be completed in a few minutes or hours, at most. Like a session.
			A practice session, a work-out session, a school session, or a cleaning
			session.
		</p>
		<p>
			Activities may be simple and you may prefer to keep them simple. That
			works for us! Make a "Clean the house" Activity and simply mark it off as
			done when you get finished. Your list of Activities can just be thought of
			as a really solid to-do list. Unlike other to-do list apps, we offer the
			option to add more expanded features to your Activities that can really
			help you improve what you do and make you think about your to-do list
			differently. Here are a few.
		</p>
		<h3 id="actions">Actions</h3>
		<p>
			More involved Activities can benefit from breaking them down into smaller
			portions of work. This is where Actions come in. An
			<strong>Action</strong> can be thought of as just one single part or
			individual effort of an Activity. A set of Actions may be a step-by-step
			list of things to do in order to accomplish thier Activity, or they may be
			a non-linear list of things associated with the Activity.
		</p>
		<p>
			For Activities that require a set of Actions to be completed, an
			<em>'Action List'</em> can be used. Marking each Action on the list as
			complete as you do them can help ensure things are done in proper order or
			nothing is forgotten when doing an Activity. The Activity "Clean the
			house" can be assigned the Actions "Vacuum the carpets", "Scrub the
			bathroom", and "Do the laundry". The a more involved Activity like "Build
			backyard shed" may have the Actions "Gather all tools", "Buy lumber and
			hardware", "Buy cement", "Clear land", "Frame foundation", "Pour
			foundation cement", ... and so on.
		</p>
		<p>
			For Activities that may require doing different things at different times,
			Actions can be added to Activities and marked as complete in a non-linear
			way. They may simply serve as a way to remind you of what is available to
			do, and help track details of what you did. An Activity like "Practice
			Skateboarding" may list the tricks you've been working on, like
			"Kickflip", "360 Flip", or "Nollie Flip Crooked Grind". Then as you try
			these tricks during your practice session, you'd mark off each attempt. At
			the end of the session you'd be able to look back and see that you tried
			one trick 21 times, while another trick was only attempted 3 times.
		</p>
		<h3 id="reminders">Reminders and Scheduling</h3>
		<p>
			An Activity/Action may be repeated sometime in the future, and it may be
			something you'd like to build up a habit of doing. Reminders can be set to
			give you notifications about regularly doing an Activity, and added to
			your Schedule so you can make the time to do it.
		</p>
		<p>
			An Activity may work toward a larger goal or goals you have for yourself.
			Maybe your Activity of studying mathematics will work toward completing
			your math class or getting your degree. For this, Activities can be
			associated with a <strong>Task</strong> or a <strong>Quest</strong>,
			discussed later in this document.
		</p>
		<h3 id="metrics">Metrics</h3>
		<p>
			We believe that a key part of improving your skills is paying attention to
			your performance and using that insight to find ways to get better. Lvlz
			has the tools to help offer more insight into how your Activities/Actions
			are done, with Metrics.
		</p>
		<p>
			Again, you always have the option to keep things simple. Maybe seeing a
			list of things to do and marking them off as being done is all you need.
			At the least, you'll be able to see the date and time it was completed,
			and the number of times you've done it. These metrics are provided by
			default.
		</p>
		<p>
			Practicing a skill or hobby using Activities/Actions can help keep you on
			track with the first two major challenges: (1) making a habit of regularly
			'showing up' consistently, and (2) organizing the details of what should
			be done in guidable detail. However, this doesn't track or inform how
			<em>well</em> or help <em>improve</em> what's being done while practicing.
			For this, we've prepared a few <strong>Action Types</strong> that can be
			assigned to an Action which add features to track further metrics toward
			improving how your Actions are done.
		</p>
		<h4 id="gradable-actions">Gradable Actions</h4>
		<p>
			Setting an Action to be Gradable allows you to judge how well the Action
			was completed. This is a rating system which sets a completed Action with
			a number value between zero to five by default. Zero is a failure, Five is
			a perfect success.
		</p>
		<p>
			The metrics from Gradable Actions can help chart progress toward mastering
			skills over time. Improving the average grade from session to session can
			demonstrate a more tangible recorded progression and provide goals to
			reach for.
		</p>
		<!-- Gradable extra blabbering
		<p>
			During a repetitive practice session like skateboarding, actions like
			tricks are attempted over and over again until they're landed. Even then,
			skateboarding tricks are only mastered until they're landed with a good
			comfortable style. There's a big difference between just barely landing a
			kickflip by the skin of your teeth, and landing a kickflip with full
			confidence/comfort.
		</p>
		<p>
			The same sort of idea in practice toward mastery isn't unique to
			skateboarding. Most sports and skill based hobbies have this core
			component. In practice you're making attempts toward mastering a small
			part of a larger skill. Practicing a musical instrument may include
			running some scales, playing a part of a song or a complete song, and
			other exercises to improve technique.
		</p>
		<p>
			Often, practice attempts are completed mindlessly. You sit down to
			practice for an hour, you'll work on practicing an exercise or drill for
			that hour, and although your skill will probably eventually improve...
			there is often no insight into how it's improved day to day, or how much
			it's improved over time.
		</p>
		-->
		<h4 id="incremental-actions">Incremental Actions</h4>
		<p>
			Setting an Action as Incremental allows you to set a goal number that each
			successive Action completion increments to. This can be used for Actions
			where completing the session or Activity is defined by repeating the same
			Action a set amount of times.
		</p>
		<p>
			Good examples of Incremental Actions are things like reading a book, where
			each Action is a page and the goal number is the amount of pages. It could
			be exercise repetitions while working out, where the goal number is your
			total reps for the workout. It could be practicing math problems for
			homework, where you'd like to complete a set number of problems.
		</p>
		<h4 id="timed-actions">Timed Actions</h4>
		<p>
			Setting an Action as Timed includes tools to track the amount of time it
			takes to complete. This can be useful for Actions where you'd like to
			either ensure you spend at least a certain minimum amount of time doing
			the Action, or track the maximum amount of time it took to complete the
			Action.
		</p>
		<p>
			Timer controls track time beginning at the goal amount of time and
			counting down to zero. This can be useful for making sure you spend at
			least 30 minutes or an hour reading, or doing another Activity that
			benefits from spending more time on.
		</p>
		<p>
			Stopwatch controls track time beginning at zero and counting up. Once the
			Action is marked as completed, the final time is recorded and the Action
			can be performed again. This can be useful for trying to reduce the amount
			of time it takes to complete an Action, when you'd like to be more time
			efficent with what you do. Like when training for a race or even
			completing a work assignment.
		</p>
		<p>
			An Action which includes a timer that counts down from a chosen duration,
			where the timer can be paused to allow a better expression of actual time
			performing the Action. This value can count up to a total goal of time
			which defines completion, or counts until the Action is completed at which
			point it's stopped and stored for metrics.
		</p>
		<h3 id="activities-test-cases">Activities and Actions Test Cases</h3>
		<p>
			In order to architect and develop the Activity/Action framework, a
			selection of Use Cases will be implemented to test and improve the
			Activity/Action user interface and workflow. Further use cases and
			Activity/Action example libraries will be built over time.
		</p>
		<h4>Test Case #1: Practice Skateboarding</h4>
		<ul>
			<li>
				'Olympic-style' Skateboarding is based on the performance tricks -
				difficult manuvers that require repetative practice to perfect.
			</li>
			<li>
				Tricks will be listed as Actions in the 'Practice Skateboarding'
				Activity and given the Gradable type.
			</li>
			<li>
				Each time a trick is attempted during practice, that trick's Action will
				be graded. During a practice session, the same trick will be attempted
				multiple times with a goal to improve consistency and quality.
			</li>
			<li>
				Over the course of multiple practice sessions, the metrics of trick
				qualities will be used to guide which tricks should be practiced more.
				Lower average grades will get more practice attention.
			</li>
			<li>
				Improving the consistency of skateboard trick attempts over time will be
				the major goal of this use case, as will be the incorporation of new
				tricks to learn and practice.
			</li>
		</ul>
		<h4>
			Test Case #2: Regularly engage in reading for education and fun
		</h4>
		<ul>
			<li>
				Picking up a habit of regularly reading for enjoyment and to further
				knowledge in an area of expertise is something I've struggled with
				consistently adopting. This use-case will test and experiment using
				Activities to help support this habit.
			</li>
			<li>
				Each book I intend to read will be added as Actions titled with the
				book's title and categorized under Activities entitled "Read a Fiction
				Book", "Read a Non-Fiction Book", or "Study a Textbook". These Actions
				will be given the Progress and Timed types in order to track the pages
				completed and amount of time used.
			</li>
			<li>
				While reading fiction and non-fiction, the metrics of pages per minute
				will be used to track improvement in reading speed and focus. While
				studying textbooks other metrics will be considered, a system of
				scheduled study times will be explored and tested for viability.
			</li>
			<li>
				Improving reading speed and consistency with regularly reading as
				planned will be the main goal of this use case.
			</li>
		</ul>
		<h4>Test Case #3: Learn a new programming language</h4>
		<ul>
			<li>
				Software development is learned and mastered through extensive practice
				and continued research into more techniques, syntax, architecture, and
				algorithms.
			</li>
			<li>
				This use case will revolve around learning and practicing popular
				programming languages I am unfamiliar with (Python, C++, Rust, Scala,
				etc.). This will be supported by online learning websites like
				FreeCodeCamp.com, Codecademy.com, TeamTreehouse.com, and
				Pluralsight.com; who provide defined learning paths and curriculum,
				which can be translated into Activities and Actions on Levelz.app.
			</li>
			<li>
				Success in this use case will be defined and supported by not only
				completing the required tasks on the learning websites, but also
				engaging in regular practice, fun personal projects, and
				researching/studying topics that aren't provided by the learning
				websites.
			</li>
			<li>
				This use case will need to utilize Simple, Progress, and Timed action
				types; along with possibily looking to define further features not yet
				described but required to adequately complete the use case and gather
				adequate metrics.
			</li>
		</ul>
		<h3 id="tasks-quests">Tasks and Quests</h3>
		<p>
			A <strong>Task</strong> is something that can't be completed in one
			sitting. A longer term goal, in the scope of weeks to months, that
			requires completing multiple Activities or one Activity multiple times. It
			might be tied to reaching a performance goal like improving the gradable
			average of an Activity's Actions, or it might just be a goal that one or
			more Activities can help achieve.
		</p>
		<p>
			A <strong>Quest</strong> is a long term goal, in the scope of many months
			or years. It's a major achievement, like finishing a segment of school to
			get a diploma or degree, or be hired for gainful employment in a new
			career, or compete in a major sports competition. It might be structured
			by a series of <strong>Tasks</strong>, each with their own
			<strong>Activities</strong>, or it may be a dream that you aren't ready to
			specifically structure or act on.
		</p>
		<p>
			Tasks and Quests can provide direction toward accomplishing something with
			your daily routine. They can help with encouragement to keep completing or
			practicing your Activities. They can allow you to solidify your goals and
			dreams, similar to a "vision board", where you can allow yourself to look
			months and years into the future and begin to take control of where it
			goes.
		</p>
		<h3 id="exp-pts-levels">Experience Points and Levels</h3>
		<p>
			Each time you complete an Activity or Action, you're rewarded with some
			<strong>Experience Points</strong>. These are points that accumulate with
			effort over time, getting added to your total experience points. Once
			you've earned enough experience points, your overall level increases.
			That's how you level up!
		</p>
		<p>
			Your level and experience point progress are displayed on your Lvlz
			profile. It's a handy accomplishment measure you can show off or compete
			with your friends about, but it also unlocks achievements, benefits on the
			app, and in-app rewards. More over, it can feel good to simply practice
			what you enjoy or menial tackle daily activities and be rewarded with
			leveling progress.
		</p>
		<h4 id="problem-of-equivalence">The Problem of Equivalence</h4>
		<p>
			The rate of experience gained per Activity/Action and the required
			experience to gain a level is the true challenge to make this system work.
			Ideally, our end goal is produce a system of Actions that earn experience
			which is uniform and comparable between users. Provable scientifically.
			This idea would create a dependable environment from which the experience
			points and statistics on Levelz can definitively reflect actual user's
			knowledge, skill and abilities.
		</p>
		<p>
			This problem of finding equivalence between anyone, doing any activity,
			and relating comparable metrics to demonstrate a uniform proficency is the
			massive undertaking that Levelz, as an organization, will work to solve.
		</p>
		<p>
			Our vision is a world where using Levelz to record your study and practice
			could be used as official credentials. As a widely recognized reflection
			of proficency. We're very far from that ideal reality at this early stage.
		</p>
		<p>
			In the meantime, the measurements of skill and effort on Levelz is a
			wholly self-decided and self-directed process. You decide how difficult
			the Actions you record on Levelz. We want to make it clear that this
			current rendition system is exclusively useful to help entice you to
			become more productive and to enjoy tracking your own progress.
		</p>
		<h4 id="rate-exp-gain">Rate of Experience Gain</h4>
		<p>
			<em>(Numbers and figures are subject to change!)</em>
		</p>
		<p>
			To begin, we're working on the idea that it takes 10,000 hours of practice
			to gain mastery in any given skill. Divided into 8 hour days, and 365 days
			in a year... this means it may require nearly 3 and a half years of
			constant practice to become a master. So to reach the highest level of
			skill on Lvlz, we expect that it should take over 3 years of consistent,
			full time use.
		</p>
		<p>
			By default, the completion of one simple Activity or Action equates to one
			unit of effort. This is the effort value. It represents the exchange of
			effort you make for the experience you gain. Some Actions require more
			effort than others, in these cases you can set an Action to be up worth up
			to 4 units of effort. Some Actions are easier and require less effort than
			others, for these cases you can set an Action to be as little as 0.25
			units of effort.
		</p>
		<h5 id="effort-value-unit">Effort Value Unit</h5>
		<p>
			A unit of effort value (EU - effort unit) can be considered equal to one
			hour of "equal skill effort". This is the kind of effort that isn't quite
			challenging, but not quite trivial. It's right at the level of your
			ability. So assigning an Activity or Action with a modified effort value
			means that a half-hour of equal skill effort would be 0.5 EU, just as one
			hour of moderately trival effort could be 0.5 EU.
		</p>
		<h5 id="effort-degradation">Degradation of Activity Effort Value</h5>
		<p>
			By default, every 10 times an Activity or Action is completed within a
			months time, it's effort value is reduced by 0.1. This degradation of
			effort value is meant to reflect how repeatedly doing the same Action in
			practice gets easier. The effort needed to perform it reduces as your
			skill increases. At the very least, any Activity or Action will be worth
			0.25 effort.
		</p>
		<p>
			When you level up, the effort values of all your previously created
			Activities/Actions will be reduced in the same way. This means something
			that was difficult when you were level 2 will be trivial by the time
			you're level 50.
		</p>
		<h5 id="effort-to-exp">Effort to Experience</h5>
		<p>
			Each unit of effort is worth 4 experience points. That means trivial
			Actions are worth 1 experience point, and extremely difficult Actions are
			worth 16 experience points.
		</p>
		<p>
			We arrived at these figures by considering the maximum level, the amount
			of experience to be gained to each that level, and the amount of
			experience to earn each level; all the while focused on how many
			Activities/Actions should be required at each level to reach the final
			figure of 10000 hours of effort to reach the maximum level. These are
			explained next.
		</p>
		<h5 id="max-lvl">Maximum Level: 100</h5>
		<p>
			Reaching level 100 equates to reaching 10000 hours of practice and equal
			skill effort. Level 100 means that you've learned and practiced enough to
			be considered proficient in a skill or ability. In the future, reaching
			level 100 will open new opportunities and features, giving the chance to
			teach others, looks for employment, or some other future considerations
			for the app. At this time, level 100 simply means you're proficient with a
			given skill.
		</p>
		<h5>User Level and Skill Levels</h5>
		<p>
			Each Activity/Action can be associated with a skill category. As you
			complete those Activities/Actions, you gain experience in that skill. Your
			overall user level is an average of the levels of your skill categories.
			Activities/Actions that have no skill category simply apply experience
			toward your overall level. This system is still at an early stage of
			design and may be changed in the future.
		</p>
		<h5 id="exp-per-lvl">Experience Required per Level</h5>
		<p>
			Each new level between 0 and 100 requires gradually more experience to
			achieve. To reach level 1, 50 experience is required, so 12 effort units
			are required. To advance from level 99 to 100, 1371 experience is
			required, so 342 effort units are required. It takes 6 times more effort
			to reach the last level than it did the first. 5 times more effort to
			advance from 49 to 50, than 0 to 1. Twice as much effort to level from 24
			to 25, than 0 to 1.
		</p>
		<p>
			We've reached these figures by beginning with 50 experience for the first
			level, and scaling that value by a slightly increasing amount for each
			next level. The scale factor of 1.034017 is used. For example: Advancing
			to level 33 requires 145.8329733 experience points. So level 34 will
			require 150.7937735 experience points, because that's 145.8329733
			multiplied by 1.034017.
		</p>
		<p>
			We're initially using this scale factor because it ensures a nice gradual
			increase of experience with each new level, or at least it looks good on
			the spreadsheet right now. It also allows for reaching 10000 hours by the
			conclusion of level 100, and it translates the completion of Actions to
			experience points in a recognizable way. Each time a user completes an
			action, a relatively small understandable number of experience points are
			given.
		</p>
		<h2 id="phase-two">Phase Two: Communication and Sharing</h2>
		<p>
			This second phase of development centers around extending the core feature
			set into a more social environment where users can share ideas, teach each
			other and build communities around their interests and pursuits.
		</p>
		<p>... more information to come ...</p>
		<!--
		<h3>The Current State of Social Media Apps</h3>
		<p>
			In a practical sense, social media websites and apps are currently
			extremely advanced time wasting systems. They're funded by substantial
			sums of money to advertise to their users, so they're incentivized to keep
			their users scrolling their news feeds and consuming their content as long
			as possible.
		</p>
		<p>
			Getting a new 'Like' on our Instagram posts, a new comment on our Facebook
			status posts, or a new reply to our Youtube comment feeds into a natural
			system in our heads that draws us to want more interaction. Checking our
			phones throughout the day for new Likes or Messages is common place. It's
			a compulsive dopamine inducing habit that can eat up hours of accumulated
			time, but will only get more pervasive as social media companies get
			better at keeping us engaged.
		</p>
		<p>
			On Facebook, Instagram, Twitter, and other similar platforms you publicly
			share media like pictures and video, snippets or paragraphs of information,
			comment on what others share, and message individuals privately. They offer
			very little for helping or encouraging people toward being productive, 
			learning, or progressing their life in a purposeful way. Even with
			Facebook including many extra features like a marketplace, groups, and 
			more... there are no educational, learning, task-tracking, or productivity
			tools.
		</p>
		<p>
			Substantial learning material has been uploaded to YouTube by it's vast 
			base of "creator" users and associated companies who run accounts on the
			site, but it's up to those users to create and produce any associated
			learning materials on their own websites. Specialized learning platforms
			like PluralSight or Codecademy exist which provide some tools and curriculum
			to assist with learning, but these are exclusively focused on learning 
			technology industry skills.
		</p>
		<h3>Levelz as a Social Productivity App</h3>
		<p></p>
		-->
		<!--
		OLD ABOUT PAGE
		<h2>Phased Prototype Development (2021-2022)</h2>
		<p>
			The first prototype for Lvlz will be developed through a series of phases.
			Below is a description of these phases and systems which will be developed
			throughout the years 2021 and 2022.
		</p>
		<h3>Phase 1 - Activities/Actions Framework</h3>
		<p>
			<i>Estimated time frame: April to June 2021</i>
		</p>
		<p>
			It's with this framework of completing small 'Actions' that constitute the
			practice or completion of an 'Activity', that granular performance metrics
			can help to reward the user and reinforce a consistent habit of
			participating in the 'Activity' regularly. The successful completion of an
			'Activity' incrementally increases the score count of a 'Skill' associated
			with it. This act of accumulating 'Skill' points further reinforces the
			user's habit of consistently working to complete or practice the 'Actions'
			which fulfill the completion of it's associated 'Activity'.
		</p>
		<ul>
			<li>
				<strong>Activity</strong> - A small project or pursuit which may be
				finished once or repeated in intervals of days or weeks. Repeition can
				work toward achieving a measurable outcome that can help improve a
				skill. Examples: Practice Piano, Do Math Homework, Workout At The Gym,
				Clean The House, Read A Book, etc.
			</li>
			<li>
				<strong>Action</strong> - A specific act or unit of work with a small
				scope that can be completed relatively quickly and repetatively, but may
				or may not be completed successfully or with high quality. Constitutes a
				part of an Activity, in concert with other associated or similar
				Actions; OR classifies a more specific form of an Activity. Examples:
				Play a C Major Scale on Piano, Do a Non-Linear System of Equations Math
				Problem, Do A Set of Dumb-bell Upright Rows, Vacuum The Carpet, Read
				"High Performance Habits" by Brendan Burchard, etc.
			</li>
			<li>
				<strong>Action Forms</strong>
				<ul>
					<li>
						<i>Form A:</i> An Action that defines a part of an Activity which
						may or may not complete the Activity. An Activity may be "Practice
						Piano", it's Actions may be "Play '&lt;Song Name #1&gt;'", "Play
						'&lt;Song Name #2&gt;'", and "Play the G-Major Scale", etc. In this
						case, one Activity session may include numerous similar actions.
					</li>
					<li>
						<i>Form B:</i> An Action that more specifically classifies an
						Activity. An Activity may be "Read A Book", the Action may be "Read
						'&lt;Title&gt;' by &lt;Author&gt;". In this case, one Activity
						session may include one, more specific, Action.
					</li>
				</ul>
			</li>
			<li>
				<strong>Action Types</strong>
				<ul>
					<li>
						Simple Actions - An Action which are marked as completed, like a
						simple to-do list item.
					</li>
					<li>
						Gradable Actions - An Action which, when completed, is assigned an
						integer based grade of quality. Metrics like the running average
						quality of repeated Action completions can illustrate and prove
						measured skill increases and decreases.
					</li>
					<li>
						Progress Action - An Action which increments or decrements the value
						of a running count. This value can build to a goal total which
						defines completion or counts down from a starting value which
						completes at zero.
					</li>
					<li>
						Timed Action - An Action which includes a timer that counts down
						from a chosen duration, where the timer can be paused to allow a
						better expression of actual time performing the Action. This value
						can count up to a total goal of time which defines completion, or
						counts until the Action is completed at which point it's stopped and
						stored for metrics.
					</li>
					<li>
						Stopwatch Action - An Action which includes a timer that counts up
						from zero. Operates like a stopwatch which can be split into 'lap'
						intervals or paused.
					</li>
					<li>
						Combination Action - An Action which combines one or more types to
						provide more specific metrics.
					</li>
				</ul>
			</li>
		</ul>
		<br />
		<h4>Action Configuration:</h4>
		<p>
			When created, Actions are given a name and description. They can be given
			one or more Types. By default Actions are of the Simple Type, where they
			take the form of a to-do list item. This means that they are either set as
			incomplete and marked as complete, or marked as completed repeatedly.
			Although some meta data can be derived from simple Actions, like the date
			and time they were completed and how many times they were completed;
			Actions are most useful when they are assigned additional types.
		</p>
		<p>
			Activities that rely on improving the quality of their Actions, like
			practicing a musical instrument or some other skill may benefit from being
			a Gradable action. Each attempt or repetition of the Action is graded on a
			number scale of the user's choosing, like 0 to 5. Where 0 is a failure and
			5 is a perfect success. Adjective terms to describe the various grades on
			the scale can be defined by the user or generic template grades should be
			made available. (Example: 5-Perfect, 4-Excellent, 3-Good, 2-Average,
			1-Bad, 0-Failure).
		</p>
		<p>
			Progress Actions can be implemented when a running count of Action
			repetitions leading up to a sum completion count defines success. Like
			doing a set of exercises, where exercise repetitions are completed, or
			reading a book, where page count completions define success.
		</p>
		<p>
			Applying a Timed or Stopwatch type to the Action can measure the time
			required to complete it, where increasing speed is a measure of
			improvement, or where a goal to perform an Action for at least a specified
			amount of time defines improvement.
		</p>
		<h4>Action Metrics</h4>
		<p>
			<i>
				TODO: More information on metrics coming soon, possibly moved to a
				future phase of development.
			</i>
		</p>
		
		<h4>General Activity/Action Framework Thoughts and Goals</h4>
		<p>
			The first goals for Activities and Actions revolve around finding generic
			ways to encourage and reinforce continued practice or repetitive
			engagement in actions that the user desires to do. A deeper analysis of
			the workflow and improvement on the UI will be done over time, in concert
			with studies on UI/UX development and Habit topics. Primarily this
			includes books like "Atomic Habits", "Ultralearning", "High Performance
			Habits", "7 Habits of Highly Effective People", "Indistractible", and
			"Hooked"; along with other contemporary literature.
		</p>
		<p>
			A main goal is to make the User feel involved and invested in their own
			process and subsequent success. Each step of the way they are encouraged
			by what they've done so far, and the continued effort to sustaining their
			progress should be made to not only feel possible and achievable; but
			highly likely. Failures should be encouraged and rewarded almost as
			readily as successes, as failure is often required in order to accomplish
			just about anything. Finding ways to support the User gradually reducing
			failure will be a key challenge with this system. Through encouraging the
			User to play an active role in planning and refining their Activities,
			Actions, Goals, and making the app enjoyable to use; it's expected that
			this failure reduction, acceptability, reward, regular use, and continued
			encouragement will be maximized.
		</p>
		<p>
			The act of defining what is needed to be done when preparing to practice a
			skill or complete a task can often be clear indicator in success. In
			"Ultralearning", the author explains that when approaching learning a new
			skill is highly recommended to explore the full scope of what's required
			to learn the skill. This sets the expectation for material to be covered
			and work required to realistic levels right away. Decomposing the larger
			concepts of a task into these smaller hierarchical labels of 'Activities'
			and 'Actions' can help to illustrate the relatively small effort required
			to get started with and continue a good habit. This is covered throughout
			"Atomic Habits", which explains that the key to picking up new positive
			desired habits or learning a new skill is substantially easier when they
			are viewed as smaller minor changes in behavior that add up over time.
		</p>
		<p>
			The process of the User being mainly responsible for creating and
			customizing their Activity/Action lists gives them control and stake in
			the process from the beginning. This way, the user is less intimidated by
			the unknown portions of the task and encouraged to write their own
			'instruction manual' for incremental success. They define how and when it
			will be done and they can be reminded to do it when it's scheduled through
			notifications, if required. Then, refine this process further over time,
			especially if higher than desired failure rates are encountered. The
			unknown and the failures in the process should be given the opportunity to
			be embraced and left to the user to discover the solutions for. A great
			deal of focus will be made to outline solutions of how to enable this
			process of discovery but will be ultimately guided by the social
			encouragement and guidance of other members in the app's social features
			(phase 4).
		</p>
		<br />
		<h3>Phase 2 - Experience/Skill rewards and Tasks</h3>
		<p>
			<i>Estimated time frame: June to August 2021</i>
		</p>
		<h4>Experience Points</h4>
		<p>
			This phase will incorporate a system of rewards to the app that are
			granted with the successful completion of Actions. The act of finishing
			any Action will reward Experience Points that contribute to the User's
			Level. This 'Level' will be an overall expression of the User's
			involvement in the app. Each level will have a certain amount of
			experience points required to achieve it. Once achieved the User will be
			rewarded with fun novelty prizes and other unique gifts that are yet to be
			determined.
		</p>
		<p>
			Normally in RPG video games, when the User's character levels up their
			statistic points like 'Strength', 'Stamina', 'Wisdom', etc. are increased.
			Sometimes this will be given as a set of points that can be assigned by
			the User, other times the statistics are simply added by the game engine
			automatically. It would be ideal to be able to add statistic points on
			Lvlz.app that reflect what type of Actions the User completed throughout
			the duration of the previous level when the User gains a new level. This
			concept will be more possible given the following 'skill point' system.
		</p>
		<h4>Skill Points</h4>
		<p>
			Each Activity and Action will be able to be assigned to one or more skill
			categories. These skill categories and the points earned within them will
			be an expression of the ability level that the User possesses as a result
			of repeatedly practicing or completing Actions. For instance, a skill
			category of Guitar Playing may be created and the Activity/Actions related
			to this skill like "Practice Guitar" and "Practice Scales for 30 minutes"
			the Guitar Playing skill may be assigned to them. Each completion of these
			Activities/Actions will give a chance to increase the Guitar Playing skill
			level. Eventually, given many hours of practice or study of Guitar related
			work should then result in the User having a 'Guitar Playing' skill of 100
			or 200. This skill point level of 200 will be a progression toward some
			level cap total point level that defines master professional Guitar
			Playing, like 1000 or 10000. These skill points may be a direct expression
			of hours spent playing, or since they have a percentage chance of increase
			with each Action completion, it may just be a less specific arbitrary
			number that just gives an idea of general aptitude.
		</p>
		<p>
			As the app continues to be developed and more structured default skill
			paths are included to the app in the future, more concrete skill points
			and ability levels can be created by professionals in various disciplines
			and added to the app. During this early work on the app, skill levels
			won't necessarily be scaled and computed to be perfect descriptions of
			actual real-life ability of the User.
		</p>
		<h4>Tasks</h4>
		<p>
			This phase will also focus on tasks. Tasks are mid-range goals which are
			defined as a change in habit or skill level that's achievable within
			approximately 2-3 months. They are milestones that can be linked to the
			repeated completion of Activities/Actions.
		</p>
		<p>
			<i>TODO: More information on tasks will be added here soon.</i>
		</p>
		<h3>Phase 3 - Quests and Inventory Systems</h3>
		<p>
			<i>Estimated time frame: August to November 2021</i>
		</p>
		<h4>Quests</h4>
		<p>
			Quests are long term goals that require more than a year to complete. They
			define the largest incremental progressive achievements that the User may
			plan for themselves on Lvlz, and require the completion of multiple Tasks
			and many, many Actions. Quests are things like 'Complete my First Year of
			High School', 'Complete my Bachelor's degree', or 'Become a Professional
			(xyz)'. They may be less official goals like 'Practice (Skill) for 10,000
			Hours' or 'Learn to Play Van Halen\'s "Eruption" Perfectly'.
		</p>
		<p>
			Although this is the last skill planning functionality to be phased in to
			Lvlz in this prototype, it's logical for this to be the first step a User
			will take in creating their own goals. A user will be able to sit down and
			think 'What do I want to accomplish?', and create a Quest from that
			thought. Then break that idea down into smaller portions to create Tasks
			and link them to the Quest. Next, they would break down that Task into
			daily or hourly Activities that should be done regularly. Finally, they
			would try to figure all the smallest Actions which should be done to
			complete that Activity.
		</p>
		<p>
			<i>TODO: More details on Quests will be coming soon</i>
		</p>
		<h4>Inventory System</h4>
		<p>
			In video games, especially RPGs, the player will often have an Inventory
			menu which lists all the weapons and armor that their character is
			wearing. Throughout their adventures in the game, they aquire new
			equipment and many other odds and ends that help them complete their
			goals.
		</p>
		<p>
			Just as the Quests, Tasks, Activities, and Actions are important to build
			a skill or accomplish a goal; so are the tools and items that are needed
			to get the job done. The Inventory System is all about keeping track of
			the equipment and items that the User has at their disposal.
		</p>
		<p>
			In every hobby, skill, or profession there's a general importance to be
			well versed in the equipment involved. Seasoned guitar players know all
			about their guitar, the brand and model, the electrical components like
			the pick-ups; their amplifier, it's speakers and settings; their effects
			pedals, thier settings and configurations. Welders know all about their
			tools and what's needed to get the job done; tattoo artists know all about
			their guns and needles, the inks, creams, transfer paper, and tracing
			light-box.
		</p>
		<p>
			At the onset, the Lvlz Inventory system can provide a way to keep track of
			your stuff in a private searchable database. This can obviously be useful
			for insurance or tax reasons if you goals involve a business, but also
			keeping track of what you use during your Activities so that you can stay
			stocked up. If your Activities involve creating or producing items, then
			the Inventory system can help keep track of what you have on hand. This
			may mean just being aware of your production efficiency or assisting with
			the sales of your items.
		</p>
		<p>
			During this prototype phase, these concepts will be explored and systems
			to handle multiple use cases will be tested.
		</p>
		<h3>Phase 4 - Social Platform and Activity Template Sharing</h3>
		<p>
			<i>Estimated time frame: November 2021 to December 2022</i>
		</p>
		<p>
			With the core systems of the app started and being perfected, the core
			social networking features of the app will be developed. This will include
			public user profiles; user to user interaction within Lvlz like messaging,
			friending, and commenting on others' resources; public user activity
			feeds; sharing Lvlz activity and achievements on popular social media
			sites.
		</p>
		<p>
			<i>
				More information on the Social Platform features will be added near the
				end of 2021.
			</i>
		</p>
		<h3>Phase 5 - Quest/Task/Activity Templates</h3>
		<p>
			<i>Estimated time frame: April 2022 to December 2022</i>
		</p>
		<p>
			Just because you have the desire to learn a new skill or practice a hobby
			doesn't necessarily mean you know all the best ways to complete that task.
			Lvlz can give you the tools to create your own practice regimens and line
			up your own activity/action lists, but if you're unsure of what to
			practice or do to gain mastery you may be inclined to put off beginning
			the process. Data entry isn't the most fun thing to do in the world.
			That's where Templates can help.
		</p>
		<p>
			A major component of what will make Lvlz a powerful tool for its users
			will be the ability to download and share pre-defined templates for
			Quests, Tasks, and Activities. Teachers, Experts, and Users who are
			experienced in a given skill or hobby will be able to create a template
			which defines all the Activities they think are required to gain mastery
			in it. Users who are looking for a starting point in that skill will be
			able to browse through a marketplace of templates on Lvlz and download
			them to begin their journey.
		</p>
		<p>
			In the case that Users want to learn how to play guitar, they may find a
			Guitar 101 template on Lvlz. Where a user may want to start learning how
			to program computers, they can browse through templates that can get them
			started like 'Introduction to JavaScript', or 'Advanced C++'. Guitar
			teachers can teach and monitor their students with their own custom made
			Quests, programming teachers at the local community college can assign
			homework on Lvlz that guides their students through assignments and
			practice exercises in the form of Tasks and Activities.
		</p>
		<p>
			<i>More information on Templates will be added in 2022</i>
		</p>
			<h3>Video Game Achievements</h3>
			<p>
				Over the last few decades, the video game industry has grown to a
				multi-billion dollar behemoth. With more than 3 billion gamers world-wide,
				spending over $150 billion dollars per year on their games, it's grown to
				be bigger than other entertainment industry segments like movies and
				music... COMBINED! After playing video games for most of my life, it's
				easy to see why.
			</p>
			<p>
				In video games, you can escape the real world and indulge yourself in
				entire universes of fantasy. You take on the role of highly skilled
				characters with unique powers in magical, unreal, circumstances. You
				aren't bound by the restrictions of real life, and everything you
				accomplish is rewarded. Modern games are built to keep you playing by
				balancing the challenges you face with the rewards you're given. They're
				designed to keep you entertained and stimulated, gratified and interested.
				Fulfilled. The most well designed games are engineered to bring you a
				feeling of "immersion", to make you feel like you're a part of the game
				through a combination of sensory engagement, cognitively demanding tasks,
				and an interesting narrative or story.
			</p>
			<p>
				Modern video games have now gotten so good that it can be easy for gamers
				to spend hundreds of hours per month playing them. Yet, spending as much
				time on productive things in everyday life can be a much more difficult
				endeavor. Over the years it's become a normal occurence for gamers to
				procrastinate on real-life responsibilities by exploring the imaginary
				fantasy world of "Skyrim", or engaging in hours of fast-paced gun-fights
				in "Call of Duty". With this in mind it's really made me wonder what my
				life would be like today if I'd spent my accumulated 20,000 hours of
				gaming on something more tangible and useful.
			</p>
			<p>
				What's interesting is that in some of these games, we aren't really doing
				anything all that interesting with our time. For instance, in MMORPGs like
				'World of Warcraft', 'Everquest', or 'New World' we're tasked with
				repeatedly doing the same quests and missions over and over in order to
				increase our character's level. We're gathering and combining items with
				tradeskills just to increase small aspects of our character's development.
				In FPS games like 'Call of Duty', 'Counterstrike', or 'Destiny' we're
				doing missions over and over to earn new equipment for our character, just
				to see our statistics slightly increase. Things like these take many
				dozens, if not hundreds, of hours to complete... and the only rewards
				amount to improving these numbers on our character's statistics score.
				Sometimes, we might quest for rare novelty items that don't serve any
				score increase - they only 'look cool' or are highly desired by other
				players for the sake of collecting them.
			</p>
			<p>
				In an online environment, completing all these game achievements garner
				some bragging rights amongst other players. As a low level player just
				starting out, you will look around and see higher level players with
				really amazing items, interesting abilities, and special titles. This will
				make you think, "Man, how did they get all that stuff? I want that!", and
				so begins the goal/achievement cycle that pushes the player to keep
				questing after the next step in their adventure. New players will go up
				against high skilled seasoned players, only to get absolutely decimated.
				This will make them wonder how they lost so badly and how they get better
				at playing the game - they'll look up straegy guides and YouTube tutorial
				videos that explain the advanced techniques to play the game better.
			</p>
			<p>
				Meanwhile, the many hours and days spent accomplishing these quests,
				missions, tasks, collections, or 'grinding' the repetative practice
				required to get better at playing the game will inevidably detract from
				progress in day-to-day life. If all that time spent playing video games
				was instead spent learning something fun like playing guitar, or rock
				climbing... then chances are more fulfilling opportunities would become
				available in life - people to meet and places to go! If it was spent
				building a new skill like welding, carpentry, or programming... then more
				job opportunities and chances for upward ecomonic advancement would become
				available. If it was spent completing schooling or training, taking care
				of responsibilities at home, or with family and friends... then the case
				could be made that life would continue to improve beyond anything that a
				video game could realistically offer.
			</p>
			-->
	</div>
</template>
<style scoped>
ul {
	list-style: none;
}
</style>
<script>
export default {
	name: "WhitePaperPage",
	data() {
		return {
			scrollOptions: {
				duration: 942,
				offset: 0,
				easing: "easeInOutCubic"
			}
		};
	},
	methods: {
		scrollTo(id) {
			this.$vuetify.goTo("#" + id, this.scrollOptions);
		}
	}
};
</script>
