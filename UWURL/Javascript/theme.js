const theme = document.querySelectorAll('.theme');

theme.forEach((item) =>
  item.addEventListener("click", (e) => {
    document.body.classList.remove('darkTheme','lightTheme','rgbTheme');
    switch (e.target.id) {
      case "dark":
        document.body.classList.add("darkTheme");
        break;
      case "light":
        document.body.classList.add("lightTheme");
        break;
      case "rgb":
        document.body.classList.add("rgbTheme");
        break;
      default:
        null;
    }
  })
);
