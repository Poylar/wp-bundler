import '../scss/app.scss';
import Swiper from 'swiper/bundle';

import 'swiper/css/bundle';
function importAll(r) {
  return r.keys().map(r);
}

importAll(require.context('../images/', true, /\.(png|jpe?g|svg|mp4)$/));
function closest(node, elem) {
  if (node === elem) return true;
  if (node == null) return false;
  return closest(node.parentNode, elem);
}

new Swiper()