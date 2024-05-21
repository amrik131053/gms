<!DOCTYPE html>
<html>
<head>
    <title>5-Second Timer</title>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>5-Second Timer</h1>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Time remaining: <span id="timer">5</span> seconds</p>
        </div>
    </div>

    <script>
       
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        window.onload = function() {
            modal.style.display = "block";
            startTimer();
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        function startTimer() {
            var timeLeft = 5;

            var countdown = setInterval(function() {
                document.getElementById("timer").innerHTML = timeLeft;
                timeLeft -= 1;
                if (timeLeft < 0) {
                    clearInterval(countdown);
                    modal.style.display = "none";
                    // alert("Time's up!");
                }
            }, 1000);
        }
    </script>
</body>
</html>
