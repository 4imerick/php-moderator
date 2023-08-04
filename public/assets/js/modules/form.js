const form = {
  // Inputs
  inputs: [],
  init: function () {
    console.log("Hello world, I'm form.js 📝");

    // Inputs
    form.inputs = Array.from(document.querySelectorAll(".form-field__input"));
    for (let input of form.inputs) {
      // We add a listener and a handler on the click event.
      input.addEventListener("click", form.handleAddInputFocusWithin);
      // We add a listener and a handler on the blur event.
      input.addEventListener("blur", form.handleRemoveInputsFocusWithin);
    }
  },
  /**
   * Method that switch the color of the outline around the inputs.
   * @param {HTMLInputElement} input
   * @param {Sring} outlineColor
   * @return {void}
   */
  switchInputOutlineColor: function (input, outlineColor) {
    // console.log("form.switchInputOutlineColor()");

    // We set the property of the CSS variable.
    input.style.setProperty("--outline", "0.1em solid " + outlineColor);
  },
  /**
   * Method that switch the color of the input outline on the focus-within according to the value of mode.backgroundColor.
   * @param {Event} event
   * @return {void}
   */
  handleAddInputFocusWithin: function (event) {
    // console.log("form.handleAddInputFocusWithin()");

    // We get the DOM element form which the event occured.
    const clickedInput = event.currentTarget;

    // We initialaze a index.
    let index = 0;
    // The index is the index of the clickedInput.
    index = form.inputs.indexOf(clickedInput);

    for (let input of form.inputs) {
      if (clickedInput === input) {
        form.switchInputOutlineColor(clickedInput, app.colors.glaucous);
      }
    }
  },
  /**
   * Method that remove the outline property on the inputs when they has lost focus.
   * @param {Event} event
   * @return {void}
   */
  handleRemoveInputsFocusWithin: function (event) {
    // console.log("form.handleRemoveInputsFocusWithin()");

    for (let input of form.inputs) {
      input.style.removeProperty("--outline");
    }
  },
};
