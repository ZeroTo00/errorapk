<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>เช็คจำนวนคนเข้าเว็บ</title>
<script>
  let visitorCount = 0;

  window.onload = function() {
    visitorCount++;
    updateVisitorCount();
  };

  function updateVisitorCount() {
    const countElement = document.getElementById("visitorCount");
    countElement.textContent = visitorCount;
  }
</script>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
    text-align: center;
  }
  header {
    background-color: #333;
    color: white;
    padding: 10px;
  }
</style>
</head>
<body>
  <header>
    <h1>เว็บไซต์นับจำนวนคนเข้าเว็บ</h1>
  </header>
  <div>
    <p>จำนวนคนเข้าเว็บ: <span id="visitorCount">0</span></p>
  </div>
</body>
</html>
