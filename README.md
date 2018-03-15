INTRODUCTION
This project is an extention of a project I started a long time ago.  This project
aims to reduce the work for the employees of Gibson County Ambulance Service (GCAS) (AKA Gibson County
Emergency Medical Service [GCEMS]) to fully, completely, and accurately complete
their time sheets.

GCEMS is a small 24 hour county owned ambulance service.  We work 24 hour shifts, 
which introduces complexity into the time calculations.  Add, on top of that, our
union contract, and the calculations go to a whole new level.

DESCRIPTION OF PROBLEM
According to United States federal law, people who work 24 hour shifts can be docked 8 hours of
sleep time provided these people have the reasonable expectation to be able to get
at least 5 hours sleep.  During that 8 hour sleep time, if they are required to work
then they must be paid for their time.  If they do not get their 5 hours of sleep, 
then the employer must pay them for the entire 8 hours.  Our union contract stipulates
that we employees will be paid at a rate of 1.5 hours of our base rate.

We also have paid time off (PTO) days.  The categories for our PTO days are sick days,
vacation days, and personal days.  In addition to these common PTO days, we also
have little used days such as bereavement days.

Our holidays are also complicated.  For starters, each full-time employee gets
8 hours of holiday pay on the day of the holiday.  If the employee works on a holiday,
the employee will be paid at a rate of 1.5 times the base rate in addition to the 8
hours of holiday pay.

Considering all of this, we have yet to discuss the issue of overtime.  Hours spent
at work, over 40 hours in a week, will be paid at a rate of 1.5 x base.  The 8 hours
of holiday pay and the PTO days do not count towards the 40 hours, so they have to 
be tracked separately.

Prior to the completion of this project, we use pen and paper to complete our time
sheets.  We have a standard time sheet form which is filled out.  We then do the
calculations by hand.  At the end of the pay period, the time sheets are collected
by the Director of Operations.  He then audits the time sheets for accuracy and
completeness.  After this, he must produce reports to send to the Auditor's office
who then calculates taxes and issues paychecks.  

HISTORY OF PROJECT
In the 1970's, when this service was first started, they started using the system
mentioned above.  As technology progressed, a few people attempted to move
the system to spreadsheets and to word processor forms.  These had their own set
of issues which kept them from being widely used.  I was one of those people.

In 2017, I took an introduction to programming class through Excelsior College
(https://excelsior.edu).  After that class, I discovered JavaFX.  To help me
learn more about Java, JavaFX and programming in general, I sat out to create
way to make the above process easier.  I started building a JavaFX app which would
simply take the data from a two week pay period, as entered by the employee, and
produce a report in a format similar to the paper form.  The app was going to do
all of the calculations needed for the two weeks, but there was going to be no way
of saving the data or transfer it to the Director for his use.

A few months later, I took an introduction to database class.  In that class, we
had to do a project.  I decided to expand on the time sheet project.  I completed
the class and had a working MySQL database but no user interface.  Easy enough,
I thought.  I would simply take the JavaFX front end and adapt it to the database.

After talking to some of my co-workers, I decided I wanted this project to be web
based.  During my research for making my JavaFX project web based, I ran across
an article on Stack Overflow (https://stackoverflow.com) that the web based function-
ality of JavaFX was being depricated.  Now, I had to start over, once again.

After a month of research, trial and error, and false starts, I decided to write
the front end using PHP.  That is where I am today.  I am learning PHP and writing
this project.

ACKNOWLEDGEMENTS
__PHP and MySQL Web Development__ Fifth Edition,
written by Luke Welling and Laura Thomson.

https://www.eduonix.com/courses/Web-Development/learn-object-oriented-php-by-building-a-complete-website

https://www.martinstoeckli.ch/php/php.html#passwordreset