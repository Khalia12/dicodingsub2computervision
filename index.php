<!DOCTYPE html>
<html>
<head>
    <title>Image Analyzation</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
</head>
<body style =  "padding:'10px'; font-family:'Arial'; background-color: RGB(235,233,194)">
 
<script type="text/javascript">
    function processImage() {
        // **********************************************
        // *** Update or verify the following values. ***
        // **********************************************
 
        // Replace <Subscription Key> with your valid subscription key.
        var subscriptionKey = "e04e1f8bb4024479afcc4bdeb52543d5";
 
        // You must use the same Azure region in your REST API method as you used to
        // get your subscription keys. For example, if you got your subscription keys
        // from the West US region, replace "westcentralus" in the URL
        // below with "westus".
        //
        // Free trial subscription keys are generated in the "westus" region.
        // If you use a free trial subscription key, you shouldn't need to change
        // this region.
        var uriBase =
            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
        // Request parameters.
        var params = {
            "visualFeatures": "Categories,Description,Color",
            "details": "",
            "language": "en",
        };
		var resultText = "";
        // Display the image.
        var sourceImageUrl = "https://khaliasub2storageacc.blob.core.windows.net/dataset-blob/sample.jpg";
        
        // Make the REST API call.
        $.ajax({
            url: uriBase + "?" + $.param(params),
 
            // Request headers.
	    
            beforeSend: function(xhrObj){
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader(
                    "Ocp-Apim-Subscription-Key", subscriptionKey);
            },
 
            type: "POST",
 
            // Request body.
            data: '{"url": ' + '"' + sourceImageUrl + '"}',
        })
 
        .done(function(data) {
	    alert('something here');
            // Show formatted JSON on webpage.
			result = JSON.stringify(data, null, 2);
			var desc = JSON.parse(result).description.captions[0].text;
            document.getElementById("desc").innerHTML = desc;
	    alert(result);
        })
 
        .fail(function(jqXHR, textStatus, errorThrown) {
            // Display error message.
	    alert('something terrible');
            var errorString = (errorThrown === "") ? "Error. " :
                errorThrown + " (" + jqXHR.status + "): ";
            errorString += (jqXHR.responseText === "") ? "" :
                jQuery.parseJSON(jqXHR.responseText).message;
            alert(errorString);
        });
    };
</script>
 
<h1>Image Feature Extraction</h1>
<p> Below is an image from Storage Account in Microsoft Azure</p>
<br>
<img src = "https://khaliasub2storageacc.blob.core.windows.net/dataset-blob/sample.jpg" border = "5px">
<p id="desc">Image Description</p><br><br>
<p>Click button below to get image description</p>
<button onclick="processImage()" style = "background-color:RGB(255,174,201); width : 80px; height : 80px; text-align: center">Extract</button>
</body>
</html>
