<?php 
/**
 * This is an Alpha pagecontroller.
 *
 */
// Include the essential config-file which also creates the $alpha variable with its defaults.
include(__DIR__.'/config.php'); 


// Define what to include to make the plugin to work
$alpha['stylesheets'][]        = 'css/slideshow.css';
$alpha['javascript_include'][] = 'js/slideshow.js';

$alpha['header'] = <<<EOD
<img class='sitelogo' src='img.php?src=reel_logo.jpg&amp;width=120&amp;height=120' alt='Picture' />
<span class='sitetitle'>REALREEL</span>
<span class='siteslogan'>Your movie partner</span>
EOD;

$alpha['above'] = <<<EOD

<a href="http://www.student.bth.se/~gani13/oophp/Kmom01/webroot/me.php">Kmom1</a> 

EOD;

// Do it and store it all in variables in the Alpha container.
$alpha['title'] = "Report Kmom1";

$alpha['main'] = <<<EOD

<h2>Kmom07: Gallery and Image Processing</h2>
<hr>
<p>Here is my report on course level 7.</p>
		


		
		
		
		
		
<h2>Kmom06: Gallery and Image Processing</h2>
<hr>
<p>Here is my report on course level 6.</p>

<p>Hi,</p>	

<p>This moment was difficult in terms of the complexity of the functions relevant to the image processing, however simple because 
the functions were already done, so the only thing I did really is once I had completed the guide, I transferred all the functions to 
their proper class for both the img and the gallery page controllers.</p>	

<p>I created the two classes as directed in the assignment, then I moved all the functions that were declared on the page 
controller. Then I instantiated the corresponding classes and call the methods in the classes instead.</p>	

<p>On one side, as to what it concerns the CGallery class I don't believe that I could have moved much more to the module. On the 
other side I feel that much more could have been done in regards to the CImage class. I started by creating functions to deal 
with the different parts such as read calculateDimension, createFileExtension, cropPicture, etc.. In each of these function I 
put all the pertinent code that is declared in the page controller. However,  I soon realized that it was going to be much 
work and having in mind  that I am running out of time I reverted the changes and I opted for the solution I have now. I hope 
that in the project I have some time left to make some refinements, such as making the img page controller a bit more lean by 
moving some more code  to its corresponding class. As for now, it feels that I am a vampyre and that the sun is coming up in 
the horizon... I better run  before I burn!</p>	

<p>Considering I have no previous experience in image processing this assignment was quite straight forwards. Although more 
complex in terms of coding I feel that it is much more effective and efficient to deal with image processing this way. The 
caching feature is really nice, and it kind of does away with the need to do all this image processing in advance. The php GD 
simplifies the process of image selection. I feel that I no longer have to spend time selecting, cutting, cropping , reducing 
quality, applying filters and so on. This little script does it all. I have read a bit into imageMagick and I would really 
like to know how it works,  I guess it  is also a good solution for image processing. Nevertheless, there are programs out 
there which deal with batch  image processing and are quite effective too.</p>	

<p>Regarding my Anax, I have now about 13 classes and I believe that it is much more developed. I feel confident that these 
exercises that  I have completed give me a head start in terms of the project. I only hoped I had a little more time,  I like 
testing in order to understand how everything works, and I normally click on every single function that is linked on Moss's 
guides, and that requires some time above all to read all the information on the php manual. I feel that I have been flying 
through the last part, but  hopefully during the project I will click some more ;=) </p>	

<p>I have noticed that arrays are used extensively, and that things that I did not think of, can be done with such constructs,  
to build a web page.  After all,  Anax is an array.  Which leaves me to think that I better get used to using arrays in php. I 
wonder  how other data structures could be deployed in the web  development process? </p>	

<p>As to modules missing in my Anax., I can say that a module dealing with file creation and file uploading would be very nice. 
In that way a page controller could be done departing from a basic template. I guess that with what I have learned so far this 
could be possible. In addition to it, another module could be, the one to provide links to each of these pages dynamically. In 
such away, the whole page creation process would be automatic, such as it is the case in some CMS such as Joomla or Drupal.</p>	
	
