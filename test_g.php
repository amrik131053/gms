<!DOCTYPE html>
<html>
<body onclick="showCoords(event)" style="border:1px solid black;padding:4px">

<h1>Mouse Events</h1>
<h2>The screenX, screenY, clientX and clientY Properties</h2>
<div>
<p>Click different places in this document to get the x (horizontal) and y (vertical) coordinates of the mouse pointer.</p>
<p id="demo">Coordinates:</p>
</div>

<script>
function showCoords(event) {
  let cX = event.clientX;
  let cY = event.clientY;
  let sX = event.screenX;
  let sY = event.screenY;
  let coords1 = "clientX: " + cX + ", clientY: " + cY;
  let coords2 = "screenX: " + sX + ", screenY: " + sY;
  document.getElementById("demo").innerHTML = coords1 + "<br>" + coords2;
}
</script>

</body>
</html>