const app = {
  url: null,
  init: function () {
    console.log("Hello world, I'm app.js 👑");

    // All the colors of the app are set in CSS variables.
    // We use getComputedStyle(document.documentElement).getPropertyValue() to get the value of the CSS variables.
    app.colors = {
      glaucous: getComputedStyle(document.documentElement).getPropertyValue(
        "--glaucous"
      ),
    };

    // We load the modules used in the app.
    form.init();
  },
};

document.addEventListener("DOMContentLoaded", app.init);