<p>Gabriel</p>		

<h2>Kmom05: Blog and PDO</h2>
<hr>
<p>Here is my report on course level 5.</p>

<p>This has so far been the most complicated Assignment.</p>

<p>In deed the modules are increasing. I think I mentioned before, one the one side it feels that all the stuff is well 
organized and localized, so when I need to update or fix something I know where to go and easily find it. However when it 
comes to the developing I feel that it is complicated. The php syntax, the queries, the html tags, make it a bit hard for 
me to track what is going on. If I follow the procedural way of programming, just as in C, I feel that I can work faster. 
However, I am probably lured in that it is easier because aside of the things I mentioned earlier, I don’t have much 
experience in php. Once I get used to it I am sure it I will prefer the OOP way rather than the procedural way. I see that 
what we are doing all along  is using  a design pattern which is called model view controller, in which separation of 
concern is essential. This is the reason why we are throwing the logic in the modules and then leaving the presentation to 
the page controller.</p>

<p>I did the guide first and I thought it was quite straight forward it followed the procedural way of programming . Most of 
the stuff required is in the guide, and the order in which to do things as well. However I stumbled upon trouble with 
small details. Particularly in the CContent class. It seems that the order of the parameters affects the 
way the data in the form is presented. However, I have been having trouble all along in returning the last inserted row.</p>

<p>What I have done is essentially throw all the functions that were in the page controller into the corresponding classes. I 
have thought of things to do that could probably minimize the code in the controller but as soon as I begun testing I 
noticed errors, as I did  not want to go astray from my objective and overdo floating around testing wasting time I 
focused on the most trivial things such as the Database side which I moved to the classes as much as I could. One thing to 
notice is that CBlog and CPage extend CContent and they can use the superclasse’s method methods.</p>

<p>There is one particular issue which haunted me and gave me a lot of trouble. In the beginning I set up my create 
controller to get the parameters, then pass them to a function addToDatabase, which would then request for example title, 
or slug, and then redirect with a function PDO::returnLastId() the last inserted id. This did not work despite testing and 
setting up the parameters and the statement values in the right order. The function returned id 0  not matter what, which 
is wrong, in other instances and without knowing I achieved that the first post would work but not the ones thereafter. I 
turned on the debug option on the ExecuteQuery Method and everything seemed to be working fine, all the parameters are 
passed alright. Then,  I tested moving around the order of the values in the query statement and the parameter array. To 
my surprise if I added more parameters it did work. So I moved all the code which gets the parameters to my function and 
there I decided to make a complete create form, that is, title, slug, url, page, data etc.. I decided to set all the 
parameters and the values in the order in which they show up in the form and it finally worked. This feels somewhat 
unnecessary, however it did work so as I am really running behind, I just left it like that. I hope that I can find a 
better solution for the project.</p>


<p>I think that everything that does not have to do with the presentation is movable from the page controller to the classes, 
in the page controlle there should only be calls to the methods on the classes. So I feel that I could still have a number 
of modules, even a generateOuput method in a for example a COutput class which would create the tags and call the 
parameters in the main section of the anax array another example could be another class which deals with parameters. It 
would be nice to have all the parameters in one place, I notice that some of these parameters are repeated throughout the 
different side controllers. And one of the good programming practices and premises of OOP design patterns is to avoid code 
repetition. These parts could be abstracted into a class.</p>

<p>Gabriel</p>
		

<h2>Kmom04: Blog and PDO</h2>
<hr>
<p>Here is my report on course level 4.</p>

<p>This assignment was fun, I started by developing my own constructs, however in the end I felt that I got carried away, I got 
scared when I compared my code with the example guide, besides I spent a long time trying to solve errors and I realized that 
I was trying to do many things much more complicated than what they really were. Because of this I decided to take a step back 
and re do the assignment departing from the example code so I basically made the classes with code from the example code.</p>

