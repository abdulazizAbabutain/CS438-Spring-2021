# CS438-Spring-2021
this is Project for Internet Technologies CS438 in Imam Muhammad ibn Saud Islamic University
the member of this project are: <br> 

|         Student names          |
| :----------------------------: |
| Abdulaziz Abdulteef Ababutain  |
|   Mohammed Abdullah Alotaibi   |
| Abdulrahman Abdulaziz Albalood |
|    Aoudh Mohmmad alqahtani     |

Supervisor : 
Abdulrahman Alosaimy


# table of content
- **[Overview](##overview)**
- **[User Interaction](##User-Interaction)**
- **[test cases](##test-cesses)**



## overview
In this project we built an online Quiz web app which allows the users to register, login, and paly the quiz game, the web app has two sides, a client side and a server side, the client side contains HTML, CSS and JavaScript, the HTML and the CSS were used to as the user interface, the JavaScript was used also in the client side to handle the game logic, fetching questions and calculate the score, the server side we used php to handle registration, login in, and displaying the leaderboared, the leaderboared shows the rank of the user, the user name, and their score.

our goals in this project is to apply real world web development and use the most commonly technology , and building full web application functionally work.

some screen shot of  our project.
Home Page screen
<img src="Photos\HomePage_screanshot.PNG">
Game screen shot 
<img src="Photos\Game_screanshot.PNG">
log in screen shot 
<img src="Photos\LogIn_sreanshot.PNG">
Database screen shot
<img src="Photos\Database_creanshot.png">

## User Interaction
this the flow chart sequence from start the application until the user finish from it 

<img src="photo/../Photos/FlowChart.png" alt="FlowChart">
## test cases

| Test Case ID |   Test Scenario   |                                                 Test Steps                                                 |            Test Data             |         Expected Results          |          Actual Results          | Pass/Fail |
| :----------: | :---------------: | :--------------------------------------------------------------------------------------------------------: | :------------------------------: | :-------------------------------: | :------------------------------: | :-------: |
|     UT1      | check login valid |                     go to the website then enter the username and password than submit                     | username = test , password = 123 |          user should log          |          user logged in          |   pass    |
|     UT2      | check from score  | after passing test TU1 then play game after finishing the game the leaderbord should shows the  user score |     user =test , score = 30      | the score shows the highest score | page that display the user score |   pass    |