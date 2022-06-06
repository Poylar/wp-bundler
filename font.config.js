const path = require('path');
const fs = require('fs');
fs.unlink(path.resolve(__dirname, 'src/scss/_fonts.scss'), function () {});
fs.readdir(path.resolve(__dirname, 'src/fonts'), (err, files) => {
  if (err) {
    return;
  }
  let array = files;
  let k;
  array.forEach(function (item, index, array) {
    if (item) {
      let i = item.split('-');
      let weight = i[1].replace(/\.woff2|woff|ttf|eot$/, '');
      console.log(weight);
      let j = weight.toLowerCase();
      let fontStyle;
      if (item.toLowerCase().indexOf('italic') == -1) {
        fontStyle = 'normal';
      } else {
        fontStyle = 'italic';
      }
      if (j == 'thin') {
        k = 100;
      } else if (j == 'extralight' || j == 'ultralight') {
        k = 200;
      } else if (j == 'light') {
        k = 300;
      } else if (j == 'normal' || j == 'regular') {
        k = 400;
      } else if (j == 'medium') {
        k = 500;
      } else if (j == 'semibold') {
        k = 600;
      } else if (j == 'bold') {
        k = 700;
      } else if (j == 'extrabold' || j == 'ultrabold') {
        k = 800;
      } else if (j == 'black' || j == 'heavy') {
        k = 900;
      }
      let data_to_append = `@include font(${i[0]},${weight},${k},${fontStyle})`;
      fs.appendFileSync(
        path.resolve(__dirname, 'src/scss/_fonts.scss'),
        `\n${data_to_append};`
      );
    }
  });
});
