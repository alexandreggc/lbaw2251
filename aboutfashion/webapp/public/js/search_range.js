
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
// multiple handled with value 
var pmdSliderValueRange = document.getElementById('pmd-slider-value-range');

noUiSlider.create(pmdSliderValueRange, {
  start: [ 20, 80 ], // Handle start position
  connect: true, // Display a colored bar between the handles
  tooltips: [ wNumb({ decimals: 0 }), wNumb({ decimals: 0 }) ],
  format: wNumb({
    decimals: 0,
    thousand: '',
    postfix: '',
  }),
  range: { // Slider can select '0' to '100'
    'min': 0,
    'max': 100
  },
   step: 5,
    pips: { 
      mode: 'steps',
      density: 10
    }
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
