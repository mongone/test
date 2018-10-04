<?php 

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->queryResult->parameters->text;

	switch ($text) {
		case 'hi':
			$speech = "Hi, Nice to meet you";
			break;

		case 'bye':
			$speech = "Bye, good night";
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;
		
		default:
			$speech = "Sorry, I didnt get that. Please ask me something else.";
			break;
	}
	$messages = '[
			    {
			      "card": {
				"title": "card title",
				"subtitle": "card text",
				"imageUri": "https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png",
				"buttons": [
				  {
				    "text": "button text",
				    "postback": "https://assistant.google.com/"
				  }
				]
			      }
			    }
			  ]';
	$response = new \stdClass();
	$response->fulfillmentText = $speech;
	$response->fulfillmentMessages = $messages;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
    echo "Method not alloweds";
}

?>
