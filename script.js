function addData() {
    const inputData = document.getElementById("dataInput").value;
    if (inputData) {
        // Send the data to the server using AJAX
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                document.getElementById("result").textContent = inputData;
            }
        };
        xhr.send("data=" + encodeURIComponent(inputData));
    } else {
        document.getElementById("result").textContent = "Please enter data.";
    }
   
}
