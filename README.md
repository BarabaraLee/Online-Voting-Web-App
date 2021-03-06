# Online-Voting-Web-App

This is an online voting system with an administration panel. Web administrators in the admin panel can view the user (voter) information, edit the user information, as well as delete the user records.
The users should register with their personal information in order to vote (and the voting results will be updated in the database). Voting results can be shown immediately after voting, with counts and percentages. 

Three tables are saved in a database named 'php' in order to save different information. The 'musicians' table is used to store the voting result for each musician/pop star (Justin Bieber, Jay Chou and Shawn Mendes). The 'admin' table is used to store the login information for the web administrators in the admin panel. And the 'register_user' table is used to store the users' personal information (collected upon their registration).

This web application is built under the LAMP framework.

Note: 

1. The purpose of developing this web app is to facilitate a digital research project studying the popularity of the pop stars from different backgrounds. (Justin Bieber and Shawn Mendes are from the same country, and we should replace one of the two with a pop singer from another country or even another continent.)

2. The online registration and admin panel functionalities are the same as those of 'Online-Registration-with-Administration-Panel' web app, whose source code can also be found in BarabaraLee's github.

3. It is required that each voter can vote for only one musician, and only one time. The requriements are not implemented into the source code considering the possibility of future change of requirements. (One can set up a 'vote_status' column in the 'register_user' table to enforce the mentioned requriements.)

4. See the folder 'OnlineVotingWebAppDemo' for the demonstration of using this web app, with screenshots.


Linjun Li - Virginia Tech