<p>I had done PDO in the previous course, but it feels different this time, more complicated. This is probably because we also 
have an additional layer of object orientation and things don�t exactly happen as in the procedural way. For example the 
prepared statement is taken care of by the method ExecuteQuery in the CDatabase class whereas in the procedural way it would 
happen sequentially in the same place. Although I have programmed in Java and C# and I understand object orientation, the php 
programming language reminds me of C a lot and I sometimes get confused and want to do things in the procedural way, this is 
why I think it is somewhat complicated. In other words, although in another language such as Java or C# I appreciate the 
straightforwardness of the object orientation, with php and in particular PDO I feel that it gets even more complex. Added to 
it all the tags and mixture of HTML and SQL and the php syntax itself, I really have to digest a few hours before I see what 
is going on. This is probably a matter of practice, but right now it feels like that.</p>

<p>The guide was straightforward, I believe it is done the procedural way, then the responsibility for applying the object 
orientation lays upon us. Doing the guide however I gained insight into what is to be done. In most of the cases the 
transition from the procedural to the object orientation is trivial but in other it is somewhat more complicated specially 
when it involves many database transactions.</p>

<p>Regarding the modules for the Anax, it brings me back to what I stated above, having things out of sight makes things more 
complicated for me. The procedural way with PHP feels easier because I have all the data in sight in the same page controller, 
I have a bad tendency to associate php with C and perhaps it is not well founded, but with all the different things one has to 
worry about, the prepared statements, the html tags and the php code syntax itself it feels as if I wanted to have things in 
sight in order to be able to put them into perspective. In terms of organizing the code it is very neat to have it divided in 
different classes. I can see that if I want to go back and change or fix something I can quickly do so referring back to the 
class responsible for each behavior.</p>

<p>/Gabriel</p>

		

<h2>Kmom03: Movie DB - prepared statements clients and MySQL</h2>
<hr>
<p>Here is my report on course level 3.</p>

<p>During this part of the course I have installed the different Mysql modalities, that is , phpMyAdmin, Mysql for Windows and also the 
command line based mysql for Linux which is the one I prefer.

<p>I had used the book Databasteknik at an earlier course so I decided to read it again, aside of the courses book Beginning PHP and MySQL. I 
had not forgotten all the way how to design databases so when I went to read the suggested literature Kokbok för databasmodellering, the 
conceptual modeling phase reminded me of the Chen notation to design datbases which I had forgotten a bit and it is well explained in the 
the book Databasteknik, so I took the chance and decided to review that as well. It was very interesting to know how to go from designing 
the database schema with the Chen notation as specified in the book, to  EER model. The part with foreign keys and primary keys was 
central I think.</p>

<p>As for the queries to the database I thought that they are almost the same as SQL I have used Microsoft SQL Server Management Studio 
together with Microsoft SQL Server 2008R2 before and with it created my own queries which are pretty much similar to MySQL. In addition to 
this I have in the recent past utilized Windows Access to create databases, it is an intuitive tool but I prefer Microsoft SQL Server 
Management Studio and to do everything from the ground with queries. It is a great way to get used to SQL. As the book Databasteknik 
mentions there might be slight  differences arising between database management systems because although SQL is standardized, not all of 
them follow the standards. In any case the similarities are great.</p>

<p>When it comes to the lab environment I also have installed a Debian copy which I use as my development environment, in it there is 
installed the command based MySQL version and I have also added phpMyAdmin, everything straight forward.</p>

<p>Regarding the database exercise,  I had earlier done another exercise in the book databasteknik, chapter 7 itself is a whole exercise on a 
database which I decided to create from the ground myself using the command line based MySQL in Debian. However, when it comes to the 
exercise Kom igång med SQL I decided to go for MySQL workbench for windows which I had never used before. I wander if it is okay to use 
lower case letters for the queries, it is somewhat cumbersome to switch constantly from lower case to upper case and vice-versa. Aside of 
it I found the interface very nice, very intuitive and up to now I have used DIA a graphing tool to model my databases which I really like 
but the one included in MySQL workbench is perfectly fine, the only thing I did not see is the possibility to design with entity 
relationships with the Chen notation but it might be hidden somewhere in there. Aside of all this I did not come across major difficulties 
in doing the exercise.</p>

