<!DOCTYPE html>
<html>
  <head>
    <title>Chat</title>
   <link rel="icon" type="png" sizes="16x16" href="icon.png">
    <meta name="description" content="Chatshell"/>
    <link href="style.css" rel="stylesheet"/>

	
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
  </head>
<body>
<?php
require_once('Messages.php');

$messages = new Messages(0);
$data = $messages->fetch('username, message');

?>
<form>

<textarea readonly>

<?php
foreach ($data as $row) {
  $msg = htmlentities($row['message'], ENT_QUOTES, 'UTF-8');
  echo $row['username'] . "> " . $msg . "\n";
}
?>
</textarea>


<input placeholder="Enviar mensaje"/>
		 
<input style='color:red;font-size:15px;' name="browse" type="file"  id="fileToUpload" onchange="upload_image();"/>
<div class="upload-msg"></div><!--Para mostrar la respuesta del archivo llamado via ajax -->
	




</form>

		
		


<script>
function send(username, message) {
   const data = new URLSearchParams();
   data.append('username', username);
   data.append('message', message);
   return fetch('new.php', {method: 'POST', body: data}).then(r => r.text());
}
const textarea = document.getElementsByTagName('textarea')[0];
const input = document.getElementsByTagName('input')[0];
const form = document.getElementsByTagName('form')[0];
let username;
while (true) {
    username = prompt("¿Cuál es tu nombre?");
    if (typeof username === 'string') {
        username = username.trim();
        if (username) {
            break;
        }
    }
}
form.addEventListener('submit', function(e) {
    e.preventDefault();
    send(username, input.value);
    input.value = '';
});
const eventSource = new EventSource('stream.php');
eventSource.addEventListener('chat', (e) => {
    var data = JSON.parse(e.data);
    textarea.value += '$' +data.username + '> ' + data.message + '\n';
    textarea.scrollTop = textarea.scrollHeight;
});

console.log(username);
    </script>
	
	
	 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script>


	function upload_image(){//Funcion encargada de enviar el archivo via AJAX
				$(".upload-msg").text('Cargando...');
				var inputFileImage = document.getElementById("fileToUpload");
				var file = inputFileImage.files[0];
				var data = new FormData();
				data.append('fileToUpload',file);
				
				/*jQuery.each($('#fileToUpload')[0].files, function(i, file) {
					data.append('file'+i, file);
				});*/
							
				$.ajax({
					url: "upload.php",        // Url to which the request is send
					type: "POST",             // Type of request to be send, called as method
					data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
					contentType: false,       // The content type used when sending data to the server.
					cache: false,             // To unable request pages to be cached
					processData:false,        // To send DOMDocument or non processed data file it is set to false
					success: function(data)   // A function to be called if request succeeds
					{
						$(".upload-msg").html(data);
						window.setTimeout(function() {
						$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
						$(this).remove();
						});	}, 5000);
					}
				});
				
			}
</script>
	
	
	
	
	
	
	
	
	
	
  </body>
</html>
