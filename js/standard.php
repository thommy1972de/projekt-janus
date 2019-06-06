<script>

function sleep(miliseconds) {
   var currentTime = new Date().getTime();
   while (currentTime + miliseconds >= new Date().getTime()) {
   }
}


const slider = document.querySelector("#slider");
const output = document.querySelector("output");
document.addEventListener('DOMContentLoaded', function() {
  output.value = slider.value;
});

slider.addEventListener ("input", function () {
   output.value = this.value;
});
</script>