<p>One thing I wander however, when I installed the workbench I went for the huge installation, the one that contains everything, I wonder if 
it will interfere with my Microsoft SQL Server in any way or if it can coexist without problems, I guess I will find out when I start 
another ASP.NET project. </p>

		
		

<h2>Kmom02: Menu, Anax, Etc...</h2>
<hr>
<p>Here is my report on course level 2.</p>

<p>This one was a bit nightmarish, I had trouble with the syntax, it reminded me a bit of C but I have been programming for long now in Java, so I 
had to get used to it just a bit no problem. 
I wanted to put the result of each hand in an array and then sum the elements of the array with the build in function which there is in php, 
however for reasons that I did not understand yet, the output was wrong. I think it has to do with the sessions and the way I use the POST
super global which is the method I used, so I did not achieve the intended outcome until I started to remember that those have to be set, 
otherwise there is no way to pass the values back and forward from one state to the other,  I am lagging a bit behind so the outcome is not 
totally what I had wanted. I am not happy with the code, it feels more like a first cast but it works. Then I wanted to have done the other 
exercise as well but I feel that I have to march forwards now, if I advance quickly a couple of assignments more then I might go back and do it. 
Now is the time to learn PHP.</p>

<p>When it comes to the object orientation I feel comfortable with it because I have by now taken extensive coursework in Java, and C# and C++, 
however the syntax in PHP feels a bit confusing in the beginning it is very similar to C but not quite, again mixing the html part with the scripting code is confusing to me, added 
to that one has to consider other things such as super global variables, cookies  and all that.</p>

<p>I read first the book and then the guide, these guides are very helpful because you get to see the same there is in the book but from a 
different angle, which is sometimes what I need to understand something fully. So what I do is read the book and then the guides before every 
assignment specially the PHP guide.</p>

<p>In order to solve the problem I started by dividing tasks in classes, one class for applying the pictures, one to make calculations, and one to 
roll the dice which is essentially Mikael’s dice example. These classes encapsulate the behavior of the program which is then accessed by 
accessors and mutators. I Use three buttons, each are set by a corresponding POST and if they are set the first button from the left performs 
the throw, the second button saves the points, and the third one resets the game. I chose post because I remembered that one could send more 
information than get in a more secure way, and this was the reason why it was used with forms, so I used a form to pass the values through the 
POST super global. </p>

<p>BR</p>



<h2>Kmom01: Menu, Anax, Etc...</h2>
<hr>
<p>Here is my report on course level 1.</p>

<p>The development of the framework in this level was very interesting, as it is the basic 
foundation for the site I named mine alpha</p>

<p>During the development of Anax I run into somne trouble with the dynamic menu which took longer than what I 
had expected to implement it. I could understand the notion of callback in addition mixing 
html and php, was confusing, forexample passing a paramenter which points to a navigation 
bar to a function. I guess it is just a matter of getting used to it but it confuse me in 
the beginning. In this section I have reused some code from the previous course, more 
concretely the inline footer and also some parts of the css style sheet.</p>

<p>I read all the material at least twice it is very throgoughly structured and I feel that
there is a log of stuff to remember so I tend to browse throgh the 20 steps to php every time
I start a project</p>  

<p>I have used subversion with java so I decided to learn how to use GitHub,  was straight 
forward, it is intuitive and very nice,  so I spent some time forking my me site on GitHub.</p>


<article>Operating environment:
Windows 7 | Firefox | Note++ | WinSCP</article>


EOD;

$alpha['footer1'] = <<<EOD
<footer><span class='sitefooter'>Copyright (c) Gabriel Nieva (bluetxxth@gmail.com) | <a href='https://github.com/mosbth/Alpha-base'>Alpha på GitHub</a> | <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span></footer>
EOD;
$alpha['footer2'] = <<<EOD
<footer></footer>
EOD;


// Finally, leave it all to the rendering phase of Alpha.
include(ALPHA_THEME_PATH);