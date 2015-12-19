/**
 * Decide jQuery plugin
 * 
 * Builds the decision support system interface
 * and calculates the projected outcome
 *
 * @author Zach Souser
 * @copyright December 2015
 */
(function($) {

	var choices = [],
		characteristics = [],
		crossRankings = [],
		INITIAL = 10;


	$.fn.decide = function(selector) {
		var context = this;

		var sliderOptions = {
			orientation: "horizontal",
			min: 1,
			max: 100,
			change: function(event, ui) {
				var characteristic = $(event.target).data('characteristic'),
					choice = $(event.target).attr('rel'),
					value = $(event.target).slider('value');

				if (typeof $(event.target).attr('rel') == 'undefined') {
					characteristics[characteristic].value = value;
				} else {
					crossRankings[characteristic][choice].value = value;
				}

				calculate(selector);
			}
		};
		
		$addChoice = $('<input id="add" type="text" placeholder="Add new choice...">');
		$addChoice.on('keypress', function(event) {
			if (event.keyCode == 13) {
				choices.push({ name: $(event.target).val(), value: 0 });
				$(context).decide(selector);
				calculate(selector);
				$addChoice.focus();
			} 
		});

		$addCharacteristic = $('<input id="add" type="text" placeholder="Add new characteristic...">');
		$addCharacteristic.on('keypress', function(event) {
			if (event.keyCode == 13) {
				characteristics.push({ name: $(event.target).val(), value: INITIAL });
				$(context).decide(selector);
				calculate(selector);
				$addCharacteristic.focus();
			} 
		});

		$(context)
			.empty()
			.append('<h3>What are your options?</h3>')
			.append($addChoice)
			.append('<h3>What aspects of this decision are important to you?</h3>')
			.append($addCharacteristic)
			.append('<hr/>');

		$(characteristics).each(function(characteristicKey, characteristic) {
			crossRankings[characteristicKey] = crossRankings[characteristicKey] || [];
			$choices = $('<div id="choices">');

			$(choices).each(function(choiceKey, choice) {
				// Build the slider
				$choiceSlider = $('<div id="slider" data-characteristic="' + characteristicKey + '" rel="' + choiceKey + '"></div>');
				
				// Initialize the cross ranking if it doesn't already exist
				crossRankings[characteristicKey][choiceKey] = crossRankings[characteristicKey][choiceKey] || { value: 10 };
				
				// Initialize the slider
				$choiceSlider.slider($.extend(sliderOptions, { 
					value: crossRankings[characteristicKey][choiceKey].value 
				}));
				
				// Set up the view
				$choices
					.append('<label>"' + choice.name + '"</label>')
					.append('<div id="slider" data-characteristic="' + characteristicKey + '" rel="' + choiceKey + '"></div>')
					.append($choiceSlider);
			});

			$slider = $('<div id="slider" data-characteristic="' + characteristicKey + '"></div>')
						.slider($.extend(sliderOptions, { 
							value: characteristic.value 
						}));

			$(context)
				.append('<div id="slider" data-characteristic="' + characteristicKey + '"></div>')
				.append($slider)
				.append('<h3>Rate the following in terms of "' + characteristic.name + '"</h3>')
				.append($choices);

		});
	}


	function normalize(data) {
		var normalized = [];
		var total = 0;

		// Sum the values
		for (i in data) {
			total += parseInt(data[i].value);
		}

		// Apply the average
		for (i in data) {
			normalized.push(parseInt(data[i].value) / total);
		}

		return normalized;
	}

	function calculate(selector) {
		var normalizedCharacteristics = normalize(characteristics),
			results = [];
		for (i in crossRankings) {
			var row = crossRankings[i];
			for (j in row) {
				var weight = normalizedCharacteristics[i] * row[j].value;

				if (results[j] && results[j].value) {
					results[j].value = results[j].value + weight;
				} else {
					results[j] = { value: weight };
				}
			}

		}

		results = normalize(results);
		
		for (i in results) {
			choices[i].value = (100 * results[i]).toFixed(2);
		}

		var sorted = choices.slice().sort(function(a, b) {
			return b.value - a.value;
		});

		$(selector).empty();

		$(selector).append('<h1>Results</h1>');

		$(sorted).each(function(key, value) {
			$(selector).append('<h3>' + value.name + ' - ' + value.value + '%</h3>');
		});
	}
})(jQuery);