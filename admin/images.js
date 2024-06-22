var postContent;
document.getElementById('send').addEventListener('click', function() {
    // Step 2: Extract all images and convert them to base64
    var images = document.querySelectorAll('.content img');
    var imageArray = [];
    images.forEach(function(image) {
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        canvas.width = image.width;
        canvas.height = image.height;
        context.drawImage(image, 0, 0, image.width, image.height);
        var base64 = canvas.toDataURL('image/jpeg');
        imageArray.push(base64);
    });

    // Step 3: Send base64 images to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/posts/upload.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            // Step 4: Replace base64 content with image names
            var imageNames = JSON.parse(xhr.responseText);
            images.forEach(function(image, index) {
                image.src = imageNames[index];
            });
 
            // Step 5: Prepare data to be sent to the database
             postContent = {
                textContent: document.querySelector('.content').innerText,
                imageNames: imageNames
            };
        }
    };
    xhr.send(JSON.stringify(imageArray));
});
