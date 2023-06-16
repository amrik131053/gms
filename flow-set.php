<!DOCTYPE html>
<html>
<head>
  <style>
    .drag-list {
      list-style-type: none;
      margin: 0;
      padding: 0;
      width: 200px;
    }
    
    .drag-item {
      background-color: #f1f1f1;
      border: 1px solid #ccc;
      padding: 8px;
      margin-bottom: 4px;
      cursor: move;
    }
    
    .drag-item:hover {
      background-color: #e0e0e0;
    }
    
    .drag-list:hover .drag-item {
      background-color: #f1f1f1;
    }
    
    .drag-list:hover .drag-item:hover {
      background-color: #e0e0e0;
    }
  </style>
  <script>
    function allowDrop(event) {
      event.preventDefault();
    }
    
    function drag(event) {
      event.dataTransfer.setData("text", event.target.id);
    }
    
    function drop(event) {
      event.preventDefault();
      var data = event.dataTransfer.getData("text");
      var draggedItem = document.getElementById(data);
      
      // Check if the item is being dropped within the same list
      if (draggedItem.parentElement === event.target) {
        // If the item is being dropped in a different position within the same list
        if (draggedItem.nextSibling === event.target.firstElementChild) {
          event.target.insertBefore(draggedItem, event.target.firstElementChild);
        } else {
          event.target.appendChild(draggedItem);
        }
      } else {
        event.target.appendChild(draggedItem);
      }
    }
  </script>
</head>
<body>
  <h2>Drag and Drop List</h2>

  <ul id="list1" class="drag-list" ondrop="drop(event)" ondragover="allowDrop(event)">
    <li id="item1" class="drag-item" draggable="true" ondragstart="drag(event)">Item 1</li>
    <li id="item2" class="drag-item" draggable="true" ondragstart="drag(event)">Item 2</li>
    <li id="item3" class="drag-item" draggable="true" ondragstart="drag(event)">Item 3</li>
    <li id="item4" class="drag-item" draggable="true" ondragstart="drag(event)">Item 4</li>
  </ul>

  <ul id="list2" class="drag-list" ondrop="drop(event)" ondragover="allowDrop(event)">
    <li id="item5" class="drag-item" draggable="true" ondragstart="drag(event)">Item 5</li>
    <li id="item6" class="drag-item" draggable="true" ondragstart="drag(event)">Item 6</li>
    <li id="item7" class="drag-item" draggable="true" ondragstart="drag(event)">Item 7</li>
  </ul>
</body>
</html>
