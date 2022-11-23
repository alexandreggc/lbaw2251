
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
// multiple handled with value 
var pmdSliderValueRange = document.getElementById('pmd-slider-value-range');

noUiSlider.create(pmdSliderValueRange, {
  start: [ 0, 1000 ], // Handle start position
  connect: true, // Display a colored bar between the handles
  range: { // Slider can select '0' to '100'
    'min': 0,
    'max': 1000
  },
   step: 10
});

var valueMax = document.getElementById('value-max'),
  valueMin = document.getElementById('value-min');

// When the slider value changes, update the input and span
pmdSliderValueRange.noUiSlider.on('update', function( values, handle ) {
  if ( handle ) {
    valueMax.value = values[handle];
  } else {
    valueMin.value = values[handle];
  }
});	
