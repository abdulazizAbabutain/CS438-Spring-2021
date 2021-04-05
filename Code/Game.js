//Get ids and classes from Game.html

const question = document.getElementById("quesiton");
const choices = Array.from(document.getElementsByClassName("choice-text"));
const progressText = document.getElementById('progressText');
const answerScore = document.getElementById('score');
const progressBarFull = document.getElementById('progressBarFull');
const loader = document.getElementById('loader');
const game = document.getElementById('game');

//Questions informations and the score

let currentQuestion = {};
let acceptingAnswers = true;
let score = 0;
let questionCounter = 0;
let availableQuestions = [];
let questions = [];

//Constants

const CORRECT_BONUS = 10;
const MAX_QUESTIONS = 10;

//Get questions from Open Trivia Database(Trivia API) "https://opentdb.com/"
//For more informations about (fatch) "https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/Using_Fetch"

fetch(
    //Get questions from this resource 
    "https://opentdb.com/api.php?amount=10&category=9&difficulty=easy&type=multiple")
    .then(contentResponse => {
        //Extract the JSON body content from the response
        return contentResponse.json();
    })
    .then(uploadedQuestions => {
        //Check the results
        //console.log(uploadedQuestions .results);

        //Questions array will have for every question (question, number of correct answer, choices(1,2,3 and 4))
        questions = uploadedQuestions.results.map(uploadedQuestion => {
            //console.log(uploadedQuestion.question);
            //coordinatedQuestion object will have the question from uploadedQuestion.question
            const coordinatedQuestion = {
                question: uploadedQuestion.question,
                answer: ''
            };

            //console.log(uploadedQuestion.incorrect_answers);
            //Get the incorrect answers for this question
            const answerChoices = [...uploadedQuestion.incorrect_answers];
            //Make the correct answer get a random place
            coordinatedQuestion.answer = Math.floor(Math.random() * 3) + 1;
            answerChoices.splice(coordinatedQuestion.answer - 1, 0, uploadedQuestion.correct_answer);

            //For each choice, add the choice to the coordinatedQuestion Object as follows
            answerChoices.forEach((choice, index) => {
                coordinatedQuestion["choice" + (index + 1)] = choice;
            })
            // console.log(coordinatedQuestion);
            return coordinatedQuestion;
        });
        //Start the game
        startGame();
    })
    .catch(err => {
        console.error(err);
    });

//Start game 

startGame = () => {

    questionCounter = 0;
    score = 0;
    availableQuestions = [...questions];
    getNewQuestion();
    //After loading the question, remove the (loader) and display the question
    loader.classList.add('hidden');
    game.classList.remove("hidden");

};

//Get (new/next) question

getNewQuestion = () => {

    if (availableQuestions.length == 0 || questionCounter.length >= MAX_QUESTIONS) {
        // localStorage.setItem("mostRecentScore", score);
        /*
        //Send score variable to php to store in databases
        window.location.href = "location.php?score=" + score;
        */

        //Go to the end page 
        return window.location.assign("GameMenu.html"); //Need to change the end location to (end.html or GameMenu.html)
    }

    questionCounter++;
    //Update the progress text
    progressText.innerText = "Question " + questionCounter + "/" + MAX_QUESTIONS;
    //Update the progress bar
    progressBarFull.style.width = (questionCounter / MAX_QUESTIONS) * 100 + "%";
    //Get a question randomly from the available questions
    const questionIndex = Math.floor(Math.random() * availableQuestions.length);
    currentQuestion = availableQuestions[questionIndex];
    //Update the question
    question.innerText = currentQuestion.question;
    //For each choice get the data-number from Game.html and then update the choices
    choices.forEach(choice => {
        const number = choice.dataset['number'];
        choice.innerText = currentQuestion['choice' + number];
    });
    //Delete the question from the available question
    availableQuestions.splice(questionIndex, 1);
    acceptingAnswers = true;
};

//For each choice in Game.html add this event

choices.forEach(choice => {
    choice.addEventListener("click", c => {
        if (!acceptingAnswers) return;
        // Get the choice target(location) 
        acceptingAnswers = false;
        const selectedChoice = c.target;
        const selectedAnswer = selectedChoice.dataset["number"];
        //Check in the selected answer is correct or not
        const classAction = selectedAnswer == currentQuestion.answer ? "correct" : "incorrect";
        //If it's correct add bonus to score
        if (classAction == "correct") {
            incrementAnswerScore(CORRECT_BONUS);
        };
        //Add the (correct/incorrect) class to choice-text
        selectedChoice.parentElement.classList.add(classAction);
        //Wait then do this
        setTimeout(() => {
            selectedChoice.parentElement.classList.remove(classAction);
            getNewQuestion();
        }, 1000);


    });
});

//Add bonus to score

incrementAnswerScore = s => {
    score += s;
    answerScore.innerText = score;
};