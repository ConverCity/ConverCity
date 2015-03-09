## Convercity
### An SMS 311 Conversation Platform

### View example deployment at https://mysterious-tor-1649.herokuapp.com/

### Employed Technology

#### [Larvel PHP Framework](http://laravel.com)

While in the hackathon/prototype mindset we used Laravel to provide a rapid development environment where we could rely heavily on its MVC framework and RESTful controller methodology.

#### [Twilio](https://www.twilio.com/)

We used Twiliio through it's API to both send incoming text messages into the application and process sending replies.

#### [D3.js](http://d3js.org/)

The D3js library has been employed so far in just one element of Convercity, a word cloud of raw text responses to question. However, as the app continues to be developed we intend to use D3 heavily to provide data visualization and mapping.

#### [JQuery](http://jquery.com/)

JQuery is used throughout the interface to facilitate AJAX calls.

#### [Bootstrap by Twitter](http://getbootstrap.com)

For prototyping we utilized Twitter's Bootstrap library for the UI

#### [Heroku](http://www.heroku.com)

The application is currently hosting on Heroku using a ClearDB SQL Database


### Existing functionality

#### Natural language interpretation

Convercity can receive natural language text messages, dissects the message, and return response or clarifying questions without forcing users into using multiple choice option trees. This logic is contained in our [SMS311 facade.](https://github.com/ConverCity/ConverCity/blob/master/app/SMS311.php) Essentially, the process scores the message one point for each matching word in the message against a list of keywords for each potential response. Which even response ends with the highest response is returned to the user.

#### Data Capture

All messages sent into the system are processed from the [SMS Interface](https://github.com/ConverCity/ConverCity/blob/master/app/Http/Controllers/SmsController.php) which will look for a citizen record in the database (based on their phone number) and then begin to log the interaction. If a citizen doesn't reply immediately, Convercity will remember where the conversation left off and evaluate answers against the last communication before deciding to begin a new communication.

Administrators can create specific data points they are interested in investigating, such as, if domestic abuse victims have access to places where the can find safety.  That data point can then be attached to a question and each response to the question can be evaluated for how it should be recorded against the data point.

Every communication is stored in its raw form and associated with the message it was responding to, the message that came after it, and the citizen who sent it. This will allow us to create a data visualization interface that will be able to dig into conversation archives to search for data points rather than only viewing data after a data point is created.

#### Question Tree 

City Administrators have access to an editing interface where they can create and edit responses, keywords, and data points through a point and click interface easily understanding the logic in play at each step of the tree.

### Future functionality

#### IBM Watson Integration

To better enable accurate routing between questions, we plan to overlay IBM's Watson technology on top of the SMS routing facade.  Watson will consume the natural text and route to a specific response based on the keywords of potential replies.

#### D3js Visualization

A data visualization section of the application will allow city users to quickly generate pages with topic specifics with D3 generated charts and visualizations.
