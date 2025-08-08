<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Activity Detection</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    h1 {
      margin-bottom: 20px;
      color: #333;
    }
    #activity-container {
      text-align: center;
      border: 2px solid #ccc;
      padding: 20px;
      border-radius: 10px;
      background: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    #activity-image {
      max-width: 300px;
      height: auto;
      margin-bottom: 15px;
    }
    #activity-label {
      font-size: 24px;
      font-weight: bold;
      color: #444;
    }
    .buttons {
      margin-top: 20px;
    }
    button {
      margin: 5px;
      padding: 10px 20px;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <h1>Museum Activity Detection</h1>
  <div id="activity-container">
    <img id="activity-image" src="https://via.placeholder.com/300x200?text=Standing" alt="Activity" />
    <div id="activity-label">Standing</div>
    <div class="buttons">
      <button onclick="setActivity('standing')">Standing</button>
      <button onclick="setActivity('walking')">Walking</button>
      <button onclick="setActivity('running')">Running</button>
    </div>
  </div>

  <script>
    const activityImages = {
      standing: "https://via.placeholder.com/300x200?text=Standing",
      walking: "https://via.placeholder.com/300x200?text=Walking",
      running: "https://via.placeholder.com/300x200?text=Running"
    };

    function setActivity(activity) {
      document.getElementById('activity-image').src = activityImages[activity];
      document.getElementById('activity-label').textContent = activity.charAt(0).toUpperCase() + activity.slice(1);
    }
  </script>

</body>
</html>
