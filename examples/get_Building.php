<label for="select">เลือก:</label>
<select id="select" onchange="showDropdown()">
  <option value="">กรุณาเลือก</option>
  <option value="value1">Value 1</option>
  <option value="value2">Value 2</option>
  <option value="value3">Value 3</option>
</select>

<div id="dropdown" style="display:none;">
  <label for="option">เลือกอีกครั้ง:</label>
  <select id="option">
    <option value="">กรุณาเลือก</option>
    <option value="option1">Option 1</option>
    <option value="option2">Option 2</option>
    <option value="option3">Option 3</option>
  </select>
</div>

<script>
function showDropdown() {
  var select = document.getElementById("select");
  var dropdown = document.getElementById("dropdown");
  var option = document.getElementById("option");
  
  if (select.value == "value1") {
    dropdown.style.display = "block";
  } else {
    dropdown.style.display = "none";
    option.value = "";
  }
}
</script>