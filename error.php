<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	function unichr($u) {
		return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
	}
	$_err = [
		"200" => [
			[
				"link" => "http://bfy.tw/gxE",
				"name" => "200 OK",
				"silly" => ">.> Why did i make an exception for this again? XD",
				"type" => "success",
				"messages" => [
					"Standard response for successful HTTP requests.",
					"The actual response will depend on the request method used.",
					"In a GET request, the response will contain an entity corresponding to the requested resource.",
					"In a POST request, the response will contain an entity describing or containing the result of the action."
				]
			]
		],
		"400" => [
			[
				"link" => "http://bfy.tw/6WKq",
				"name" => "400 Bad Request",
				"silly" => "Houston, we have a problem.",
				"type" => "client",
				"messages" => [
					"The server cannot or will not process the request due to an apparent client error (e.g., malformed request syntax, invalid request message framing, or deceptive request routing)."
				]
			]
		],
		"401" => [
			[
				"link" => "http://bfy.tw/3PQC",
				"name" => "401 Unauthorized (RFC 7235)",
				"silly" => "Do you have permission to be here? >_>",
				"type" => "client",
				"messages" => [
					"Similar to 403 Forbidden, but specifically for use when authentication is required and has failed or has not yet been provided.",
					"The response must include a WWW-Authenticate header field containing a challenge applicable to the requested resource.",
					"401 semantically means \"unauthenticated\", i.e. \"you don't have necessary credentials\"."
				]
			]
		],
		"403" => [
			[
				"link" => "http://bfy.tw/3PQH",
				"name" => "403 Forbidden",
				"silly" => "Trying to do something funny? >_>",
				"type" => "client",
				"messages" => [
					"The request was a valid request, but the server is refusing to respond to it.",
					"Unlike a 401 Unauthorized response, authenticating will make no difference."
				]
			]
		],
		"404" => [
			[
				"link" => "http://bfy.tw/3PQI",
				"name" => "404 Not Found",
				"silly" => ">.> you trying to find something I don't even have ha good luck :P",
				"type" => "client",
				"messages" => [
					"The requested resource could not be found but may be available again in the future.",
					"Subsequent requests by the client are permissible."
				]
			]
		],
		"405" => [
			[
				"link" => "http://bfy.tw/5CPH",
				"name" => "405 Method Not Allowed",
				"silly" => "Sorry, but i don't Like it in the Butt. "  . implode(array_map('unichr', [40, 32, 865, 176, 32, 860, 662, 32, 865, 176, 41])),
				"type" => "client",
				"messages" => [
					"A request method is not supported for the requested resource; for example, a GET request on a form which requires data to be presented via POST, or a PUT request on a read-only resource."
				]
			]
		],
		"410" => [
			[
				"link" => "http://bfy.tw/6WKy",
				"name" => "410 Gone",
				"silly" => "Hit the wall i have",
				"type" => "client",
				"messages" => [
					"Indicates that the resource requested is no longer available and will not be available again.",
					"This should be used when a resource has been intentionally removed and the resource should be purged.",
					"Upon receiving a 410 status code, the client should not request the resource in the future.",
					"Clients such as search engines should remove the resource from their indices.",
					"Most use cases do not require clients and search engines to purge the resource, and a \"404 Not Found\" may be used instead."
				]
			]
		],
		"418" => [
			[
				"link" => "http://bfy.tw/3PQM",
				"name" => "418 I'm a Teapot (RFC 2324)",
				"silly" => "No anime for you. :P",
				"type" => "client",
				"messages" => [
					"This code was defined in 1998 as one of the traditional IETF April Fools' jokes, in RFC 2324, Hyper Text Coffee Pot Control Protocol, and is not expected to be implemented by actual HTTP servers."
				]
			]
		],
		"unknown" => [
			[
				"link" => null,
				"name" => "Unknown",
				"silly" => "HUE HUE HUE You got me. I don't know this error. " . implode(array_map('unichr', [40, 32, 865, 176, 32, 860, 662, 32, 865, 176, 41])),
				"type" => "unknown",
				"messages" => [
					"This error has not been configured yet HUE HUE HUE.",
					implode(array_map('unichr', [40, 32, 865, 176, 32, 860, 662, 32, 865, 176, 41]))
				]
			]
		]
	];

	function isParam($l) {
		return (isset($_GET[$l]) && !empty($_GET[$l]));
	}

	function ecode() {
		if(isParam('e')) {
			return $_GET['e'];
		} else {
			return "418";
		}
	}

	$image = isParam('i') ? $_GET['i'] : null;
	$funny = isParam('f') ? $_GET['f'] : null;
	$title = isParam('t') ? $_GET['t'] : null;
	$error = (isParam('e') && array_key_exists($_GET['e'], $_err)) ? $_GET['e'] : "unknown";
	$code = ecode();
	http_response_code(intval($code));
	$er = $_err[$error];
	$e = $er[array_rand($er)];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head profile="http://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			<?php
				if($title) {
					echo "{$title} | {$e["name"]}";
				} else {
					echo "{$e["name"]}";
				}
			?>
		</title>
		<link rel="stylesheet" type="text/css" media="all" href="/error.css" />
	</head>
	<body>
		<div style="margin: 20px auto; width: 900px;">
			<?php
				if($image) {
			?>
			<img src="<?php echo $image; ?>" max-width="400" alt="" style="margin-bottom: 15px;" />
			<?php
				}
			?>
			<div class="notice">
				<center>
					<h1>
						<?php
							if ($e["link"]) {
						?>
						<a href="<?php echo $e["link"]; ?>"  target="_blank">
							<?php echo $e["name"]; ?>
						</a>
						<?php
							} else {
								echo "{$code} {$e['name']}";
							}
						?>
					</h1>
					<hr>
					<h2>
						<?php 
							if ($funny) {
								echo $e["silly"];
						?>
						<hr>
						<?php
							}
						?>
						This is a <?php echo $e["type"]; ?> error.
						<hr>
						<?php echo join("<hr>", $e["messages"]); ?>
					</h2>
				</center>
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
				<!-- a padding to disable MSIE and Chrome friendly error page -->
			</div>
		</div>
		<!--Not Christmas damnit script type="text/javascript" src="/j/snowstorm.js"></script-->
	</body>
	<footer>
		<a href="/">Home</a><br/>
		<font size="1">Error Page &copy;2013-2016 Belldandu All Rights Reserved.</font>
		<?php
			$ip = $_SERVER['REMOTE_ADDR'];
			$host = gethostbyaddr($ip);
			echo "<h2>Your IP address : {$ip} | Your hostname : {$host}</h2>";
		?>
	</footer>
</html>
